<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class SystemActivity extends Model
{
	public $timestamps = false;
	protected $fillable = ['created_at', 'event', 'user'];
}
