<?php

namespace App\Http\Controllers\Hris;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Hris\Calendar as C;

class CalendarController extends Controller
{

    public function __construct()
    {
        parent::set_table(C::class);
    }

    public function dt()
    {
        $data = array();
        $no = 1;
        foreach (C::all() as $d) {
            $data[] = [
            $no++,
            month_name($d->month).' '.$d->date,
            $d->event,
            get_edit_button($d->id, route('special_day.edit'), 'small').
            get_delete_button($d->id, route('special_day.remove'))
            ];
        }
        return ['data'=>$data];
    }

    public function remove(Request $r)
    {
        C::find($r->id)->delete();
        parent::create_activity('Delete special day');
        return parent::deleted();
    }

    public function edit(Request $r)
    {
        return view('hris.calendars.edit', ['d'=>C::find($r->id)]);
    }

    private function data($id = null)
    {
        if($id==null)
            return C::all();
        else if(is_array($id))
            return C::where($id)->get();
        return C::find($id);
    }

    public function index(Request $r)
    {
        if(!$r->ajax())
            return redirect('hris');
        $oper = array(
            'data'          => $this->data(['month'=>(int) date('m')])
            );
        return view('hris.calendars.index', $oper);
    }

    public function add()
    {
        parent::not_allowed('special_day');
        $oper = array(
          'title'			=> 'Add Special Day'.title(),
          'data'          => $this->data(),
          'modul'			=> 'calendar',
          'action'		=> route('calendar.create'),
          'back'			=> route('calendars'),
          'profile'       => $this->profile()
          );
        return view('hris.calendars.view', $oper);
    }

    private $rules = [
    'date'         => 'required|numeric|min:1|max:31',
    'month'        => 'required|numeric|min:1|max:12',
    'event'        => 'required'
    ];

    public function create(Request $r)
    {
        $this->validate($r, $this->rules);
    	C::create($r->all());
        parent::create_activity('Added new special day');
        return parent::created();
    }

    public function update(Request $r)
    {
        $this->validate($r, $this->rules);
        C::find($r->id)->update($r->all());
        parent::create_activity('Updated special day');
        return parent::updated();
    }
}
