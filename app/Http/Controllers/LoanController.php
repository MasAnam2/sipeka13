<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Loan;
use Excel;

class LoanController extends Controller
{

    private function getDt($datas)
    {
        $data = array();
        $no = 1;
        foreach ($datas as $d) {
            $data[] = [
                cb_del($d->id),
                $no++,
                '('.$d->emp->ein.') '.$d->emp->name,
                english_date($d->created_at),
                rupiah($d->total),
                $d->information,
                loan_status($d->status),
                get_edit_button($d->id, route('loan.edit'), 'Loan', 'modal-sm').
                get_delete_button($d->id, route('loan.remove'))
            ];
        }
        return ['data'=>$data];
    }

    public function dt()
    {
        return $this->getDt(Loan::data());
    }

    public function dt_filter($month, $year)
    {
        return $this->getDt(Loan::filterTime($month, $year)->latest()->get());
    }

    public function index(Request $r)
    {
        $oper = ['month' => 'all', 'year' => 'all'];
        create_activity('accessing loans menu');
        if($r->ajax())
            return view('loans.ajax_index', $oper);
        return view('loans.index', $oper);
    }

    public function filter(Request $r, $month, $year)
    {
        if($month == 'all' && $year == 'all')
            return redirect()->route('loans');
        $oper = ['month' => $month, 'year' => $year];
        create_activity('accessing loans menu with filter');
        if($r->ajax())
            return view('loans.ajax_filter', $oper);
        return view('loans.filter', $oper);
    }

    private $rules = [
        'employee'     => 'required',
        'created_at'   => 'required|date_format:Y/m/d',
        'total'        => 'required|min:500000|numeric',
        'information'  => 'required',
    ];

    public function create(Request $r)
    {
        $this->rules['created_at'] .= '|before:'.date('Y-m-d', strtotime('+1 days'));
        $this->validate($r, $this->rules);
        $done_borrow = Loan::whereMonth('created_at', getMonth($r->created_at))
        ->where('employee', $r->employee)
        ->whereYear('created_at', getYear($r->created_at))
        ->count();
        if($done_borrow)
            return response('Only one every month', 409);
        Loan::create($r->all());
        create_activity('add loan');
        return response('new loan has been added');
    }

    public function edit(Request $r)
    {
        create_activity('accessing loans edit menu');
        $oper = array(
            'data'          => Loan::findOrFail($r->id)
        );
        return view('loans.edit', $oper);
    }

    public function update(Request $r)
    {
        $this->rules['status'] = 'required';
        $this->rules['created_at'] .= '|before:'.date('Y-m-d', strtotime('+1 days'));
        $this->validate($r, $this->rules);
        Loan::find($r->id)->update($r->all());
        create_activity('update loan');
        return response('loan has been updated');
    }

    public function remove(Request $r)
    {
        Loan::find($r->id)->delete();
        create_activity('delete loan');
        return response('loan has been deleted');
    }

    public function deleteSelected(Request $r)
    {
        create_activity('delete selected loan');
        $selected_id = array_flatten($r->all());
        Loan::destroy($selected_id);
        return response('loan selected has been deleted');
    }

    #EXPORT

    public function to_print($data=null)
    {
        create_activity('accessing loans print');
        return view('loans.export.print', ['data' => Loan::latest()->get()]);
    }

    public function to_print_filter($month='all', $year='all')
    {
        create_activity('accessing loans print with filter');
        if($month == 'all' && $year == 'all')
            return redirect()->route('loan.print');
        $loans  = Loan::filterTime($month, $year)->latest()->get();
        $oper   = [
            'data'  => $loans, 
            'month' => $month,
            'year'  => $year
        ];
        return view('loans.export.print_filter', $oper);
    }

    public function pdf()
    {
        create_activity('export to pdf loans');
        return parent::genPDF('loans.export.print', [
            'data' => Loan::latest()->get()
        ], 'loans', true);
    }

    public function pdf_filter($month='all', $year='all')
    {
        create_activity('export to pdf loans with filter');
        if($month == 'all' && $year == 'all')
            return redirect()->route('loan.pdf');
        $loans = Loan::data($month, $year);
        return generate_pdf(fileNameWithPrefix('loans'), 'loans.export.print_filter', $loans, true, ['month' => $month, 'year' => $year]);
    }

    private function generateExcelData($data)
    {
        $datas = [];
        $no    = 1;
        foreach ($data as $d) {
            $arr          =  [
                '#'           => $no++,
                'Employee'    => '('.$d->emp->ein.') '.$d->emp->name,
                'Created At'  => english_date($d->created_at),
                'Total'       => $d->total==0 ? '-' : $d->total,
                'information' => $d->information,
                'Status'      => loan_status($d->status),
            ];
            array_push($datas, $arr);
        }
        return $datas;
    }

    private function genExcel($data, $month = '', $year = ''){
        Excel::create(str_slug(companyName().' loans '.now()), function($excel) use ($data, $month, $year){
            $excel->setTitle(companyName().' Loans');
            $excel->setCreator(companyName())->setCompany(companyName());
            $excel->setDescription(companyName().' Loans');
            $excel->sheet('data', function($sheet) use ($data, $month, $year){
                $sheet->with($data);
                $sheet->row(1, function($row){
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                });
                if($month || $year){
                    $sheet->prependRow(1, array(
                        'Month : '.english_month_name($month).' Year : '.$year
                    ));
                    $sheet->mergeCells('A1:B1');
                }
                $sheet->prependRow(1, [
                    'Loans'
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

    public function excel()
    {
        create_activity('export to excel loans');
        $data = $this->generateExcelData(Loan::latest()->get());
        $this->genExcel($data);
    }

    public function excel_filter($month='all', $year='all')
    {
        create_activity('export to excel loans with filter');
        $data  = $this->generateExcelData(Loan::data($month, $year));
        $this->genExcel($data, $month, $year);
    }

}

