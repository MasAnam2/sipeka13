<?php
// Route::get('/sdsd', function(){
	// App\Models\OverTime::where('SUBSTRING(pay, -3, 3)', '>', 0)->update([
	// 	'pay' => 
	// ]);
// });
Auth::routes();

Route::get('/get-csrf-token', function(){
	return csrf_token();
});

Route::group(['middleware' => 'auth'], function() {

	#MENU
	Route::get('/api/setting/menus', 'SettingController@menu')->name('setting_menu');

	Route::get('/', function(){
		$a = Auth::user()->authority()->first();
		if($a->departments == 1){
			$route = 'departments';
		}else if($a->positions == 1){
			$route = 'positions';
		}else if($a->employees == 1){
			$route = 'employees';
		}else if($a->salary_rules == 1){
			$route = 'salary_rules';
		}else if($a->attendances == 1){
			$route = 'attendances';
		}else if($a->over_time == 1){
			$route = 'over_time';
		}else if($a->loans == 1){
			$route = 'loans';
		}else if($a->accounts == 1){
			$route = 'accounts';
		}else if($a->salaries == 1){
			$route = 'salaries';
		}else if($a->company_profile == 1){
			$route = 'company_profile';
		}
		return redirect()->route($route);
	})->name('/');
	Route::post('/profile/detail', 'Hris\ProfileController@detail')->name('profile.detail');
	Route::get('/profile/edit', 'Hris\ProfileController@edit')->name('profile.edit');
	Route::get('/profile/avatar-leftbar', 'Hris\ProfileController@avatarLeftbar');
	Route::get('/profile/avatar-image', 'Hris\ProfileController@avatarImage');
	Route::put('/username/update', 'Hris\ProfileController@username_update')->name('username.update');
	Route::put('/profile/update', 'Hris\ProfileController@update')->name('profile.update');
	Route::put('/avatar/update', 'Hris\ProfileController@avatarupdate')->name('avatar.update');
	Route::put('/password/update', 'Hris\ProfileController@passwordupdate')->name('password.update');
	Route::put('/password/reset', 'Hris\ProfileController@reset')->name('password.reset');

	#DEPARTMENT MODUL
	Route::get('/departments', 'DepartmentController@index')->name('departments')->middleware('authority:departments');
	Route::group(['prefix' => 'department', 'middleware'=> ['authority:departments']], function() {
		$c = 'DepartmentController@';
		$r = 'department';
		Route::post('dt', $c.'dt')->name($r.'.dt');
		Route::get('add', $c.'add')->name($r.'.add');
		Route::post('create', $c.'create')->name($r.'.create');
		Route::post('edit', $c.'edit')->name($r.'.edit');
		Route::put('update', $c.'update')->name($r.'.update');
		Route::delete('remove', $c.'remove')->name($r.'.remove');
		deleted_selected_route($c, $r);
		export_route($c, $r);
	});

	#POSITION MODUL
	Route::get('/positions', 'PositionController@index')->name('positions')->middleware('authority:positions');
	Route::group(['prefix' => 'position', 'middleware'=> ['authority:positions']], function() {
		$c = 'PositionController@';
		$r = 'position';
		Route::post('dt', $c.'dt')->name($r.'.dt');
		Route::post('create', $c.'create')->name($r.'.create');
		Route::post('edit', $c.'edit')->name($r.'.edit');
		Route::put('update', $c.'update')->name($r.'.update');
		Route::delete('remove', $c.'remove')->name($r.'.remove');
		deleted_selected_route($c, $r);
		export_route($c, $r);
	});

	#EMPLOYEE MODUL
	Route::get('/employees', 'EmployeeController@index')->name('employees')->middleware('authority:employees');
	Route::group(['prefix' => 'employee', 'middleware'=> ['authority:employees']], function() {
		$c = 'EmployeeController@';
		$r = 'employee';
		Route::post('dt', $c.'dt')->name($r.'.dt');
		Route::post('create', $c.'create')->name($r.'.create');
		Route::post('edit', $c.'edit')->name($r.'.edit');
		Route::put('update', $c.'update')->name($r.'.update');
		Route::post('detail', $c.'detail')->name($r.'.detail');
		Route::delete('remove', $c.'remove')->name($r.'.remove');
		Route::get('/identity/print/{id}', $c.'identityPrint')->name($r.'.identityPrint');
		Route::get('/identity/excel/{id}', $c.'identityExcel')->name($r.'.identityExcel');
		Route::get('/identity/pdf/{id}', $c.'identityPDF')->name($r.'.identityPDF');
		deleted_selected_route($c, $r);
		export_route($c, $r);
	});

	#SALARY RULES
	$c = 'SalaryRuleController@';
	Route::get('salary_rules', $c.'index')->name('salary_rules')->middleware('authority:salary_rules');
	Route::get('salary_rules/department/{dept}', $c.'filter')->name('salary_rules.filter')->middleware('authority:salary_rules')->where(['dept' => '[0-9]+|all']);
	Route::group(['prefix' => 'salary_rule', 'middleware'=> ['authority:salary_rules']], function() use ($c){
		$r = 'salary_rule';
		Route::post('dt', $c.'dt')->name($r.'.dt');
		Route::post('dt_filter/{dept}', $c.'dt_filter')->name($r.'.dt_filter')->where(['dept' => '[0-9]+|all']);
		Route::post('create', $c.'create')->name($r.'.create');
		Route::post('edit', $c.'edit')->name($r.'.edit');
		Route::put('update', $c.'update')->name($r.'.update');
		Route::delete('remove', $c.'remove')->name($r.'.remove');
		deleted_selected_route($c, $r);
		export_route($c, $r);
		Route::get('/print/department/{dept}', $c.'to_print_filter')->name($r.'.print_filter')->where(['dept' => '[0-9]+|all']);
		Route::get('/pdf/department/{dept}', $c.'pdf_filter')->name($r.'.pdf_filter')->where(['dept' => '[0-9]+|all']);
		Route::get('/excel/department/{dept}', $c.'excel_filter')->name($r.'.excel_filter')->where(['dept' => '[0-9]+|all']);
	});

	#ATTENDANCE MODUL
	$timeRegExp = ['time' => 'today|yesterday|this_week|this_month|([0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1]))'];
	Route::get('/attendances', 'AttendanceController@index')->name('attendances')->middleware('authority:attendances');
	Route::group(['prefix' => 'attendance', 'middleware' => ['authority:attendances']], function() use ($timeRegExp) {
		$c = 'AttendanceController@';
		$r = 'attendance';
		Route::post('dt', $c.'dt')->name($r.'.dt');
		Route::get('filter/{time}', $c.'filter')->name($r.'.filter');
		Route::post('dt_filter/{time}', $c.'dt_filter')->name($r.'.dt_filter');
		Route::post('create', $c.'create')->name($r.'.create');
		Route::post('create_by_excel', $c.'create_by_excel')->name($r.'.create_by_excel');			
		Route::post('edit', $c.'edit')->name($r.'.edit');
		Route::put('update', $c.'update')->name($r.'.update');
		Route::delete('remove', $c.'remove')->name($r.'.remove');
		deleted_selected_route($c, $r);
		export_route($c, $r);
		Route::get('/print/filter/{time}', $c.'to_print_filter')->name($r.'.print_filter')->where($timeRegExp);
		Route::get('/pdf/filter/{time}', $c.'pdf_filter')->name($r.'.pdf_filter')->where($timeRegExp);
		Route::get('/excel/filter/{time}', $c.'excel_filter')->name($r.'.excel_filter')->where($timeRegExp);
	});

	#OVER TIME MODUL
	Route::get('/over_times', 'OverTimeController@index')->name('over_time')->middleware('authority:over_time');
	Route::group(['prefix' => 'over_time', 'middleware' => ['authority:over_time']], function() use ($timeRegExp) {
		$c = 'OverTimeController@';
		$r = 'over_time';
		Route::get('filter/{time}', $c.'filter')->name($r.'.filter');
		Route::post('dt', $c.'dt')->name($r.'.dt');
		Route::post('dt_filter/{time}', $c.'dt_filter')->name($r.'.dt_filter');
		Route::get('dt_filter/{time}', $c.'dt_filter')->name($r.'.dt_filter');
		Route::post('edit', $c.'edit')->name($r.'.edit');
		Route::put('update', $c.'update')->name($r.'.update');
		Route::put('/set-time', $c.'setTime')->name($r.'.set_time');
		Route::delete('remove', $c.'remove')->name($r.'.remove');
		deleted_selected_route($c, $r);
		export_route($c, $r);
		Route::get('/print/filter/{time}', $c.'to_print_filter')->name($r.'.print_filter')->where($timeRegExp);
		Route::get('/pdf/filter/{time}', $c.'pdf_filter')->name($r.'.pdf_filter')->where($timeRegExp);
		Route::get('/excel/filter/{time}', $c.'excel_filter')->name($r.'.excel_filter')->where($timeRegExp);
	});

	#LOANS MODUL
	Route::get('/loans', 'LoanController@index')->name('loans')->middleware('authority:loans');
	Route::group(['prefix' => 'loan', 'middleware' => ['authority:loans']], function() {
		$c = 'LoanController@';
		$r = 'loan';
		Route::get('filter/{month}/{year}', $c.'filter')->name($r.'.filter');
		Route::post('dt_filter/{month}/{year}', $c.'dt_filter')->name($r.'.dt_filter');
		Route::post('dt', $c.'dt')->name($r.'.dt');
		Route::post('create', $c.'create')->name($r.'.create');
		Route::post('edit', $c.'edit')->name($r.'.edit');
		Route::put('update', $c.'update')->name($r.'.update');
		Route::delete('remove', $c.'remove')->name($r.'.remove');
		deleted_selected_route($c, $r);
		export_route($c, $r);
		Route::get('/print/filter/{month}/{year}', $c.'to_print_filter')->name($r.'.print_filter')->where(['month' => '[0-9]+|all', 'year' => '[0-9]+|all']);
		Route::get('/pdf/filter/{month}/{year}', $c.'pdf_filter')->name($r.'.pdf_filter')->where(['month' => '[0-9]+|all', 'year' => '[0-9]+|all']);
		Route::get('/excel/filter/{month}/{year}', $c.'excel_filter')->name($r.'.excel_filter')->where(['month' => '[0-9]+|all', 'year' => '[0-9]+|all']);
	});

	#ACCOUNT MODUL
	Route::get('/accounts', 'AccountController@index')->name('accounts')->middleware('authority:accounts');
	Route::group(['prefix' => 'account', 'middleware' => ['authority:accounts']], function() {
		$c = 'AccountController@';
		$r = 'account';
		Route::post('dt', $c.'dt')->name($r.'.dt');
		Route::post('create', $c.'create')->name($r.'.create');
		Route::post('edit', $c.'edit')->name($r.'.edit');
		Route::put('update', $c.'update')->name($r.'.update');
		Route::delete('remove', $c.'remove')->name($r.'.remove');
		deleted_selected_route($c, $r);
		Route::post('detail', $c.'detail')->name($r.'.detail');
		export_route($c, $r);
	});

	#SALARIES MODUL
	$c = 'SalaryController@';
	Route::group(['middleware' => ['authority:salaries'], 'prefix' => 'salaries'], function() use ($c) {
		$dateRegExp = [
			'date' => '([0-9]{4}-(0[1-9]|1[0-2]))|this_period'
		];
		Route::get('/', 'SalaryController@index')->name('salaries');
		Route::post('/dt', $c.'dt')->name('salaries.dt');
		Route::get('/filter/{date}', 'SalaryController@filter')->where($dateRegExp);
		Route::post('/dt_filter/{date}', $c.'dt_filter')->name('salaries.dt_filter')->where($dateRegExp);
		Route::get('/print/filter/{date}', $c.'printFilter')->name('salary.print_filter');
		Route::get('/excel/filter/{date}', $c.'excelFilter')->name('salary.excel_filter');
		Route::get('/pdf/filter/{date}', $c.'pdfFilter')->name('salary.pdf_filter');
	});
	Route::group(['prefix' => 'salary', 'middleware' => ['authority:salaries']], function() {
		$c = 'SalaryController@';
		$r = 'salary';
		Route::post('check', $c.'check')->name($r.'.check');
		Route::get('add', $c.'add')->name($r.'.add');
		Route::post('create', $c.'create')->name($r.'.create');
		Route::post('edit', $c.'edit')->name($r.'.edit');
		Route::put('update', $c.'update')->name($r.'.update');
		Route::delete('remove', $c.'remove')->name($r.'.remove');
		Route::post('detail', $c.'detail')->name($r.'.detail');
		Route::get('{id}/slip/print', $c.'slip')->name($r.'.slip.print');
		Route::get('{id}/slip/excel', $c.'slipExcel')->name($r.'.slip.excel');
		Route::get('{id}/slip/pdf', $c.'slipPDF')->name($r.'.slip.pdf');
		export_route($c, $r);
	});

	#COMPANY PROFILE
	Route::group(['prefix' => 'company-profile', 'middleware' => ['authority:company_profile']], function() {
		Route::get('/', 'CompanyController@index')->name('company_profile');
		Route::get('/view', 'CompanyController@view');
		Route::get('/data', 'CompanyController@data');
		Route::get('/edit', 'CompanyController@edit');
		Route::put('/update', 'CompanyController@update')->name('company_profile.update');
	});


	# DOCUMENTATION
	Route::group(['prefix' => 'docs'], function(){
		Route::get('/', 'DocController@index');
		Route::group(['prefix' => 'departments', 'namespace' => 'Docs'], function(){
			Route::get('/create', 'DepartmentController@create');
			Route::get('/edit', 'DepartmentController@edit');
			Route::get('/delete', 'DepartmentController@delete');
			Route::get('/delete-selected', 'DepartmentController@deleteSelected');
		});
		Route::group(['prefix' => 'positions', 'namespace' => 'Docs'], function(){
			Route::get('/create', 'PositionController@create');
			Route::get('/edit', 'PositionController@edit');
			Route::get('/delete', 'PositionController@delete');
			Route::get('/delete-selected', 'PositionController@deleteSelected');
		});
		Route::group(['prefix' => 'employees', 'namespace' => 'Docs'], function(){
			Route::get('/create', 'EmployeeController@create');
			Route::get('/detail', 'EmployeeController@detail');
			Route::get('/edit', 'EmployeeController@edit');
			Route::get('/delete', 'EmployeeController@delete');
			Route::get('/delete-selected', 'EmployeeController@deleteSelected');
			Route::get('/other', 'EmployeeController@other');
		});
	});
});