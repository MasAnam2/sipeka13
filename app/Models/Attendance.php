<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Attendance extends Model
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
        ->join('employees', 'employees.id', '=', 'attendances.employee')
        ->select(['employees.ein', 'attendances.*'])
        ->orderBy('ein')
        ->get();
    }

    public function scopeResultThisMonth($query, $month, $year)
    {
        return $query->whereMonth('created_at', $month)
        ->whereYear('created_at', $year)
        ->selectRaw('*, count(*) as total')
        ->groupBy('status')
        ->orderBy('status')
        ->get();
    }

}
