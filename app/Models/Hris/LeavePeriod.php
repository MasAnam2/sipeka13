<?php

namespace App\Models\Hris;

use Illuminate\Database\Eloquent\Model;
class LeavePeriod extends Model
{
	protected $table = 'hris_leave_periods';
	public $timestamps = false;
	protected $fillable = ['special_permit', 'holiday', 'father_leave', 'sick', 'pregnancy', 'employee', 'year'];
}
