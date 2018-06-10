<?php

namespace App\Http\Controllers\Docs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PositionController extends Controller
{
    public function create(Request $r)
    {
    	if($r->ajax())
    		return view('docs.positions.ajax_create');
    	return view('docs.positions.create');
    }

    public function edit(Request $r)
    {
    	if($r->ajax())
    		return view('docs.positions.ajax_edit');
    	return view('docs.positions.edit');
    }

    public function delete(Request $r)
    {
        if($r->ajax())
            return view('docs.positions.ajax_delete');
        return view('docs.positions.delete');
    }

    public function deleteSelected(Request $r)
    {
        if($r->ajax())
            return view('docs.positions.ajax_delsel');
        return view('docs.positions.delsel');
    }
}
