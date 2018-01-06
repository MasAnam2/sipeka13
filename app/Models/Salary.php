<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Salary extends Model
{
	public $timestamps = false;
	protected $guarded = [];
	protected $appends = ['clear_salary'];

	public function emp()
	{
		return $this->belongsTo('App\Models\Employee', 'employee');
	}

	public function sr()
	{
		return $this->belongsTo('App\Models\SalaryRule', 'salary_rule');
	}

	public function scopeData($q, $id = null)
	{
		if($id)
			return $q->with(['sr', 'emp.dep', 'emp.pos'])->whereId($id)->first();
		return $q->with(['sr', 'emp.dep', 'emp.pos'])->get();
	}

	public function scopeGetData($q, $date)
	{
        $year = (int) substr($date, 0, 4);
        $month = (int) substr($date, 5, 2);
		return $q->with(['sr', 'emp'])
        ->join('employees', 'employees.id', '=', 'salaries.employee')
        ->select(['employees.ein', 'salaries.*'])
        ->where('month', $month)
        ->where('year', $year)
        ->orderBy('ein')
        ->get();
	}

	public function getClearSalaryAttribute($value)
	{
		$clear = (
			$this->sr->basic_salary + $this->sr->transportation + $this->sr->allowance + $this->sr->incentive + $this->sr->eat_cost +
			$this->thr + $this->reward + $this->over_time_total) - 
		(
			$this->punishment+$this->loan
		);
		return $clear;
	}

	public function scopeExcel($q, $date)
	{
		$data = [];
		$no = 1;
		foreach($this->getData($date) as $d){
			$data[] = [
				'#' => $no++,
				'Employee' => '('.$d->emp->ein.') '.$d->emp->name,
				'Created At' => english_date($d->created_at),
				'Month' => english_month_name($d->month),
				'Year' => $d->year,
				'Clear Salary' => $d->clear_salary
			];
		}
		return $data; 
	}
}
