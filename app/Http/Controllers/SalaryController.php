<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salary;
use App\Models\Employee;
use App\Models\Attendance;
use Excel;

class SalaryController extends Controller
{

    private function view($r, $oper)
    {
        if($r->ajax())
            return view('salaries.ajax_index', $oper);    
        return view('salaries.index', $oper);
    }

    public function index(Request $r)
    {
        create_activity('accessing salaries menu');
        $oper = ['date' => date('Y-m'), 'dt_url' => route('salaries.dt')];
        return $this->view($r, $oper);
    }

    public function filter(Request $r, $date)
    {
        if($date == 'this_period'){
            $date = date('Y-m');
        }
        create_activity('accessing salaries menu with filter');
        $oper = ['date' => $date, 'dt_url' => route('salaries.dt_filter', [$date])];
        return $this->view($r, $oper);
    }

    private function genDt($DATA){
        $data = array();
        $no = 1;
        foreach ($DATA as $d) {
            $clear = (
                $d->sr->basic_salary + $d->sr->transportation + $d->sr->allowance + $d->sr->incentive + $d->sr->eat_cost +
                $d->thr + $d->reward + $d->over_time_total) - 
            (
                $d->sr->bpjs + $d->punishment + $d->loan
            );
            $data[] = [
                cb_del($d->id),
                $no++,
                '('.$d->emp->ein.') '.$d->emp->name,
                english_date($d->created_at),
                english_month_name($d->month).', '.$d->year,
                number_format($clear, 2, ',', '.'),
                get_detail_button($d->id, route('salary.detail'), 'Salary').
                get_edit_button($d->id, route('salary.edit'), 'Salary', 'modal-lg').
                get_delete_button($d->id, route('salary.remove')).
                get_salary_slip_button(route('salary.slip.print', [$d->id])).
                getExcelBtn(route('salary.slip.excel', [$d->id]), 'Export Salary Slip to Excel').
                getPDFBtn(route('salary.slip.pdf', [$d->id]), 'Export Salary Slip to PDF')
            ];
        }
        return $data;
    }

    public function dt(Request $r)
    {
        return $this->dt_filter($r, date('Y-m'));
    }

    public function dt_filter(Request $r, $date)
    {
        $data = Salary::getData($date);
        return [
            'data' => $this->genDt($data)
        ];
    }

    private $rules    = [
        "employee"        => "required",
        "created_at"      => "required|date_format:Y/m/d",
        "month"           => "required|numeric|min:1",
        "year"            => "required|numeric|min:2000",
        "over_time_total" => "required|numeric|min:0",
        "loan"            => "required|numeric|min:0",
        "thr"             => "required|numeric|min:0",
        "reward"          => "required|numeric|min:0",
        "punishment"      => "required|numeric|min:0",
    ];

    public function check(Request $r)
    {
        $employee         = Employee::find($r->employee);
        $sr               = $employee->salary_rules()->where('status', '1')->first();
        $srExist          = $employee->salary_rules()->where('status', '1')->count() > 0;
        if(!$srExist)
            return view('salaries.contact_admin');
        $basic_salary     = $srExist ? $sr->basic_salary : 0 ;
        $allowance        = $srExist ? $sr->allowance : 0 ;
        $transportation   = $srExist ? $sr->transportation : 0 ;
        $eat_cost         = $srExist ? $sr->eat_cost : 0 ;
        $loanExist        = $employee->loans()->where('status', '0')->count() > 0;
        $resultLoans      = $loanExist ? $employee->loans()->where('status', '0')->sum('total') : 0 ;
        $overtimeExist    = $employee->over_times()->whereMonth('created_at', $r->month)->whereYear('created_at', $r->year)->count()>0;
        $resultOverTime   = $overtimeExist ? $employee->over_times()->resultThisMonth($r->month, $r->year) : 0 ;
        $resultAttendance = $employee->attendances()->resultThisMonth($r->month, $r->year);
        $att              = [0, 0, 0];
        if(count($resultAttendance)){
            foreach (attendance_status_array() as $key => $value) {
                foreach ($resultAttendance as $k => $v) {
                    if($key == $v->status){
                        $att[$v->status] = $v->total;
                    }
                }
            }   
        }
        $oper                = [
            'basic_salary'       => $basic_salary,
            'allowance'          => $allowance,
            'transportation'     => $transportation,
            'eat_cost'           => $eat_cost,
            'loan'               => $resultLoans,
            'attendances'        => $att,
            'result_over_time'   => $resultOverTime,
            'temp_total_no_loan' => $basic_salary+$allowance+$eat_cost+$transportation+$resultOverTime,
            'salary_rule'        => $sr->id
        ];
        return view('salaries.content', $oper);
    }

