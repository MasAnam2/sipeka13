<?php

use Illuminate\Database\Seeder;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('company')->truncate();
        DB::table('company')->insert([
        	'name'		=> 'PT INDAHNYA BERBAGI',
        	'contact'	=> '085322778935',
        	'address'	=> 'Tanggul Kulon, Jember, Jatim',
        	'email'		=> 'hairulanam21@gmail.com',
        	'fb_link'	=> 'http://facebook.com/hairul.anam.3591'
        ]);
    }
}
