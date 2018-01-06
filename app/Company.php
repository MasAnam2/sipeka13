<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'company';
    protected $fillable = ['name', 'contact', 'email', 'fb_link', 'address', 'logo_export'];
    public $timestamps = false;
}
