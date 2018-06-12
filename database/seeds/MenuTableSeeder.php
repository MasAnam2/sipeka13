<?php

use Illuminate\Database\Seeder;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('menus')->truncate();
    	$data = [

    		[
    			'link'			=> '/departments',
    			'icon'			=> 'fa fa-institution',
    			'text'			=> 'Departments',
    			'modul'			=> 'departments',
    			'order_rule'	=> 	1
    		],


    		[
    			'link'			=> '/positions',
    			'icon'			=> 'fa fa-male',
    			'text'			=> 'Positions',
    			'modul'			=> 'positions',
    			'order_rule'	=> 	2
    		],


    		[
    			'link'			=> '/employees',
    			'icon'			=> 'fa fa-group',
    			'text'			=> 'Employees',
    			'modul'			=> 'employees',
    			'order_rule'	=> 	3
    		],


    		[
    			'link'			=> '/salary_rules',
    			'icon'			=> 'fa fa-dollar',
    			'text'			=> 'Salary Rules',
    			'modul'			=> 'salary_rules',
    			'order_rule'	=> 	4
    		],


    		[
    			'link'			=> '/attendance/filter/today',
    			'icon'			=> 'fa fa-clock-o',
    			'text'			=> 'Attendances',
    			'modul'			=> 'attendances',
    			'order_rule'	=> 	5
    		],


    		[
    			'link'			=> '/over_time/filter/today',
    			'icon'			=> 'fa fa-coffee',
    			'text'			=> 'Over time',
    			'modul'			=> 'over_time',
    			'order_rule'	=> 	6
    		],


    		[
    			'link'			=> '/accounts',
    			'icon'			=> 'fa fa-user',
    			'text'			=> 'Accounts',
    			'modul'			=> 'accounts',
    			'order_rule'	=> 	8
    		],


    		[
    			'link'			=> '/salaries',
    			'icon'			=> 'fa fa-money',
    			'text'			=> 'Salaries',
    			'modul'			=> 'salaries',
    			'order_rule'	=> 	9
    		],


    		[
    			'link'			=> '/company-profile',
    			'icon'			=> 'fa fa-building-o',
    			'text'			=> 'Company Profile',
    			'modul'			=> 'company_profile',
    			'order_rule'	=> 	10
    		],


    		[
    			'link'			=> '/loans',
    			'icon'			=> 'fa fa-credit-card',
    			'text'			=> 'Loans',
    			'modul'			=> 'loans',
    			'order_rule'	=> 	7
    		],


    		[
    			'link'			=> '/docs',
    			'icon'			=> 'fa fa-book',
    			'text'			=> 'Documentation',
    			'modul'			=> 'docs',
    			'order_rule'	=> 	11
    		],
    	];
    	DB::table('menus')->insert($data);
    }
}
