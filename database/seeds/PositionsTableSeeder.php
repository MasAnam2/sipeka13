<?php

use Illuminate\Database\Seeder;

class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('positions')->truncate();
        DB::table('positions')->insert([
        	
        	['name' => 'Manager'],
        	['name' => 'Assitant Manager'],
        	['name' => 'Supervisor'],
        	['name' => 'Secretary Vice Director'],
        	['name' => 'Admin GM'],
        	['name' => 'Admin AP'],
        	['name' => 'Admin AR'],
        	
        	['name' => 'Admin'],
        	['name' => 'Checker'],
        	['name' => 'Driver Forklift'],
        	['name' => 'Driver Vehicle'],
        	['name' => 'Reporting'],
        	['name' => 'Sales'],
        	['name' => 'Helpers Chef'],
        	['name' => 'Konjak'],
        	
        	['name' => 'Cashier'],
        	['name' => 'Head Security'],
        	['name' => 'Debt Collector'],
        	['name' => 'Helpers'],
        	['name' => 'Head Depo'],
        	['name' => 'Admin Depo'],
        	['name' => 'Sales Depo'],
        	
        	['name' => 'Sales District Baucau'],
        	['name' => 'Sales District Oecussie'],
        	['name' => 'Sales District Suai'],
        	['name' => 'Sales District Maliana'],
        	
        	['name' => 'Sales Dili'],
        	['name' => 'Sales District Lospalos'],
        	['name' => 'Branding & Promotion'],
        	['name' => 'Fakturis Display'],
        	['name' => 'Fakturis Unilever'],
        	
        	['name' => 'Fakturis BAL'],
        	['name' => 'Fakturis Rice Sugar'],
        	['name' => 'Fakturis Mix'],
        	['name' => 'Fakturis Canvas'],
        ]);
    }
}
