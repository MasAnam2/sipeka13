<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocController extends Controller
{
    public function index(Request $r)
    {
        create_activity('accessing documentation');
        if($r->ajax())
            return view('docs.ajax_index');
        return view('docs.index');
    }
}
