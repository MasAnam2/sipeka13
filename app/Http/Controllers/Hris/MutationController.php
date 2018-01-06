<?php

namespace App\Http\Controllers\Hris;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Hris\Position                as P;
use App\Models\Hris\Department              as D;
use App\Models\Hris\Mutation                as M;
use App\Models\Hris\SubDepartment           as SD;
use App\Models\Hris\Employee                as E;
use PDF;
use Excel;
class MutationController extends Controller
{
    private $table;

    public function __construct()
    {
        $this->table = 'mutations';
        parent::set_add_oper(['lisun'=>false]);
    }

    private function data($id = null)
    {
        return M::data($id);
    }

    public function dt()
    {
        $data = array();
        $no = 1;
        foreach ($this->data() as $d) {
            $data[] = [
            $no++,
            $d->mutation_id,
            $d->e_name,
            $d->p_name,
            english_date($d->created_at),
            get_detail_button($d->id, route('mutation.detail'), 'small').
            get_edit_button($d->id, route('mutation.edit')).
            '<a data-role="hint" data-hint-background="bg-red" data-hint-color="fg-white" data-hint-mode="2" data-hint="Delete And Restore" data-hint-position="top" onclick="remove('.$d->id.')" class="fg-white button cycle-button bg-red"><span class="mif-bin"></span></a>'.
            '<a class="button cycle-button bg-steel fg-white" href="'.route('mutation.letter.print', $d->id).'" target="_blank" '.hint('Mutation Letter Print', 'steel').'"><span class="mif-printer"></span></a>
            <a class="button cycle-button bg-red fg-white" href="'.route('mutation.letter.pdf', $d->id).'" target="_blank" '.hint('Mutation Letter PDF', 'red').'"><span class="mif-file-pdf"></span></a>
            <a class="button cycle-button bg-green fg-white" href="'.route('mutation.letter.excel', $d->id).'" target="_blank" '.hint('Mutation Letter Excel', 'green').'"><span class="mif-file-excel"></i></a>'
            ];
        }
        return response(['data'=>$data], 200);
    }

    private function data2()
    {
        $data2 = null;
        foreach ($this->data() as $d) {
            $P = P::find($d->old_position);
            $SD = SD::find($d->old_department);
            $data2[] = (object) [
            'p_name'        => $P->name,
            'sd_name'       => $SD->name,
            'd_name'        => D::find($SD->department)->name
            ];
        }
        return $data2;
    }

    public function index(Request $r)
    {
        if(!$r->ajax())
            return redirect()->route('hris');
        $oper = array(
            'data'          => $this->data(),
            'data2'         => $this->data2()
            );
        return view('mutations.index', $oper);
    }

    private $rules = [
    'reason'         => 'required',
    'effect_on'      => 'required',
    'employee'       => 'required',
    'manager'        => 'required',
    'sub_department' => 'required',
    'position'       => 'required',
    'city'           => 'required',
    'mutation_id'    => 'required'
    ];

    private function storeData($r)
    {
        $storeData = [
        'new_position'      => $r->position,
        'new_department'    => $r->sub_department,
        'reason'            => $r->reason,
        'created_at'        => now(),
        'effect_on'         => $r->effect_on
        ];
        return array_merge($r->all(), $storeData);
    }

    public function create(Request $r)
    {
        $this->validate($r, $this->rules);
        $sd = $this->storeData($r);
        $sd['old_position'] = E::find($r->employee)->position;
        $sd['old_department'] = E::find($r->employee)->department;
        M::create($sd);
        E::find($r->employee)->update(['position'=>$r->position, 'department'    => $r->sub_department]);
        parent::create_activity('Added new mutation');
        return parent::created();
    }

    public function refresh_mutation_id()
    {
        return date('myhmdims');
    }

