<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class OverTime extends Model
{
	public $timestamps = false;
	protected $guarded = [];

    public function emp()
    {
        return $this->belongsTo('App\Models\Employee', 'employee');
    }

    public function scopeFilterTime($query, $time)
    {
        $qry = null;
        switch ($time) {
            case 'today' : 
            $qry = $query->where('created_at', date('Y-m-d')); 
            break;
            case 'yesterday' : 
            $qry = $query->where('created_at', date('Y-m-d', strtotime('-1 days'))); 
            break;
            case 'this_week' : 
            $qry = $query->whereBetween('created_at', [date('Y-m-d', strtotime('-7 days')), date('Y-m-d')]); 
            break;
            case 'this_month' : 
            $qry = $query->whereBetween('created_at', [date('Y-m-1'), date('Y-m-d')]); 
            break;
            default: 
            $qry = $query->where('created_at', $time); 
            break;
        }
        return $qry->with('emp')
        ->join('employees', 'employees.id', '=', 'over_times.employee')
        ->select(['employees.ein', 'over_times.*'])
        ->orderBy('ein')
        ->get();
    }

    public function scopeResultThisMonth($query, $month, $year)
    {
        $pay = $query->whereMonth('created_at', $month)->whereYear('created_at', $year)->sum('pay');
        return $pay ? $pay : 0;
    }
}
