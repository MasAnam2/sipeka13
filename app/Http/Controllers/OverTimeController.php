<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\OverTime;
use App\Setting;
use Excel;
use PDF;

class OverTimeController extends Controller
{

    private function genDt($DATA){
        $data = array();
        $no = 1;
        foreach ($DATA as $d) {
            $data[] = [
                cb_del($d->id),
                $no++,
                '('.$d->emp->ein.') '.$d->emp->name,
                english_date($d->created_at),
                rupiah($d->pay),
                $d->information,
                get_edit_button($d->id, route('over_time.edit'), 'Over Time', 'modal-sm').
                get_delete_button($d->id, route('over_time.remove'))
            ];
        }
        return $data;
    }

    public function dt()
    {
        return response([
            'data' => $this->genDt(OverTime::all())
        ], 200);
    }

    public function dt_filter($time)
    {
        return response([
            'data' => $this->genDt(OverTime::filterTime($time))
        ], 200);
    }

    public function index(Request $r)
    {
        create_activity('accessing over time menu');
        $oper = [
            'time' => 'all',
            'setting' => Setting::where('key', 'over_time')->first()->value
        ];
        if($r->ajax())
            return view('over_time.ajax_index', $oper);
        return view('over_time.index', $oper);
    }

    public function filter(Request $r, $time='all')
    {
        create_activity('accessing over time menu with filter');
        $oper = [
            'time' => $time,
            'setting' => Setting::where('key', 'over_time')->first()->value
        ];
        if($r->ajax())
            return view('over_time.ajax_filter', $oper);
        return view('over_time.filter', $oper);
    }

    public function edit(Request $r)
    {
        create_activity('accessing over time edit menu');
        $data = OverTime::find($r->id);
        return view('over_time.edit', ['data'=>$data]);
    }

    public function update(Request $r)
    {
        $this->validate($r, [
            'pay'=> 'required|numeric|min:0'
        ]);
        create_activity('update over time');
        OverTime::find($r->id)->update($r->all());
        return response('over time has been updated');
    }

    public function remove(Request $r)
    {
        OverTime::find($r->id)->delete();
        create_activity('delete over time');
        return response('over time has been deleted');
    }

    public function deleteSelected(Request $r)
    {
        $selected_id = array_flatten($r->all());
        OverTime::destroy($selected_id);
        create_activity('delete selected over time');
        return response('over time selected has been deleted');
    }

    #EXPORT

    public function to_print($data=null)
    {
        create_activity('print over time');
        return view('over_time.export.print', ['data'=>OverTime::all()]);
    }

    public function to_print_filter($time='all')
    {
        create_activity('print over time with filter');
        if($time == 'all')
            return redirect()->route('over_time.print');
        $over_times = OverTime::filterTime($time);
        return view('over_time.export.print_filter', ['data' => $over_times, 'time' => getFilterTime($time)]);
    }

    public function pdf()
    {
        create_activity('export over time to pdf');
        return parent::genPDF('over_time.export.print', [
            'data' => OverTime::all()
        ], 'over time', true);
    }

    public function pdf_filter($time='all')
    {
        create_activity('export over time to pdf with filter');
        if($time == 'all')
            return redirect()->route('over_time.pdf');
        $over_times = OverTime::filterTime($time);
        return parent::genPDF('over_time.export.print_filter', [
            'data' => $over_times,
            'time' => $time
        ], 'over time', true);
    }

    private function genExcel($data, $time = '')
    {
        Excel::create(str_slug(companyName().' over time '.now()), function($excel) use ($data, $time){
            $excel->setTitle(companyName().' Over Time');
            $excel->setCreator(companyName())->setCompany(companyName());
            $excel->setDescription(companyName().' Over Time');
            $excel->sheet('data', function($sheet) use ($data, $time){
                $datas = [];
                $no = 1;
                foreach ($data as $d) {
                    $arr          = [
                        '#'           => $no++,
                        'Employee'    => '('.$d->emp->ein.') '.$d->emp->name,
                        'Created At'  => english_date($d->created_at),
                        'Pay (Rp)'    => $d->pay==0 ? '-' : $d->pay,
                        'Information' => $d->information,
                    ];
                    array_push($datas, $arr);
                }
                $sheet->with($datas);
                $sheet->row(1, function($row){
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                });
                if($time){
                    $sheet->prependRow(1, array(
                        'Filter use : '.$time
                    )); 
                    $sheet->mergeCells('A1:B1');
                }
                $sheet->prependRow(1, [
                    'Over Time'
                ]);
                $sheet->mergeCells('A1:E1');
                $sheet->cell('A1', function($cell){
                    $cell->setFontSize(16);
                    $cell->setFontWeight('bold');
                    $cell->setAlignment('center');
                });
            });
        })->export('xlsx');
    }

    public function excel()
    {
        create_activity('export over time to excel');
        $this->genExcel(OverTime::all());
    }

    public function excel_filter($time='all')
    {
        create_activity('export over time to excel with filter');
        $this->genExcel(OverTime::filterTime($time), $time);
    }

    public function setTime(Request $r)
    {
        Setting::where('key', 'over_time')->update([
            'value' => $r->set_time
        ]);
        return 'Time has been updated';
    }

}