<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Position;
use Excel;

class PositionController extends Controller
{
    public function dt()
    {
        $data = array();
        $no = 1;
        foreach (Position::data() as $d) {
            $data[] = [
            cb_del($d->id),
            $no++,
            $d->name,
            get_edit_button($d->id, route('position.edit'), 'Position', 'modal-sm').
            get_delete_button($d->id, route('position.remove'))
            ];
        }
        return ['data'=>$data];
    }

    public function index(Request $r)
    {
        $oper = array(
            'modul'=>'position'
            );
        create_activity('accessing position menu');
        if($r->ajax())
            return view('positions.ajax_index', $oper);
        return view('positions.index', $oper);
    }

    private $rules = [
    'basic_salary' => 'required|min:1|numeric',
    'incentive'    => 'required|min:1|numeric',
    'over_time'    => 'required|min:1|numeric'
    ];

    public function create(Request $r)
    {
        $rules['name'] = 'required|unique:positions';
        $this->validate($r, $rules);
        foreach ($r->all()['name'] as $v) {
            Position::create(['name'=>$v]);
        }
        create_activity('add new position');
        return response('new position has been added');
    }

    public function edit(Request $r)
    {
        $data = Position::find($r->id);
        $oper = array(
            'data'              => $data
            );
        create_activity('accessing position edit menu');
        return view('positions.edit', $oper);
    }

    public function update(Request $r)
    {
        $nameIsChange = $r->name!=$r->old_name;
        $rules = [];
        if($nameIsChange){
            $rules['name']='required|unique:positions';
        }
        $this->validate($r, $rules);
        Position::find($r->id)->update($r->all());
        create_activity('Update position');
        return response('position has been updated');
    }

    public function remove(Request $r)
    {
        Position::find($r->id)->delete();
        create_activity('delete position');
        return response('position has been deleted');
    }

    public function deleteSelected(Request $r)
    {
        create_activity('delete selected position');
        $selected_id = array_flatten($r->all());
        Position::destroy($selected_id);
        return response('position selected has been deleted');
    }

    #EXPORT

    public function to_print($data=null)
    {
        create_activity('print position');
        return view('positions.export.print', ['data'=>Position::data()]);
    }

    public function pdf()
    {
        create_activity('export to pdf position');
        return parent::generate_pdf('positions', 'positions.export.print', Position::data());
    }

    public function excel()
    {
        create_activity('export to excel position');
        Excel::create(str_slug(companyName(), '_').'_positions_'.date('Y_m_d_h_i_s'), function($excel){
            $excel->setTitle(companyName().' Positions');
            $excel->setCreator('Lisun')->setCompany('Lisun');
            $excel->setDescription(companyName().' Positions');
            $excel->sheet('data', function($sheet){
                $sheet->fromArray(Position::excel());
                $sheet->row(1, function($row){
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                });
                $sheet->prependRow(['Positions']);
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

