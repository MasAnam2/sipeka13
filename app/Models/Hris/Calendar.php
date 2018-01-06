<?php

namespace App\Models\Hris;

use Illuminate\Database\Eloquent\Model;
class Calendar extends Model
{
	protected $table = 'hris_calendars';
	public $timestamps = false;
	protected $fillable = ['date', 'month', 'event'];
}
