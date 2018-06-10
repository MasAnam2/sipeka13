<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use Auth;

class SettingController extends Controller
{

	public function menu()
	{
		$menus = [];
		foreach(Menu::orderBy('order_rule')->get() as $menu){
			$modul = $menu->modul;
			if(Auth::user()->authority()->first()->$modul){
				array_push($menus, $menu);
				
			}else if($menu->modul == 'docs'){
				array_push($menus, $menu);
			}
		}
		return $menus;
	}

}
