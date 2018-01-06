<?php

namespace App\Models\Hris;

use Illuminate\Database\Eloquent\Model;
class ApplicationSetting extends Model
{
	protected $table = 'hris_application_settings';
	public $timestamps = false;
	protected $fillable = ['name'];
}
