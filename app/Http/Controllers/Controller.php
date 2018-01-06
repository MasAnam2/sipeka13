<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Hris\Administrator as A;
use App\Models\Hris\SubDepartment as SD;
use App\Models\Hris\Position as P;
use App\Models\Hris\Activity as Ac;
use App\Models\Authority as Au;
use View;
use PDF;
use Excel;
use DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $modul;
    private $data;

    private $departments;
    private $modulName;
    private $table;

    public function __construct($a = null, $b = null)
    {
        $this->add_oper    = array();
        $this->modul       = $a;
        $this->data        = $b;
    }

    protected function get_departments()
    {
        return $this->departments;
    }

    protected function set_table($t)
    {
        $this->table = $t;
    }

    protected function set_module($name)
    {
        $this->modulName = $name;
    }

    protected function departments()
    {
        return $this->departments;
    }

    protected function position_name($id)
    {
        return P::find($id)->name;
    }

    protected function employee_name($id)
    {
        return E::find($id)->name;
    }

    protected function employee_detail($id)
    {
        $E = E::find($id);
        return (object) [
        'name'              => $E->name,
        'position'          => $this->position_name($E->position),
        'sub_department'    => $this->sub_department_name($E->department),
        'department'        => $this->department_name()
        ];
    }

    protected function profile()
    {
        $avatar=asset('images/avatars/default.png');
        if(Auth::user()->avatar!=null)
            $avatar = asset('storage/'.Auth::user()->avatar);
        $lvl = Auth::user()->level;
        if($lvl==1){
            $level = 'Administrator';
            $tbl = A::where('login', Auth::id())->first();
            $leftbar = AM::find(1);
        }else{
            $level = '';
            $tbl = E::join('positions', 'positions.id', '=', 'employees.position')
            ->join('sub_departments', 'sub_departments.id', '=', 'employees.department')
            ->join('departments', 'departments.id', '=', 'sub_departments.department')
            ->selectRaw('departments.name as d_name, positions.name as p_name, employees.*, sub_departments.name as sd_name')
            ->where('login', Auth::id())
            ->first();
            $leftbar = Au::where('user', Auth::id())
            ->first();
        }
        $name      = $tbl->name;
        $gender    = $tbl->gender;
        $city      = $tbl->city;
        $birthdate = $tbl->birthdate;
        $address   = $tbl->address;
        $profile   = [
        'avatar'        => $avatar,
        'name'          => $name,
            // 'level'         => $level,
        'gender'        => $gender,
        'city'          => $city,
        'birthdate'     => english_date($birthdate),
        'address'       => $address,
        'born_in'       => $tbl->born_in,
        'leftbar'       => $leftbar
        ];
        if($lvl!=1)
            $profile = array_merge($profile, ['user'=>$tbl]);
        return (object) $profile;
    }

    private $add_oper;

    protected function set_add_oper($add_oper)
    {
        $this->add_oper = $add_oper;
    }
    
    protected function set_data($data){
        $this->data = $data;
    }

    protected function set_modul($modul)
    {
        $this->modul = $modul;
    }

    public function generate_pdf($modul, $view_path, $data, $l=false)
    {
        $oper  = [
        'data'      => $data
        ];
        $pdf = PDF::loadView($view_path, $oper);
        $pdf->setPaper('a4');
        if($l)
            $pdf->setPaper('a4', 'landscape');
        return $pdf->download(str_slug(companyName(), '_').'_'.$modul.' ['.now().'].pdf');
    }

    // protected function to_p

    private $m;

    public function excels($m, $data)
    {
        $this->m = $m;
        $this->data = $data;
        return Excel::create($this->m.' ['.now().']', function($excel) {
            $excel->setTitle($this->m.' ['.now().']');
            $excel->sheet('sheet1', function($sheet) {
                $oper  = array_merge([
                    'data'      => $this->data
                    ], $this->add_oper);
                $sheet->loadView($this->m.'.excel', $oper);
                $sheet->setAutoSize(true);
            });
        })->export('xlsx');
    }

    public function pdf()
    {
        return $this->pdfs($this->modul, $this->data, true);
    }

    public function excel()
    {
        return $this->excels($this->modul, $this->data);
    }

    private $excel_title;
    private $excel_views_path;
    private $excel_oper_data;

    protected function to_excel($t, $v, $o)
    {
        $this->excel_title = $t;
        $this->excel_views_path = $v;
        $this->excel_oper_data = array_merge($o, $this->add_oper);
        return Excel::create($this->excel_title.' ['.now().']', function($excel) {
            $excel->setTitle($this->excel_title.' ['.now().']');
            $excel->sheet('sheet1', function($sheet) {
                $sheet->loadView($this->excel_views_path, $this->excel_oper_data);
                $sheet->setAutoSize(true);
            });
        })->export('xlsx');
    }

    protected function to_pdf($title, $view, $oper, $l=false)
    {
        $pdf = PDF::loadView($view, $oper);
        $pdf->setPaper('a4');
        if($l)
            $pdf->setPaper('a4', 'landscape');
        return $pdf->download($title.' ['.now().'].pdf');
    }

    protected function remove(Request $r)
    {
        $tbl = explode('\\', $this->table);
        $msg = $tbl[1];
        if(count($tbl)==3)
            $msg = $tbl[2];
        $this->create_activity('Deleted '.strtolower($msg));
        $this->table::find($r->id)->delete();
        return $this->deleted();
    }

    protected function not_allowed($menu)
    {
        if(Auth::id()!=1){
            if(Au::where('user', Auth::id())->first()->$menu==0){
                return response('You not authority', 403);
            }
        }
    }

    public function datas()
    {
        $data = array();
        $no = 1;
        foreach ($this->data as $d) {
            $data[] = [
            /*'num'       =>*/ $no++,
            /*'name'      =>*/ $d->name,
            /*'action'    =>*/ ed_btn(route('department.edit', $d->id))
            ];
        }
        return [
        'data'      => $this->data,
        'modul'     => $this->modulName
        ];
    }

    protected function is_ajax(Request $r)
    {
        if(!$r->ajax())
            return redirect()->route('/');
    }

    protected function created()
    {
        return response('Data has been added', 200);
    }

    protected function updated()
    {
        return response('Data has been updated', 200);
    }

    protected function restored()
    {
        return response('Data has been restored', 200);
    }

    protected function deleted()
    {
        return response('Data has been deleted', 200);
    }

    protected function permanent_deleted()
    {
        return response('Data has been permanent deleted', 200);
    }

    protected function deleted_selected()
    {
        return response('Data selected has been deleted', 200);
    }

    protected function join_employee($table, $order=null, $select=null)
    {
        $data = DB::table($table)->join('employees', 'employees.id', '=', $table.'.employee');
        if(count(explode('\\', $table))>=2)
            $data = $table::join('employees', 'employees.id', '=', $table.'.employee');
        $data->join('positions', 'employees.position', '=', 'positions.id')
        ->join('sub_departments', 'sub_departments.id', '=', 'employees.department')
        ->join('departments', 'departments.id', '=', 'sub_departments.department');
        if($select!=null)
            $data->selectRaw('departments.name as d_name, sub_departments.name as sd_name, positions.name as p_name, employees.name as e_name, '.$table.'.*, '.$select);
        else
            $data->selectRaw('departments.name as d_name, sub_departments.name as sd_name, positions.name as p_name, employees.name as e_name, '.$table.'.*');
        if($order!=null)
            $data->orderBy($order[0], $order[1]);
        return $data;
    }

    private $dt;

    protected function set_dt($data)
    {
        $this->dt = $data;
    }
    
    protected function check_authority($module)
    {
        if(Au::where('user', Auth::id())->first()->$module!=1){
            abort('403');
        }
    }

    protected function genPDF($viewPath, $oper, $module, $landscape = false){
        return PDF::loadView($viewPath, $oper)
        ->setPaper('a4', $landscape ? 'landscape' : 'portrait')
        ->download(str_slug(companyName().' '.$module.' '.now()).'.pdf');
    }
}
