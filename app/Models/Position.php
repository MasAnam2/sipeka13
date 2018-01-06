<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{

	public $timestamps = false;
	protected $fillable = ['name'];
	protected $hidden = ['id'];

	public static function position_name($id)
	{
		return parent::find($id)->name;
	}

	public static function positions_select()
	{
		$positions = parent::all();
		$pos = [];
		foreach ($positions as $d) {
			$pos = array_add($pos, $d->id, $d->name);
		}
		return $pos;
	}

	public static function data()
	{
		return parent::orderBy('name')->get();
	}

	public function scopeGetData($q)
    {
        return $q->orderBy('name')->get();
    }

	public function scopeExcel($q)
    {
        $data = [];
        $i = 1;
        foreach ($q->getData() as $d) {
            $data[] = [
                '#' => $i++,
                'Name' => $d->name
            ];
        }
        return $data;
    }
}
