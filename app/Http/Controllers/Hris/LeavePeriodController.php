<?php

namespace App\Http\Controllers\Hris;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User as U;
use App\Models\Hris\SubDepartment 			as SD;
use App\Models\Hris\Employee 				as E;
use App\Models\Hris\Authority 				as A;
use App\Models\Hris\Activity 				as Ac;
use App\Models\Hris\LeavePeriod 			as LP;

class LeavePeriodController extends Controller
{
	private $rules;
	private $oper;
	private $oper2;
	private $dt;

	public function __construct()
	{
		$this->rules = [
		'special_permit' => 'required|numeric',
		'holiday'        => 'required|numeric',
		'father_leave'   => 'required|numeric',
		'sick'           => 'required|numeric',
		'pregnancy'      => 'required|numeric'
		];
		$this->oper = [
		'local'         => LP::find(1),
		'international' => LP::find(2)
		];
		$this->dt = LP::join('employees', 'employees.id', '=', 'leave_periods.employee')
		->join('positions', 'positions.id', '=', 'employees.position')
		->join('sub_departments', 'sub_departments.id', '=', 'employees.department')
		->join('departments', 'departments.id', '=', 'sub_departments.department')
		->selectRaw('departments.name as d_name, sub_departments.name as sd_name, positions.name as p_name, employees.name as e_name, leave_periods.*')
		->get();
		$this->oper2 = [
		'data'=> $this->dt
		];
		parent::__construct();
	}

	public function dt()
	{
		$data = array();
		$no   = 1;
		
		foreach ($this->dt as $d) {
			$data[] = [
			$no++,
			$d->d_name.'/'.$d->sd_name,
			$d->p_name,
			$d->e_name,
			$d->special_permit,
			$d->holiday,
			$d->father_leave,
			$d->sick,
			$d->pregnancy,
			$d->year
			];
		}
		return ['data'=>$data];
	}

	public function index(Request $r)
	{
		if(!$r->ajax())
			return redirect('hris');
		return view('leave_periods.index', $this->oper);
	}

	public function edit(Request $r)
	{
		$oper = [
		'data' => LP::find($r->id)
		];
		return view('leave_periods.edit', $oper);
	}

	public function update(Request $r)
	{
		$this->validate($r, $this->rules);
		LP::find($r->id)->update($r->all());
		parent::create_activity('Edited department');
		return parent::updated();
	}

	public function refresh_table(Request $r)
	{
		if(!$r->ajax())
			return redirect('hris');
		return view('leave_periods.fresh_table', $this->oper);
	}

	public function to_print($data=null)
	{
		return view('leave_periods.print', $this->oper);
	}

	public function pdf()
	{
		return parent::to_pdf('Leave Periods', 'leave_periods.print', $this->oper);
	}

	public function excel()
	{
		return parent::to_excel('Leave Periods', 'leave_periods.excel', array_merge($this->oper, ['lisun'=>false]));
	}

	public function employee_print()
	{
		return view('leave_periods.employee_print', $this->oper2);
	}

	public function employee_excel()
	{
		return parent::to_excel('Employees use Leave Period', 'leave_periods.employee_excel', array_merge($this->oper2, ['lisun'=>false]));
	}

	public function employee_pdf()
	{
		return parent::to_pdf('Employees use Leave Periods', 'leave_periods.employee_print', $this->oper2, true);
	}
}