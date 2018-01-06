<?php

namespace App\Http\Controllers;

use File;
use Excel;
use App\Setting;
use App\Models\OverTime;
use App\Models\Employee;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttendanceController extends Controller
{

    public function index(Request $r)
    {
        create_activity('accessing attendance menu');
        $oper = ['time' => 'all'];
        if($r->ajax())
            return view('attendances.ajax_index', $oper);
        return view('attendances.index', $oper);
    }

    public function filter(Request $r, $time)
    {
        create_activity('accessing attendance menu with filter');
        $oper = ['time' => $time];
        if($r->ajax())
            return view('attendances.ajax_filter', $oper);
        return view('attendances.filter', $oper);
    }

    public function dt()
    {
        $data = array();
        $no = 1;
        foreach (Attendance::all() as $d) {
            $data[] = [
                cb_del($d->id),
                $no++,
                '('.$d->emp->ein.') '.$d->emp->name,
                english_date($d->created_at),
                absence_status($d->status),
                $d->enter_at,
                $d->out_at,
                $d->information,
                get_edit_button($d->id, route('attendance.edit'), 'Attendance').
                get_delete_button($d->id, route('attendance.remove'))
            ];
        }
        return response(['data'=>$data], 200);
    }

    public function dt_filter($time)
    {
        // return Attendance::filterTime($time);
        $data = array();
        $no = 1;
        foreach (Attendance::filterTime($time) as $d) {
            $data[] = [
                cb_del($d->id),
                $no++,
                '('.$d->emp->ein.') '.$d->emp->name,
                english_date($d->created_at),
                absence_status($d->status),
                $d->enter_at,
                $d->out_at,
                $d->information,
                get_edit_button($d->id, route('attendance.edit'), 'Attendance').
                get_delete_button($d->id, route('attendance.remove'))
            ];
        }
        return response(['data'=>$data], 200);
    }


    private $rules = [
        'status'            => 'required'
    ];

    public function create(Request $r)
    {
        $rules             = $this->rules;
        $rules['employee'] = 'required';
        if($r->status==0){
            $rules['enter_at']   = 'required';
            $rules['created_at'] = 'required|date_format:Y/m/d|before:'.date('Y-m-d', strtotime('+1 days'));
        }else{
            $rules['information'] = 'required';
        }
        $this->validate($r, $rules);
        $sd          = [
            'employee'   => $r->employee,
            'status'     => $r->status,
            'created_at' => $r->created_at,
            'enter_at'   => $r->enter_at,
            'information'=> $r->information?$r->information:''
        ];
        if($r->status!=0){
            $sd['enter_at'] = null;
        }
        create_activity('Add new attendance');
        $A = Attendance::whereRaw('employee = '.$r->employee.' and created_at=\''.$r->created_at.'\'');
        if($A->count()>0){
            $A->update($sd);
            return response('attendance has been updated');
        }
        Attendance::create($sd);
        return response('attendance has been created');
    }

    public function edit(Request $r)
    {
        return view('attendances.edit', ['data'=>Attendance::find($r->id)]);
    }

    public function update(Request $r)
    {
        $rules['created_at'] = 'required|date_format:Y/m/d';
        if($r->status==0){
            $rules['enter_at'] = 'required';
            $rules['out_at']   = 'required';
        }else{
            $rules['information'] = 'required';
        }
        $this->validate($r, $rules);
        $sd = $r->all();
        if($r->status!=0){
            $sd['enter_at'] = null;
            $sd['out_at']   = null;
        }else{
            $sd['information'] = '';
        }
        $A = Attendance::find($r->id);
        $A->update($sd);
        $out      = strtotime($r->created_at.' '.$r->out_at);
        $out_rule = strtotime($r->created_at.' '.Setting::where('key', 'over_time')->first()->value);
        $O = OverTime::where(['employee'=>$A->employee, 'created_at'=>$r->created_at]);
        $sd          = [
            'employee'   => $A->employee,
            'created_at' => $r->created_at
        ];
        // dd($r->employee);
        if($out > $out_rule && $O->count() > 0){
            $O->update($sd);
        }else if($out > $out_rule && $O->count() <= 0){
            OverTime::create($sd);
        }else if($out <= $out_rule && $O->count() > 0){
            $O->delete();
        }
        return response('attendance has been updated');
    }

    private function deleteFromDB($id)
    {
        $attendance = Attendance::find($id);
        OverTime::where(['created_at'=>$attendance->created_at, 'employee'=>$attendance->employee])->delete();
        $attendance->delete();
    }

    public function remove(Request $r)
    {
        $this->deleteFromDB($r->id);
        create_activity('delete attendance');
        return response('attendance has been deleted');
    }

    public function deleteSelected(Request $r)
    {
        create_activity('delete selected attendance');
        $selected_id = array_flatten($r->id);
        foreach ($selected_id as $id) {
            $this->deleteFromDB($id);
        }
        return response('attendance selected has been deleted');
    }

    public function create_by_excel(Request $r)
    {
        $this->validate($r, ['attendance_excel'=>'required|mimes:xls,xlsx']);
        $attendance_excel = $r->file('attendance_excel')->store('attendances/excel');
        $rows             = Excel::load(str_replace('/', '\\', 'public\storage\\'.$attendance_excel))->get();
        $all_empty = true;
        // dd($rows);
        $rows->each(function($row){
            $created_at = null;
            if(!is_null($row->created_at))
                $created_at = $row->created_at->format('Y-m-d');
            $status = 1;
            foreach(attendance_status_array() as $k => $v){
                if(strtolower($row->status) == strtolower($v)){
                    $status = $k;
                    break;
                }
            }
            $enter_at = null;
            if(!is_null($row->enter_at) && $row->enter_at!='null'){
                $enter_at    = $row->enter_at->format('H:i:s');
            }
            $out_at = null;
            if(!is_null($row->out_at) && $row->out_at!='null'){
                $out_at    = $row->out_at->format('H:i:s');
            }
            $data        = [
                'created_at' => $created_at,
                'enter_at'   => $enter_at,
                'out_at'     => $out_at,
                'status'     => $status
            ];
            $all_null = true;
            foreach ($data as $v) {
                if(!is_null($v)){
                    $all_null = false;
                    break;
                }
            }
            if(!$all_null){
                $E = Employee::where('ein', $row->ein)->first();
                if(count($E)){
                    $all_empty = false;
                    $attendance = $E->attendances()->where('created_at', $created_at);
                    if($attendance->count())
                        $attendance->update($data);
                    else
                        $attendance->create($data);
                    $O = $E->over_times()->where(['employee'=>$E->id, 'created_at'=>$created_at]);
                    if($status==0){
                        $out      = strtotime($created_at.' '.$out_at);
                        $out_rule = strtotime($created_at.' 16:00:00');
                        if($out > $out_rule){
                            $sd          = [
                                'created_at' => $created_at,
                            ];
                            $O->updateOrCreate($sd);
                        }
                    }else{
                        if($O->count()){
                            $O->delete();
                        }
                    }
                }
            }
        });
        File::delete(local_file('storage/'.$attendance_excel));
        create_activity('import attendance from excel');
        if($all_empty)
            return response('import and attendance success');
        return response('import and attendance success');
    }

    #EXPORT

    public function to_print($data=null)
    {
        create_activity('print attendances');
        return view('attendances.export.print', ['data'=>Attendance::all()]);
    }

    public function to_print_filter($time='all')
    {
        create_activity('print attendances with filter');
        if($time == 'all')
            return redirect()->route('attendance.print');
        $attendances = Attendance::filterTime($time);
        return view('attendances.export.print_filter', ['data' => $attendances, 'time' => getFilterTime($time)]);
    }

    public function pdf()
    {
        create_activity('export attendances to pdf');
        return parent::genPDF('attendances.export.print', [
            'data' => Attendance::all()
        ], 'Attendances', true);
    }

    public function pdf_filter($time='all')
    {
        create_activity('export attendances to pdf with filter');
        if($time == 'all')
            return redirect()->route('attendance.pdf');
        $attendances = Attendance::filterTime($time);
        return generate_pdf(fileNameWithPrefix('attendances'), 'attendances.export.print_filter', $attendances, true, ['time' => getFilterTime($time)]);
    }

    private function genExcel($data, $filter = ''){
        Excel::create(str_slug(companyName(), '_').'_attendance_'.date('Y_m_d_h_i_s'), function($excel) use ($data, $filter) {
            $excel->setTitle(companyName().' Attendance');
            $excel->setCreator(companyName())->setCompany(companyName());
            $excel->setDescription(companyName().' HRIS Attendance');
            $excel->sheet('data', function($sheet) use ($data, $filter) {
                $datas = [];
                $i = 1;
                foreach ($data as $d) {
                    $arr          = [
                        '#' => $i++,
                        'Employee'    => '('.$d->emp->ein.') '.$d->emp->name,
                        'Created At'  => $d->created_at,
                        'Status'      => absence_status($d->status),
                        'Enter At'    => $d->enter_at,
                        'Out At'      => $d->out_at,
                        'Information' => $d->information
                    ];
                    array_push($datas, $arr);
                }
                $sheet->with($datas);
                $sheet->row(1, function($row){
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                });
                if($filter){
                    $sheet->prependRow(1, array(
                        'Filter use : '.ucwords((str_replace('_', ' ', $filter)))
                    )); 
                    $sheet->mergeCells('A1:C1');
                }
                $sheet->prependRow(1, [
                    'Attendances'
                ]);
                $sheet->mergeCells('A1:G1');
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
        create_activity('export attendances to excel');
        $this->genExcel(Attendance::all());
    }

    public function excel_filter($time='all')
    {
        create_activity('export attendances to excel with filter');
        $this->genExcel(Attendance::filterTime($time), $time);
    }
}

