<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
	protected $guarded = [];
	protected $hidden = ['avatar', 'remember_token', 'api_token'];

	public static function data($id=null)
	{
		$data = parent::join('user_menus', 'user_menus.user', '=', 'users.id')
		->join('employees', 'employees.id', '=', 'users.employee')
		->join('positions', 'employees.position', '=', 'positions.id')
		->join('departments', 'departments.id', '=', 'employees.department')
		->selectRaw('positions.name as p_name, departments.name as d_name, employees.name as e_name, users.*, users.id as u_id, user_menus.employee as employee_menu, user_menus.*, employees.ein');
		if($id!=null)
			return $data->where('users.id', $id)->first();
		return $data->where('users.id', '!=', 1)->get();
	}

	public function authority()
	{
		return $this->hasOne('App\Models\Authority', 'user');
	}

	public function emp()
	{
		return $this->belongsTo('App\Models\Employee', 'employee');
	}	

	public function authorized($modul)
	{
		return $this->menu()->$modul == 1;
	}

	public static function menu()
	{
		return parent::find(auth()->id())->authority()->first();
	}

	public function scopeGetData($q)
	{
		return $q->with('emp')->where('id', '!=', '1')->get();
	}
}
