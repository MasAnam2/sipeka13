<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Loan extends Model
{
	public $timestamps = false;
	protected $guarded = [];

	public function emp()
	{
		return $this->belongsTo('App\Models\Employee', 'employee');
	}

	public function scopeFilterTime($query, $month, $year)
	{
		if($month != 'all')
			$query = $query->whereMonth('created_at', $month);
		if($year != 'all')
			$query = $query->whereYear('created_at', $year);
		return $query;
	}

	public function scopeData($query, $month='all', $year='all')
	{
		return $query->filterTime($month, $year)->latest()->get();
	}

	public function scopeTotal($query)
	{
		return $query->where('status', '0')->sum('total');
	}
}
