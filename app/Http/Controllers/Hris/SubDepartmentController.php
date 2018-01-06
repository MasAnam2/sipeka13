<?php

namespace App\Http\Controllers\Hris;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hris\Department              as D;
use App\Models\Hris\Position                as P;
use App\Models\Hris\Employee                as E;
use App\Models\Hris\SubDepartment           as SD;
use Illuminate\Support\Facades\DB;
use Excel;

class SubDepartmentController extends Controller
{
    public function __construct()
    {
        parent::__construct('sub_departments', $this->data());
        parent::set_table(SD::class);
        parent::set_add_oper(['lisun'=>false]);
    }

    private function data($a=null)
    {
        
        $SD = SD::data();
        if($a=='trashed')
            return $SD->onlyTrashed()->get();
        return $SD->get();
    }

    public function dt()
    {
        $data = array();
        $no = 1;
        foreach ($this->data() as $d) {
            $data[] = [
            $no++,
            $d->name,
            $d->d_name,
            get_edit_button($d->id, route('sd.edit'), 'small').
            get_delete_button($d->id, route('sd.remove'))
            ];
        }
        return ['data'=>$data];
    }

    public function create(Request $r)
    {
        parent::check_authority('sub_department');
        foreach ($r->name as $name) {
            if(SD::where('name', $name)->count()>0)
                return response('Sub Department name already has been taken', 409);
        }
        foreach($r->name as $name)
            SD::create([
                'name'          => $name,
                'department'    => $r->department
                ]);
        parent::create_activity('Added new sub department');
        return response('Data has been added', 200);
    }

    public function edit(Request $r)
    {
        parent::check_authority('sub_department');
        $id = $r->id;
        $data = SD::find($id);
        $oper = array(
            'modul'         => 'subdepartment',
            'data'          => $data
            );
        return view('hris.sub_departments.edit', $oper);
    }

    public function update(Request $r)
    {
        parent::check_authority('sub_department');
        $exist = false;
        if($r->name!=$r->old_name or $r->department!=$r->old_department)
            $exist = SD::where([
                'name'          => $r->name,
                'department'    => $r->department
                ])->count()>0;
        if($exist)
            return response('Sub Department name already has been taken', 409);

        SD::find($r->id)->update([
            'name'          => $r->name,
            'department'    => $r->department
            ]);
        parent::create_activity('Updated sub department');
        return parent::updated();
    }

    public function disable(Request $request)
    {
        parent::check_authority('sub_department');
        D::destroy($request->id);

        return redirect()->back()->with('success', 'Data has been disabled');
    }

    public function disabled()
    {
        parent::check_authority('sub_department');
        $data = D::onlyTrashed()->get();
        $oper = array(
            'title'         => 'Disabled Sub Departments'.title(),
            'modul'         => 'subdepartment.disabled',
            'data'          => $data,
            'add'           => route('subdepartment.add'),
            'enable'        => route('subdepartment.enable'),
            'profile'       => $this->profile()
            );
        return view('hris.subdepartments.disabled', $oper);
    }

    public function enable(Request $request)
    {
        parent::check_authority('sub_department');
        // dd($request->id);
        D::withTrashed()->where('id',$request->id)->restore();

        return redirect()->back()->with('success', 'Data has been enabled');
    }

    public function check(Request $r)
    {
        if(P::where('subdepartment', $r->id)->count()<=0)
            return 1;
        $P = P::where('subdepartment', $r->id)->get();
        foreach ($P as $p) {
            $E[] = E::where('position', $p->id)->get();
        }
        $oper = [
        'position'      => $P,
        'employee'      => $E
        ];
        return view('subdepartments.alert', $oper);
    }

    public function recycle()
    {
        $data = array();
        $no = 1;
        $dt = $this->data('trashed');
        foreach ($dt as $d) {
            $data[] = [
                $no++,
                $d->name,
                $d->d_name,
                english_date($d->deleted_at),
                get_restore_button($d->id, route('sd.restore')).
                get_permanent_delete_button($d->id, route('sd.permanent_delete'))
            ];
        }
        return ['data'=>$data];
    }

    public function restore(Request $r)
    {
        SD::withTrashed()->where('id', $r->id)->restore();
        parent::create_activity('Restore sub department');
        return parent::restored();
    }

    public function permanent_delete(Request $r)
    {
        SD::withTrashed()->where('id', $r->id)->forceDelete();
        parent::create_activity('Permanent delete sub department');
        return parent::permanent_deleted();
    }

    public function select_by_department(Request $r)
    {
        $data = [];
        foreach (SD::get_by_department($r->dept) as $sd) {
            $data = array_add($data, $sd->id, $sd->name);
        }
        $data = ['all'=>'All']+$data;
        return view('hris.sub_departments.select_by_department', ['data'=>$data]);
    }

    public function to_print($data=null)
    {
        return view('hris.sub_departments.print', ['data'=>$this->data()]);
    }

    public function pdf()
    {
        parent::check_authority('sub_department');
        return parent::pdfs('hris.sub_departments', $this->data());
    }

    public function excel()
    {
        parent::check_authority('sub_department');
        $data = $this->data()->toArray();
        Excel::create('lisun_hris_sub_departments_'.date('Y_m_d_h_i_s'), function($excel) use ($data) {
            $excel->setTitle('Lisun HRIS Sub Departments');
            $excel->setCreator('Lisun')->setCompany('Lisun');
            $excel->setDescription('Lisun HRIS Sub Departments');
            $excel->sheet('data', function($sheet) use ($data) {
                for ($i=1; $i<=count($data); $i++) {
                    $data[$i-1] = ['#'=>$i]+$data[$i-1];
                }
                $sheet->with($data);
                $sheet->row(1, ['#', 'name', 'department']);
                $sheet->row(1, function($row){
                    $row->setFontWeight('bold');
                });
            });
        })->export('xlsx');
    }
}
