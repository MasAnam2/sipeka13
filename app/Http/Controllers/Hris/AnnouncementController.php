<?php

namespace App\Http\Controllers\Hris;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hris\Announcement as A;

class AnnouncementController extends Controller
{
    public function __construct()
    {
        parent::__construct('announcements', $this->data());
        parent::set_table(A::class);
    }

    private function data($id=null)
    {
        if($id==null)
            return A::latest()->get();
        return A::find($id);
    }
    
    public function index(Request $r)
    {
         if(!$r->ajax())
            return redirect()->route('hris');
        $oper = array(
            'data'          => $this->data()
        );
        return view('announcements.index', $oper);
    }

    private function sd($r)
    {
        return [
            'content'       => $r->content,
            'show_at'       => $r->show_at,
            'until_at'      => $r->until_at,
            'title'         => $r->title,
            // 'color'         => $r->color,
        ];
    }

    public function dt()
    {
        $data = array();
        $no = 1;
        foreach ($this->data() as $d) {
            $data[] = [
                $no++,
                $d->title,
                $d->content,
                english_date($d->created_at).' '.get_time($d->created_at),
                english_date($d->show_at).' '.get_time($d->show_at),
                english_date($d->until_at).' '.get_time($d->until_at),
                ed_btn($d->id).
                del_btn($d->id)
            ];
        }
        return ['data'=>$data];
    }

    private $rules = ['content'=>'required', 'title'=>'required', 'show_at'=>'required', 'until_at'=>'required'];

    public function create(Request $r)
    {
        $this->validate($r, $this->rules);
        if(strtotime($r->until_at)<strtotime($r->show_at))
            return response('Date range is invalid!!!', 422);
        A::create($this->sd($r));
        parent::create_activity('Added new announcement');
        return parent::created();
    }

    public function edit($id)
    {
        $data = $this->data($id);
        $oper = array(
            'title'     => 'Edit Announcement'.title(),
            'modul'     => 'announcement',
            'data'      => $data,
            'action'    => route('announcement.update', $id),
            'back'      => route('announcements'),
            'profile'       => $this->profile()
        );
        return view('announcements.edit', $oper);
    }

    public function update(Request $r)
    {
        if(strtotime($r->until_at)<strtotime($r->show_at))
            return redirect()->back()->withInput()->with('failed', 'Date range is invalid!!!');
        $this->validate($r, ['content'=>'required', 'title'=>'required']);
        A::find($r->id)->update($this->sd($r));
        parent::create_activity('Edited announcement');
        return redirect()->route('announcements')->with('success', 'Data has been updated');
    }

    
}
