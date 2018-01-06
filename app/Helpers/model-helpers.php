<?php 
use App\Models\Position;
function position()
{
	return new Position();
}

use App\Models\Department;
function department()
{
	return new Department();
}

use App\Models\Employee;
function employee()
{
	return new Employee();
}