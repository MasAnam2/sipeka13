<?php

namespace App\Http\Controllers\Docs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmployeeController extends Controller
{
	public function create(Request $r)
	{
		if($r->ajax())
			return view('docs.employees.ajax_create');
		return view('docs.employees.create');
	}

	public function edit(Request $r)
	{
		if($r->ajax())
			return view('docs.employees.ajax_edit');
		return view('docs.employees.edit');
	}

	public function delete(Request $r)
	{
		if($r->ajax())
			return view('docs.employees.ajax_delete');
		return view('docs.employees.delete');
	}

	public function deleteSelected(Request $r)
	{
		if($r->ajax())
			return view('docs.employees.ajax_delsel');
		return view('docs.employees.delsel');
	}

	public function detail(Request $r)
	{
		if($r->ajax())
			return view('docs.employees.ajax_detail');
		return view('docs.employees.detail');
	}

	public function other(Request $r)
	{
		if($r->ajax())
			return view('docs.employees.ajax_other');
		return view('docs.employees.other');
	}
}