    public function edit(Request $r)
    {
        $data = $this->data($r->id);
        $oper = array(
            'data'                   => $data,
            'department'             => SD::find($data->old_department)->department,
            'sub_departments'        => SD::where('department', $data->old_department)->get(),
            'old_position'           => P::find($data->old_position)->name,
            'old_department'         => SD::find($data->old_department)->name,
            'manager_sub_department' => E::find($data->manager)->department,
            'manager_department'     => SD::find(E::find($data->manager)->department)->department
            );
        return view('mutations.edit', $oper);
    }

    public function update(Request $r)
    {
        $this->validate($r, $this->rules);
        M::find($r->id)->update($this->storeData($r));
        E::find(M::find($r->id)->employee)->update(['position'=>$r->position, 'department'    => $r->sub_department]);

        return parent::updated();
    }

    public function detail(Request $r)
    {
        $d = $this->data($r->id);
        $oper = [
        'data'                   => $d,
        'old_sub_department'     => parent::sub_department_name($d->old_department),
        'old_department'         => parent::department_name(),
        'old_position'           => parent::position_name($d->old_position),
        'manager'                => parent::employee_name($d->manager),
        'manager_position'       => parent::position_name(E::find($d->manager)->position),
        'manager_department'     => parent::department_name(SD::find(E::find($d->manager)->department)->department),
        'manager_sub_department' => parent::sub_department_name(E::find($d->manager)->department)
        ];
        return view('mutations.detail', $oper);
    }

    public function remove(Request $r)
    {
        $mutation             = M::find($r->id);
        $employee             = E::find($mutation->employee);
        $employee->department = $mutation->old_department;
        $employee->position   = $mutation->old_position;
        $employee->save();
        $mutation->delete();
        parent::create_activity('Delete and restore mutation');
        return response('Data has been delete and restored', 200);
    }

    private $modul = 'mutations';

    public function to_print($data=null)
    {
        $oper  = [
        'data2'     => $this->data2(),
        'data'      => $this->data()
        ];
        return view($this->modul.'.print', $oper);
    }

    public function pdf()
    {
        $l = true;
        $oper  = [
        'data2'     => $this->data2(),
        'data'      => $this->data()
        ];
        $pdf = PDF::loadView($this->modul.'.print', $oper);
        $pdf->setPaper('a4');
        if($l)
            $pdf->setPaper('a4', 'landscape');
        return $pdf->download($this->modul.' ['.now().'].pdf');
    }

    public function excel()
    {
        return Excel::create($this->modul.' ['.now().']', function($excel) {
            $excel->setTitle($this->modul.' ['.now().']');
            $excel->sheet('sheet1', function($sheet) {
                $oper  = [
                'data2' => $this->data2(),
                'data'  => $this->data(),
                'lisun' => false
                ];
                $sheet->loadView($this->modul.'.excel', $oper);
                $sheet->setAutoSize(true);
            });
        })->export('xlsx');
    }

    private function letteroper($id)
    {
        $d = $this->data($id);
        $oper = [
        'data'           => $d,
        'm'              => parent::employee_detail($d->manager),
        'old'            => (object) [
        'position'       => parent::position_name($d->old_position),
        'sub_department' => parent::sub_department_name($d->old_department),
        'department'     => parent::department_name()
        ]
        ];
        return $oper;
    }

    public function letterprint($id)
    {
        $oper = $this->letteroper($id);
        $oper['img'] = asset('images/company/mutation_logo.jpg');
        return view('mutations.letter', $oper);
    }

    public function letterexcel($id)
    {
        $oper          = $this->letteroper($id);
        $oper['img']   = local_file('images/company/mutation_logo.jpg');
        $oper['lisun'] = false;
        return parent::to_excel('Mutation Letter', 'mutations.letter_excel', $oper);
    }

    public function letterpdf($id)
    {
        $oper = $this->letteroper($id);
        $oper['img'] = asset('images/company/mutation_logo.jpg');
        return parent::to_pdf('Mutation Letter', 'mutations.letter_pdf', $oper);
    }

    public function check_position_department(Request $r)
    {
        return view('mutations.check_position_department', ['data'=>E::data($r->id)]);
    }

}

