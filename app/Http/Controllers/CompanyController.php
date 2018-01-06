<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateCompProfile;
use App\Company;

class CompanyController extends Controller
{
	
	public function index(Request $r)
	{
		$data = Company::find(1);
		$oper = ['d' => $data];
		if($r->ajax())
			return view('company_profile.ajax_index', $oper);
		return view('company_profile.index', $oper);
	}

	public function edit()
	{
		$data = Company::find(1);
		$oper = ['d' => $data];
		return view('company_profile.edit', $oper);
	}

	public function update(UpdateCompProfile $r)
	{
		$file = $r->file('logo_export');
		$data = [
			'name' => $r->name,
			'contact' => $r->contact,
			'email' => $r->email,
			'fb_link' => $r->fb_link,
			'address' => $r->address,
		];
		if($file){
			$data['logo_export'] = $file->store('/spk/images');
			// $data['logo_export'] = $file->storeAs('/spk/images', 'COMPANY_LOGO_EXPORT.'.$file->getClientOriginalExtension());
		}
		Company::find(1)->update($data);
		return 'company profile has been updated';
	}

	public function view(Request $r)
	{
		$data = Company::find(1);
		$oper = ['d' => $data];
		if($r->ajax())
			return view('company_profile.view', $oper);
		return redirect('/company-profile');
	}

	public function data()
	{
		return Company::find(1);
	}

}
