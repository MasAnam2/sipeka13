<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminBio extends Model
{
	protected $table = 'admin_bio';
    public $timestamps = false;
    protected $fillable = ['name', 'born_in', 'birthdate', 'gender', 'address'];
}