    public function create(Request $r)
    {
        $this->validate($r, $this->rules);
        create_activity('add new salary');
        $sd                  = [
            'created_at'         => $r->created_at,
            'employee'           => $r->employee,
            'loan'               => $r->loan,
            'month'              => $r->month,
            'over_time_total'    => $r->over_time_total,
            'punishment'         => $r->punishment,
            'reward'             => $r->reward,
            'salary_rule'        => $r->salary_rule,
            'thr'                => $r->thr,
            'year'               => $r->year,
        ];
        $s = Salary::where(['month' => $r->month, 'year' => $r->year, 'employee' => $r->employee]);
        if($s->count() > 0){
            $res = 'salary has been updated';
            $s->update($sd);
        }else{
            $res = 'new salary has been added';
            Salary::create($sd);
        }
        if($r->pay == '1'){
            Employee::find($r->employee)->loans()->update(['status' => '1']);
        }
        return response($res);
    }

    public function edit(Request $r)
    {
        $S = Salary::data($r->id);
        $attendances = $this->get_attendances($S->month, $S->year, $S->employee);
        return view('salaries.edit', [
            'data' => $S, 
            'attendances' => $attendances
        ]);
    }

    public function update(Request $r)
    {
        $this->validate($r, $this->rules);
        S::find($r->id)->update($r->all());
        parent::create_activity('update salary');
        return parent::updated();
    }

    private function get_attendances($month, $year, $employee)
    {
        $At = Attendance::whereMonth('created_at', $month)
        ->whereYear('created_at', $year)
        ->whereEmployee('employee', $employee)
        ->selectRaw('*, count(*) as total')
        ->groupBy('status')
        ->orderBy('status')
        ->get()
        ->toArray();
        $Attendances = [];
        for($i=1; $i<=8; $i++){
            $Attendances[absence_status($i)] = 0;
            foreach ($At as $key => $value) {
                if($value['status'] == $i){
                    $Attendances[absence_status($i)] = $value['total'];
                    break;
                }
            }
        }
        return (object) $Attendances;
    }

    public function detail(Request $r)
    {
        $S = Salary::with(['sr', 'emp.dep', 'emp.pos'])->whereId($r->id)->first();
        // return $S;
        $At = Attendance::whereMonth('created_at', $S->month)
        ->whereYear('created_at', $S->year)
        ->whereEmployee('employee', $S->employee)
        ->selectRaw('*, count(*) as total')
        ->groupBy('status')
        ->orderBy('status')
        ->get()
        ->toArray();
        $Attendances = [];
        for($i=1; $i<=8; $i++){
            $Attendances[absence_status($i)] = 0;
            foreach ($At as $key => $value) {
                if($value['status'] == $i){
                    $Attendances[absence_status($i)] = $value['total'];
                    break;
                }
            }
        }
        return view('salaries.detail', ['data'=>$S, 'attendances'=> (object) $Attendances]);
    }

    public function remove(Request $r)
    {
        Salary::find($r->id)->delete();
        create_activity('Delete salary');
        return 'Salary has been deleted';
    }

    public function slip($id)
    {
        return view('salaries.export.slip', [
            'data' => Salary::data($id)
        ]);
    }

    public function slipPDF($id)
    {
        return parent::genPDF('salaries.export.slip', [
            'data' => Salary::data($id)
        ], 'salary slip');
    }

