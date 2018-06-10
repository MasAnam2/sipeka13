<?php

namespace App\Http\Controllers\Docs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DepartmentController extends Controller
{
    public function create(Request $r)
    {
    	if($r->ajax())
    		return view('docs.departments.ajax_create');
    	return view('docs.departments.create');
    }

    public function edit(Request $r)
    {
    	if($r->ajax())
    		return view('docs.departments.ajax_edit');
    	return view('docs.departments.edit');
    }

    public function delete(Request $r)
    {
        if($r->ajax())
            return view('docs.departments.ajax_delete');
        return view('docs.departments.delete');
    }

    public function deleteSelected(Request $r)
    {
        if($r->ajax())
            return view('docs.departments.ajax_delsel');
        return view('docs.departments.delsel');
    }
}
