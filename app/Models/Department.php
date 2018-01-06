<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];
    protected $hidden = ['id'];

    public function scopeDepartments_select($query)
    {
    	$dept = [];
    	foreach ($query->orderBy('name')->get() as $d) {
    		$dept = array_add($dept, $d->id, $d->name);
    	}
    	return $dept;
    }

    public static function department_name($id)
    {
        return parent::find($id)->name;
    }

    public static function data()
    {
        return parent::orderBy('id', 'asc')->get();
    }

    public function scopeGetData($q)
    {
        return $q->orderBy('id', 'asc')->get();
    }

    public function salaryRules()
    {
        return $this->hasManyThrough('App\Models\SalaryRule', 'App\Models\Employee', 'department_id', 'employee');
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