    public function slipExcel($id)
    {
        $data = Salary::data($id);
        Excel::create(str_slug(companyName().' salary slip '.now()), function($excel) use ($data) {
            $excel->setTitle('Salary Slip');
            $excel->setCreator(companyName())->setCompany(companyName());
            $excel->setDescription('Salary Slip');
            $excel->sheet('data', function($sheet) use ($data) {
                $sheet->prependRow(1, [
                    'Salary Slip'
                ]);
                $sheet->mergeCells('A1:C1');
                $sheet->cell('A1', function($cell){
                    $cell->setFontSize(16);
                    $cell->setFontWeight('bold');
                    $cell->setAlignment('center');
                });
                $sheet->prependRow(1, [
                    companyName()
                ]);
                $sheet->mergeCells('A1:C1');
                $sheet->cell('A1', function($cell){
                    $cell->setFontSize(16);
                    $cell->setFontWeight('bold');
                    $cell->setAlignment('center');
                });
                $i = 3;
                $sheet->row($i++, ['Employee', $data->emp->name]);
                $sheet->row($i++, ['Department', $data->emp->dep ? $data->emp->dep->name : 'NOT SET']);
                $sheet->row($i++, ['Position', $data->emp->pos ? $data->emp->pos->name : 'NOT SET']);
                $sheet->row($i++, ['']);
                $sheet->row($i++, ['Basic Salary', $data->sr->basic_salary ? $data->sr->basic_salary : '0']);
                $sheet->row($i++, ['Allowance', $data->sr->allowance ? $data->sr->allowance : '0']);
                $sheet->row($i++, ['Transportation', $data->sr->transportation ? $data->sr->transportation : '0']);
                $sheet->row($i++, ['Eat Cost', $data->sr->eat_cost ? $data->sr->eat_cost : '0']);
                $sheet->row($i++, ['Over Time', $data->over_time_total ? $data->over_time_total : '0']);
                $sheet->row($i++, ['Reward', $data->reward ? $data->reward : '0']);
                $sheet->row($i++, ['THR', $data->thr ? $data->thr : '0']);
                $sheet->row($i++, ['', '', '+']);
                $sheet->row($i++, ['', $data->sr->basic_salary+$data->sr->allowance+$data->sr->eat_cost+$data->sr->transportation+$data->thr+$data->reward+$data->over_time_total]);
                $sheet->row($i++, ['Loan', $data->loan]);
                $sheet->row($i++, ['Punishment', $data->punishment]);
                $sheet->row($i++, ['', '', '-']);
                $sheet->row($i++, ['Clear Salary', $data->clear_salary]);
                $sheet->row($i++, [convert_number_to_words($data->clear_salary)]);
                $sheet->row(1, function($row){
                    $row->setFontWeight('bold');
                });
                $sheet->mergeCells('A20:B20');
                $sheet->cell('A20', function($cell) {
                    $cell->setAlignment('right');
                });
            });
        })->export('xlsx');
    }

    #EXPORT

    public function to_print($data=null)
    {
        return $this->printFilter(date('Y-m'));
    }

    public function printFilter($date)
    {
        return view('salaries.export.print', [
            'data' => Salary::getData($date),
            'date' => $date
        ]);
    }

    public function pdf()
    {
        return $this->pdfFilter(date('Y-m'));
    }

    public function pdfFilter($date)
    {
        return parent::genPDF('salaries.export.print', [
            'data' => Salary::getData($date),
            'date' => $date
        ], 'salaries', true);
    }

    public function excel()
    {
        $this->excelFilter(date('Y-m'));
    }

    public function excelFilter($date)
    {
        Excel::create(str_slug(companyName().' salaries '.now()), function($excel) use ($date){
            $excel->setTitle('Salaries');
            $excel->setCreator(companyName())->setCompany(companyName());
            $excel->setDescription('Salaries');
            $excel->sheet('data', function($sheet) use ($date){
                $sheet->with(Salary::excel($date));
                $sheet->row(1, function($row){
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                });
                $sheet->prependRow(1, [
                    english_month_name(substr($date, 5)).', '.substr($date, 0, 4)
                ]);
                $sheet->prependRow(1, [
                    'Salaries'
                ]);
                $sheet->mergeCells('A1:F1');
                $sheet->cell('A1', function($cell){
                    $cell->setFontSize(16);
                    $cell->setFontWeight('bold');
                    $cell->setAlignment('center');
                });
            });
        })->export('xlsx');
    }

}

