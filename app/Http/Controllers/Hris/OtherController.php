<?php

namespace App\Http\Controllers\Hris;

use App\Http\Requests\CreateDepartment;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hris\AdminMenu           as AM;
use App\Models\Hris\Position            as P;
use App\Models\Hris\Employee            as E;
use App\Models\Hris\Menu                as M;

class OtherController extends Controller
{

    private function storeData($r)
    {
        $store['department']        =  $r->department!=null ? $r->department : 0;
        $store['position']          =  $r->position!=null ? $r->position : 0;
        $store['employee']          =  $r->employee!=null ? $r->employee : 0;
        $store['account']           =  $r->account!=null ? $r->account : 0;
        $store['calendar']          =  $r->calendar!=null ? $r->calendar : 0;
        $store['official_travel']   =  $r->official_travel!=null ? $r->official_travel : 0;
        $store['payroll']           =  $r->payroll!=null ? $r->payroll : 0;
        $store['report']            =  $r->report!=null ? $r->report : 0;
        $store['disabled']          =  $r->disabled!=null ? $r->disabled : 0;
        $store['mutation']          =  $r->mutation!=null ? $r->mutation : 0;
        $store['over_work']         =  $r->over_work!=null ? $r->over_work : 0;
        $store['absence']           =  $r->absence!=null ? $r->absence : 0;
        return $store;
    }
    
    public function setting()
    {
        $data = AM::find(1);
        $oper = array(
            'title'         => 'Settings'.title(),
            'modul'         => 'setting',
            'data'          => $data,
            // 'add'           => route('department.add'),
            // 'disable'       => route('department.disable'),
            'action'        => route('setting.update'),
            'profile'       => $this->profile()
        );
        return view('settings.setting', $oper);
    }

    public function update(Request $r)
    {
        AM::find(1)->update($this->storeData($r));
        parent::create_activity('Updated administrator menu');
        return redirect()->back()->with('success', 'Data has been updated');
    }

    public function update_theme(Request $r)
    {
        M::find(1)->update([
            'theme'     => $r->theme
        ]);
        parent::create_activity('Updated skin application');
        return redirect()->back()->with('success', 'Data has been updated');
    }

    public function app()
    {
        
    }
}