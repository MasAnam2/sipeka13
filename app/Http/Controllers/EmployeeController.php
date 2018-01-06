<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Hris\SalaryRule          as SR;
use Excel;
use PDF;
use File;

class EmployeeController extends Controller
{

    public function index(Request $r)
    {
        create_activity('accessing employee menu');
        if($r->ajax())
            return view('employees.ajax_index');    
        return view('employees.index');
    }

    public function dt()
    {
        // return Employee::with(['dep', 'pos'])->get();
        $data = array();
        foreach (Employee::with(['dep', 'pos'])->get() as $d) {
            $data[] = [
                cb_del($d->id),
                $d->ein,
                $d->name,
                $d->dep ? $d->dep->name : not_set(),
                $d->pos ? $d->pos->name : not_set(),
                invalidDate($d->joined_at) ? merah($d->joined_at) : english_date($d->joined_at),
                gender($d->gender),
                get_detail_button($d->id, route('employee.detail'), 'Employee', 'modal-lg').
                get_edit_button($d->id, route('employee.edit'), 'Employee', 'modal-lg').
                get_delete_button($d->id, route('employee.remove')).
                getPrintBtn(route('employee.identityPrint', [$d->id]), 'Print Identity').
                getExcelBtn(route('employee.identityExcel', [$d->id]), 'Export Identity to Excel').
                getPDFBtn(route('employee.identityPDF', [$d->id]), 'Export Identity to PDF')
            ];
        }
        return response(['data'=>$data], 200);
    }

    private function validate_nin($r)
    {
        $rules = ['nin'=>'numeric'];
        if($r->act=='edit')
            $rules = ['nin'=>'numeric|unique:hris_employees'];
        $this->validate($r, $rules);
    }

    private $rules = [
        'name'           => 'required',
        'nin'            => 'required|numeric',
        'ein'            => 'required|numeric',
        'gender'         => 'required',
        'born_in'        => 'required',
        'position_id'       => 'required',
        'department_id'     => 'required',
        'joined_at'      => 'required',
        'city'           => 'required',
        'address'        => 'required',
        'last_education' => 'required'
    ];

    public function create(Request $r)
    {
        $this->rules['nin']       = 'required|numeric|unique:employees';
        $this->rules['photo']     = 'required|mimes:jpeg,png|dimensions:max_width=300,min_width=300,max_height=400,min_height=400';
        $this->rules['ein']       = 'required|numeric|unique:employees';
        $this->rules['birthdate'] = 'required|date_format:Y/m/d|before:'.date('Y-m-d', strtotime('-17 year'));
        $this->validate($r, $this->rules, [
            'photo.dimensions'        => 'Photo dimension must 300x400pixel',
            'birthdate.before'        => 'Employee must be +17 years old'
        ]);
        $photo_path = $r->file('photo')->storeAs('employees/'.$r->nin.'/photo', $r->file('photo')->getClientOriginalName());
        $sd = array_merge($r->all(), ['photo'=>$photo_path]);
        Employee::create($sd);
        create_activity('Added new employee');
        return response('new employee has been added');
    }

    public function edit(Request $r)
    {
        create_activity('accessing employee edit menu');
        return view('employees.edit', ['data'=> Employee::find($r->id)]);
    }

    public function update(Request $r)
    {
        $rules = $this->rules;
        if($r->nin!=$r->old_nin)
            $rules['nin'] = 'required|unique:employees|numeric';
        if($r->ein!=$r->old_ein)
            $rules['ein'] = 'required|unique:employees|numeric';
        $this->rules['birthdate'] = 'required|date_format:Y/m/d|before:'.date('Y-m-d', strtotime('-17 year'));
        $storeData = $r->all();
        if($r->photo!=null){
            $this->rules['photo']     = 'required|mimes:jpeg,png|dimensions:max_width=300,min_width=300,max_height=400,min_height=400';
        }
        $this->validate($r, $rules);
        $employee = Employee::find($r->id);
        if($r->photo!=null){
            File::delete(local_file('storage/'.$employee->photo));
            $photo_path = $r->file('photo')
            ->storeAs('employees/'.$r->nin.'/photo', $r->file('photo')
                ->getClientOriginalName());
            $storeData['photo']       = $photo_path;
        }
        $employee->update($storeData);
        create_activity('Update employee');
        return response('employee has been updated');
    }

    public function remove(Request $r)
    {
        $employee = Employee::find($r->id);
        File::delete(local_file('storage/'.$employee->photo));
        $employee->delete();
        create_activity('delete employee');
        return response('employee has been deleted');
    }

    public function detail(Request $r)
    {
        return view('employees.detail', ['data'=>Employee::find($r->id)]);
    }

    public function deleteSelected(Request $r)
    {
        create_activity('delete selected employee');
        $selected_id = array_flatten($r->all());
        Employee::destroy($selected_id);
        return response('employee selected has been deleted');
    }

    public function identityPrint($id)
    {
        $oper  = [
            'data'      => Employee::getData($id),
            'i' => 1
        ];
        return view('employees.identity.print', $oper);
    }

    public function identityPDF($id)
    {
        $oper  = [
            'data'      => Employee::getData($id),
            'i' => 1
        ];
        return PDF::loadView('employees.identity.print', $oper)
        ->download(str_slug(companyName().' employee identity '.now()).'.pdf');
    }

    public function identityExcel($id)
    {
        Excel::create(str_slug(companyName().' employee identity '.now()), function($excel) use ($id) {
            $excel->setTitle('Identity Employee');
            $excel->sheet('sheet1', function($sheet) use ($id){
                $oper  = [
                    'data'      => Employee::getData($id),
                    'excel' => true
                ];
                $sheet->loadView('employees.identity.print', $oper);
            });
        })->export('xlsx');
    }

    #EXPORT

    public function to_print()
    {
        return view('employees.export.print', [
            'data'       => Employee::with(['dep', 'pos'])->get(),
            'male_total' => Employee::where('gender', '0')->count()
        ]);
    }

    public function pdf()
    {
        return PDF::loadView('employees.export.print', [
            'data'       => Employee::with(['dep', 'pos'])->get(),
            'male_total' => Employee::where('gender', '0')->count()
        ])->setPaper('a4', 'landscape')->download(str_slug(companyName(), '_').'_employees_'.now().'.pdf');
    }

    public function excel()
    {
        Excel::create(str_slug(companyName(), '_').'_employees_'.date('Y_m_d_h_i_s'), function($excel){
            $excel->setTitle(companyName().' Employees');
            $excel->setCreator(companyName())->setCompany(companyName());
            $excel->setDescription(companyName().' Employees');
            $excel->sheet('data', function($sheet){
                $data = Employee::excel();
                $sheet->fromArray($data);
                $last_row = count($data);
                $sheet->row(1, function($row){
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                });
                $sheet->prependRow(['Employees']);
                $sheet->mergeCells('A1:M1');
                $sheet->cell('A1', function($cell){
                    $cell->setFontSize(16);
                    $cell->setAlignment('center');
                    $cell->setFontWeight('bold');
                });
                $sheet->row($last_row+4, ['Total', $last_row]);
                $male_total = Employee::where('gender', '0')->count();
                $sheet->row($last_row+5, ['Male total', $male_total]);
                $sheet->row($last_row+6, ['Female total', $last_row-$male_total]);
                for($i=4;$i<7;$i++)
                    $sheet->row($last_row+$i, function($row){
                        $row->setFontWeight('bold');
                    });
            });
        })->export('xlsx');
    }
}
