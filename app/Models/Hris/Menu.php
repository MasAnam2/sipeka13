<?php

namespace App\Models\Hris;

use Illuminate\Database\Eloquent\Model;
class Menu extends Model
{
	protected $table = 'hris_setting_menus';
	public $timestamps = false;
	protected $fillable = ['theme'];
}
