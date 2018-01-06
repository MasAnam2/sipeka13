<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department      as D;
use Excel;

class DepartmentController extends Controller
{

    public function dt()
    {
        $data = array();
        $no = 1;
        foreach (D::data() as $d) {
            $data[] = [
            cb_del($d->id),
            $no++,
            $d->name,
            get_edit_button($d->id, route('department.edit'), 'Department', 'modal-sm').
            get_delete_button($d->id, route('department.remove'))
            ];
        }
        return ['data'=>$data];
    }
    
    public function index(Request $r)
    {
        create_activity('accessing department menu');
        $oper = array(
            'modul'         => 'department'
            );
        if($r->ajax())
            return view('departments.ajax_index', $oper);
        return view('departments.index', $oper);
    }

    public function create(Request $r)
    {
        $this->validate($r, ['name'=>'required']);
        foreach ($r->name as $name) {
            if(D::where('name', $name)->count()>0)
                return response('department name already has been taken', 409);
        }
        foreach ($r->name as $name) {
            D::create([
                'name'      => $name,
                ]);
        }
        create_activity('add new department');
        return response('new department has been added', 200);
    }

    public function edit(Request $r)
    {
        create_activity('accessing department edit menu');
        $id = $r->id;
        $data = D::find($id);
        $oper = array(
            'modul'     => 'department',
            'data'      => $data,
            );
        return view('departments.edit', $oper);
    }

    public function update(Request $r)
    {
        $rules = [
        'name'          => 'required|min:2',
        ];
        // D::whereName($r->name)->name
        $nameIsChange = $r->name!=$r->old_name;

        if($nameIsChange)
            $rules['name']='required|min:2|unique:departments';
        $this->validate($r, $rules);
        D::find($r->id)
        ->update([
            'name'  => $r->name
            ]);
        create_activity('update department');
        return response('department has been updated', 200);
    }

    public function remove(Request $r)
    {
        D::find($r->id)->delete();
        create_activity('delete department');
        return response('department has been deleted');
    }

    public function deleteSelected(Request $r)
    {
        create_activity('delete selected department');
        $selected_id = array_flatten($r->all());
        D::destroy($selected_id);
        return response('department selected has been deleted');
    }

    #EXPORT

    public function to_print($data=null)
    {
        create_activity('print department');
        return view('departments.export.print', ['data'=>D::all()]);
    }

    public function pdf()
    {
        create_activity('export to pdf department');
        return parent::generate_pdf('departments', 'departments.export.print', D::data());
    }

    public function excel()
    {
        create_activity('export to excel department');
        Excel::create(str_slug(companyName(), '_').'_departments_'.date('Y_m_d_h_i_s'), function($excel){
            $excel->setTitle(companyName().' Departments');
            $excel->setCreator(companyName())->setCompany(companyName());
            $excel->setDescription(companyName().' Departments');
            $excel->sheet('data', function($sheet){
                $sheet->fromArray(D::excel());
                $sheet->row(1, function($row){
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                });
                $sheet->prependRow(['Departments']);
                $sheet->mergeCells('A1:B1');
                $sheet->cell('A1', function($cell){
                    $cell->setFontSize(16);
                    $cell->setAlignment('center');
                    $cell->setFontWeight('bold');
                });
            });
        })->export('xlsx');
    }
}
