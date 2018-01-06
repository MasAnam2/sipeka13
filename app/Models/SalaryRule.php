<?php

namespace App\Models;

use App\Models\Department;
use Illuminate\Database\Eloquent\Model;

class SalaryRule extends Model
{

	public $timestamps = false;
	protected $guarded = [];

	public function emp()
	{
		return $this->belongsTo('App\Models\Employee', 'employee');
	}

	public function scopeData($query, $dept = 'all')
	{
		if($dept == 'all')
			return $query->where('status', '1')->get();
		return Department::find($dept)->salaryRules()->where('status', '1')->get();
	}

}
