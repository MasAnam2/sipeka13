<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
	public $timestamps = false;
	protected $guarded = ['old_nin', 'old_ein'];

	public function pos()
	{
		return $this->belongsTo('App\Models\Position', 'position_id');
	}

	public function dep()
	{
		return $this->belongsTo('App\Models\Department', 'department_id');
	}

	public function attendances()
	{
		return $this->hasMany('App\Models\Attendance', 'employee');
	}

	public function over_times()
	{
		return $this->hasMany('App\Models\OverTime', 'employee');
	}

	public function loans()
	{
		return $this->hasMany('App\Models\Loan', 'employee');
	}

	public function salary_rules()
	{
		return $this->hasMany('App\Models\SalaryRule', 'employee');
	}

	public static function employees()
	{
		$E = parent::orderBy('ein', 'asc')->get();
		$em = [];
		foreach ($E as $e) {
			$em = array_add($em, $e->id, '('.$e->ein.') '.$e->name);
		}
		return $em;
	}

	public static function all_employees()
	{
		return parent::join('positions', 'positions.id', '=', 'employees.position')
		->join('sub_departments', 'sub_departments.id', '=', 'employees.department')
		->join('departments', 'departments.id', '=', 'sub_departments.department')
		->selectRaw('employees.*, positions.name as p_name, sub_departments.name as sd_name, departments.name as d_name')
		->orderBy('nin', 'asc')
		->get();
	}

	public static function get_by_department($sub_dept)
	{
		return parent::where('department', $sub_dept)->get();
	}

	public static function data($id=null)
	{
		$data = parent::join('positions', 'positions.id', '=', 'employees.position')
		->join('departments', 'departments.id', '=', 'employees.department')
		->selectRaw('employees.*, positions.name as p_name, departments.name as d_name')
		->orderBy('name', 'asc');
		if($id!=null)
			return $data->where('employees.id', $id)->first();
		return $data->get();
	}

	public function scopeGetData($q, $id = null)
	{
		if($id)
			return $q->with(['dep', 'pos'])->whereId($id)->first();
		return $q->with(['dep', 'pos'])->get();
	}

	public function scopeExcel($q)
	{
		$datas = [];
		foreach ($q->getData() as $d) {
			$arr                        = [
				'EIN'            => $d->ein,
				'NIN'            => $d->nin,
				'Name'           => $d->name,
				'Gender'         => gender($d->gender),
				'Born In'        => $d->born_in,
				'Birthdate'      => invalidDate($d->birthdate) ? 'INVALID' : $d->birthdate,
				'City Now'       => $d->city,
				'Marital Status' => maried($d->marital_status),
				'Last Education' => $d->last_education,
				'Address'        => $d->address,
                // 'Handphone'      => $d->handphone,
				'Joined At'      => invalidDate($d->joined_at) ? 'INVALID' : $d->joined_at,
				'Position'       => $d->pos ? $d->pos->name : 'NOT SET',
				'Department'     => $d->dep ? $d->dep->name : 'NOT SET'
			];
			array_push($datas, $arr);
		}
		return $datas;
	}
}
