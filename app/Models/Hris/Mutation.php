<?php

namespace App\Models\Hris;

use Illuminate\Database\Eloquent\Model;
class Mutation extends Model
{
	protected $table = 'hris_mutations';
	public $timestamps = false;
	protected $fillable = ['employee', 'old_position', 'new_position', 'reason', 'created_at', 'old_department', 'new_department', 'effect_on', 'manager', 'mutation_id', 'city'];

	public static function data($id=null)
	{
		$data = parent::join('hris_employees', 'hris_employees.id', '=', 'hris_mutations.employee');
        $data->join('hris_positions', 'hris_employees.position', '=', 'hris_positions.id')
        ->join('hris_sub_departments', 'hris_sub_departments.id', '=', 'hris_employees.department')
        ->join('hris_departments', 'hris_departments.id', '=', 'hris_sub_departments.department')
        ->selectRaw('hris_departments.name as d_name, hris_sub_departments.name as sd_name, hris_positions.name as p_name, hris_employees.name as e_name, hris_mutations.*, hris_employees.nin')
        ->latest();
        if($id!=null)
            return $data->where('hris_mutations.id', $id)->first();
        return $data->get();
	}
}
