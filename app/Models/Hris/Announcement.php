<?php

namespace App\Models\Hris;

use Illuminate\Database\Eloquent\Model;
class Announcement extends Model
{
	protected $table = 'hris_announcements';
	public $timestamps = false;
	protected $fillable = ['created_at', 'show_at', 'until_at', 'content','title', 'color'];
}
