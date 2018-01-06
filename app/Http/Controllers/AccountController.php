<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Authority;
use App\User;
use Excel;

class AccountController extends Controller
{

    public function index(Request $r)
    {
        create_activity('accessing accounts menu');
        if($r->ajax())
            return view('accounts.ajax_index');
        return view('accounts.index');
    }

    public function dt()
    {
        $data = array();
        $no = 1;
        foreach (User::all() as $d) {
            if($d->id == 1)
                continue;
            $data[] = [
                cb_del($d->id),
                $no++,
                $d->username,
                level($d->level),
                '('.$d->emp->ein.') '.$d->emp->name,
                get_detail_button($d->id, route('account.detail'), 'Account', 'modal-sm').
                get_edit_button($d->id, route('account.edit'), 'Account', 'modal-lg').
                get_delete_button($d->id, route('account.remove')) 
            ];
        }
        return response(['data'=>$data], 200);
    }

    private function storeData($r)
    {
        $s = [
            'departments' => is_null($r->department)?0:$r->department,
            'positions'   => is_null($r->position)?0:$r->position,
            'employee'   => is_null($r->employee_menu)?0:$r->employee_menu,
            'salary_rules'   => is_null($r->salary_rules)?0:$r->salary_rules,
            'attendance' => is_null($r->attendance)?0:$r->attendance,
            'over_time'  => is_null($r->over_time)?0:$r->over_time,
            'loan'       => is_null($r->loan)?0:$r->loan,
            'account'    => is_null($r->account)?0:$r->account,
            'salary'     => is_null($r->salary)?0:$r->salary,
            'company_profile'     => is_null($r->company_profile)?0:$r->company_profile,
        ];
        return $s;
    }

    private $modules = ['departments', 'positions', 'employees', 'salary_rules','attendances', 'over_time', 'loans', 'accounts', 'salaries', 'company_profile'];

    public function create(Request $r)
    {
        $rules = [
            'username'      => 'required|unique:users|min:6|max:20|alpha',
            'password'      => 'required|min:6|max:20|confirmed',
            'level'         => 'required',
            'employee'      => 'required'
        ];
        $this->validate($r, $rules);
        $sd        = [];
        $all_empty = true;
        foreach ($this->modules as $key => $value) {
            if(!is_null($r->$value)){
                $all_empty  = false;
                $sd[$value] = $r->$value;
            }else{
                $sd[$value] = 0;
            }
        }
        if($all_empty){
            return response('Authority must be one filled', 409);
        }
        $data      = [
            'username' => $r->username,
            'password' => bcrypt($r->password),
            'level'    => $r->level
        ];
        $U = null;;
        $U = User::where('employee', $r->employee);
        if($U->count()){
            $U->update($data);
            $responseTXT = 'account has been updated';
            $activitiTxt = 'update user account';
            $U->first()->authority()->update($sd);
        }else{
            $data['employee'] = $r->employee;
            $U = User::create($data);
            $responseTXT = 'new account has been added';
            $activitiTxt = 'added new user account';
            $U->authority()->create($sd);
        }
        create_activity($activitiTxt);
        return response($responseTXT);
    }

    public function edit(Request $r)
    {
        create_activity('accessing account edit menu');
        return view('accounts.edit', [
            'data' => User::with(['authority', 'emp'])->whereId($r->id)->first()
        ]);
    }

    public function update(Request $r)
    {
        $rules = [
            'level'         => 'required',
        ];
        if($r->old_username!=$r->username)
            $rules['username'] = 'required|unique:users|min:6|max:20|alpha';
        if($r->password!=null)
            $rules['password']      = 'required|min:6|max:20|confirmed';
        $this->validate($r, $rules);
        $all_empty = true;
        foreach ($this->modules as $key => $value) {
            if(!is_null($r->$value)){
                $all_empty  = false;
                $sd[$value] = $r->$value;
            }else{
                $sd[$value] = 0;
            }
        }
        if($all_empty){
            return response('Authority must be one filled', 409);
        }
        $storeData = [
            'username'      => $r->username,
            'level'         => $r->level
        ];
        if($r->password!=null)
            $storeData['password'] = bcrypt($r->password);
        User::find($r->id)->update($storeData);
        Authority::where('user', $r->id)->update($sd);
        create_activity('update user account');
        return response('account has been updated');
    }

    public function detail(Request $r)
    {
        create_activity('accessing account detail');
        return view('accounts.detail', ['data'=>User::find($r->id)]);
    }

    public function remove(Request $r)
    {
        User::find($r->id)->delete();
        create_activity('delete user account');
        return response('account has been deleted');
    }

    public function deleteSelected(Request $r)
    {
        create_activity('delete selected account');
        $selected_id = array_flatten($r->id);
        foreach ($selected_id as $id) {
            User::find($id)->delete();
        }
        return response('account selected has been deleted');
    }

    #EXPORT

    public function to_print($data=null)
    {
        return view('accounts.export.print', [
            'data' => User::getData()
        ]);
    }

    public function pdf()
    {
        return parent::genPDF('accounts.export.print', [
            'data' => User::getData()
        ], 'accounts', true);
    }

    public function excel()
    {
        Excel::create(str_slug(companyName().' accounts '.now()), function($excel){
            $excel->setTitle('Accounts');
            $excel->setCreator(companyName())->setCompany(companyName());
            $excel->setDescription('Accounts');
            $excel->sheet('data', function($sheet){
                $datas = [];
                $i = 1;
                foreach (User::with(['emp'])->where('id', '!=', '1')->get() as $d) {
                    $arr                        = [
                        '#' => $i++,
                        'Username'                  => $d->username,
                        'Level'                     => level($d->level),
                        'Employee'                  => '('.$d->emp->ein.') '.$d->emp->name
                    ];
                    array_push($datas, $arr);
                }
                $sheet->with($datas);
                $sheet->row(1, function($row){
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                });
                $sheet->prependRow(1, [
                    'Accounts'
                ]);
                $sheet->mergeCells('A1:D1');
                $sheet->cell('A1', function($cell){
                    $cell->setFontSize(16);
                    $cell->setFontWeight('bold');
                    $cell->setAlignment('center');
                });
            });
        })->export('xlsx');
    }

}

