<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Authority extends Model
{
	public $timestamps = false;
	protected $guarded = [];

	public static function allowed($module)
	{
		return parent::where('user', Auth::id())->first()->$module==1;
	}
}