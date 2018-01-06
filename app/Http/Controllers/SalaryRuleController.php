<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalaryRule;
use Excel;
use PDF;

class SalaryRuleController extends Controller
{

	private function view($r, $oper)
	{
		if($r->ajax())
			return view('salary_rules.ajax_index', $oper);
		return view('salary_rules.index', $oper);
	}

	public function index(Request $r)
	{
		create_activity('accessing salary rules menu');
		$oper = [
			'department' => 'all',
			'dt_url'     => route('salary_rule.dt')
		];
		return $this->view($r, $oper);
	}

	public function filter(Request $r, $dept)
	{
		create_activity('accessing salary rule menu with filter');
		$oper = [
			'department' => $dept,
			'dt_url'     => route('salary_rule.dt_filter', [$dept])
		];
		return $this->view($r, $oper);
	}

	private function generateDt($datas)
	{
		$data = array();
		$no = 1;
		foreach ($datas as $d) {
			$data[] = [
				cb_del($d->id),
				$no++,
				'('.$d->emp->ein.') '.$d->emp->name,
				rupiah($d->basic_salary),
				rupiah($d->allowance),
				rupiah($d->eat_cost),
				rupiah($d->transportation),
				get_edit_button($d->id, route('salary_rule.edit'), 'Salary Rule', 'modal-sm').
				get_delete_button($d->id, route('salary_rule.remove'))
			];
		}
		return ['data'=>$data];
	}

	public function dt()
	{
		return response($this->generateDt(SalaryRule::data()));
	}

	public function dt_filter($dept = 'all')
	{
		return response($this->generateDt(SalaryRule::data($dept)));
	}


	private $rules   = [
		'allowance'      => "required|numeric|min:0",
		'basic_salary'   => "required|numeric|min:0",
		'eat_cost'       => "required|numeric|min:0",
		'transportation' => "required|numeric|min:0",
		'employee'       => "required|numeric|min:0",
	];

	public function create(Request $r)
	{
		$this->validate($r, $this->rules);
		$sd = $r->all()+['status' => '1'];
		$sr = SalaryRule::where('employee', $r->employee);
		if($sr->count())
			$sr->update(['status' => '0']);
		SalaryRule::create($sd);
		return response('salary rule has been created');
	}

	public function edit(Request $r)
	{
		return view('salary_rules.edit', ['data'=>SalaryRule::find($r->id)]);
	}

	public function update(Request $r)
	{
		$this->validate($r, $this->rules);
		$emp = SalaryRule::find($r->id)->employee;
		SalaryRule::where('employee', $emp)->update(['status' => '0']);
		$sd = array_except($r->all()+['status' => '1'], ['id']);
		SalaryRule::create($sd);
		return response('salary rule has been updated');
	}

	private function deleteFromDB($id)
	{
		$salary_rule = SalaryRule::find($id);
		$salary_rule->delete();
	}

	public function remove(Request $r)
	{
		SalaryRule::find($r->id)->delete();
		create_activity('delete salary rule');
		return response('salary rule has been deleted');
	}

	public function deleteSelected(Request $r)
	{
		create_activity('delete selected salary rule');
		$selected_id = array_flatten($r->id);
		SalaryRule::destroy($selected_id);
		return response('salary rule selected has been deleted');
	}

    #EXPORT

	public function to_print($data=null)
	{
		create_activity('print salary rules');
		return view('salary_rules.export.print', [
			'data' => SalaryRule::whereStatus('1')->get(), 
			'dept' => 'all'
		]);
	}

	public function to_print_filter($dept='all')
	{
		create_activity('print salary rules filter by department');
		if($dept == 'all')
			return redirect()->route('salary rule.print');
		$salary_rules = SalaryRule::data($dept);
		return view('salary_rules.export.print', ['data' => $salary_rules, 'dept' => $dept]);
	}

	public function pdf()
	{
		create_activity('export salary_rules to pdf');
		return PDF::loadView('salary_rules.export.print', [
			'data' => SalaryRule::data()
		])->setPaper('a4', 'landscape')
		->download(str_slug(companyName().' salary rules '.now()).'.pdf');
	}

	public function pdf_filter($dept='all')
	{
		create_activity('export salary rules to pdf with filter');
		if($dept == 'all')
			return redirect()->route('salary_rule.pdf');
		$salary_rules = SalaryRule::data($dept);
		return generate_pdf(fileNameWithPrefix('salary_rules'), 'salary_rules.export.print', $salary_rules, true, ['dept' => $dept]);
	}

	private function generateExcel($filename, $dept, $filter = false)
	{
		Excel::create($filename, function($excel) use ($dept, $filter){
			$excel->setTitle(companyName().' Salary Rules');
			$excel->setCreator(companyName())->setCompany(companyName());
			$excel->setDescription(companyName().' Salary Rules');
			$excel->sheet('data', function($sheet) use ($dept, $filter){
				$datas = [];
				$no = 1;
				foreach (SalaryRule::data($dept) as $d) {
					$arr                  = [
						'#'                   => $no++,
						'Employee'            => '('.$d->emp->ein.') '.$d->emp->name,
						'Basic Salary (Rp)'   => $d->basic_salary ? (double) $d->basic_salary : '0',
						'Allowance (Rp)'      => $d->allowance ? (double) $d->allowance : '0',
						'Eat Cost (Rp)'       => $d->eat_cost ? (double) $d->eat_cost : '0',
						'Transportation (Rp)' => $d->transportation ? (double) $d->transportation : '0',
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
						'Department : '.department()->find($dept)->name
					));
					$sheet->mergeCells('A1:C1');
				}
				$sheet->prependRow(1, [
					'Salary Rules'
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
		create_activity('export salary rules to excel');
		$this->generateExcel(str_slug(companyName(), '_').'_salary_rules_'.date('Y_m_d_h_i_s'), 'all');
	}

	public function excel_filter($dept='all')
	{
		create_activity('export salary_rules to excel with filter');
		$this->generateExcel(str_slug(companyName(), '_').'_salary_rules_filter_by_department_'.date('Y_m_d_h_i_s'), $dept, true);
	}

}
