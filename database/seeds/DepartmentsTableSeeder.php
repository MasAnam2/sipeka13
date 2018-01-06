<?php

use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    	DB::table('departments')->truncate();
    	DB::table('departments')->insert([
    		
    		['name' => 'Vice Director'],
    		['name' => 'General Manager'],
    		['name' => 'Sales'],
    		['name' => 'Marketing'],
    		['name' => 'Finance'],
    		
    		['name' => 'Fleet & Distribution'],
    		['name' => 'Human Resources Development'],
    		['name' => 'Warehouse'],
    		
    		['name' => 'Purchasing'],
    		['name' => 'Fakturis'],
    		['name' => 'Information Technology'],
    		['name' => 'Security'],
    		['name' => 'District / Depo'],
    		['name' => 'Logistic'],
    		
    		['name' => 'Unilever'],
    		['name' => 'Mix'],
    		['name' => 'Beer Alcohol'],
    		['name' => 'Mix (Food Non Food)'],
    		
    		['name' => 'Rice & Sugar'],
    		['name' => 'Accounting'],
    		['name' => 'Driver Unilever'],
    		['name' => 'General Affair'],
    		
    		['name' => 'Inventory Control'],
    		['name' => 'Invoice Control'],
    		['name' => 'Mix (BAT)'],
    		['name' => 'CocaCola Product'],
    		['name' => 'Driver BAL'],
    		
    		['name' => 'Driver MIX'],
    		['name' => 'Driver Rice Sugar'],
    		['name' => 'Sales District'],
    		['name' => 'Delivery BAL'],
    		['name' => 'Delivery MIX'],
    		
    		['name' => 'Delivery Unilever'],
    		['name' => 'Mix (CocaCola)'],
    		['name' => 'Driver District'],
    		['name' => 'Cashier'],
    		
    		['name' => 'Display'],
    		['name' => 'Head Security'],
    		['name' => 'Debt Collector'],
    		['name' => 'Beer Alcohol - District'],
    		
    		['name' => 'Compensation and Benefit'],
    		['name' => 'Depo Baucau'],
    		['name' => 'Depo Suai'],
    		['name' => 'Depo Maliana'],
    		['name' => 'Depo Oecussie'],
    		
    		['name' => 'Receive Container'],
    		['name' => 'Loading Container'],
    		['name' => 'Driver Khusus Kios / All in'],
    		['name' => 'Checking Container'],
    		
    		['name' => 'Area Coordinator'],
    		['name' => 'Report Analisyst'],
    		['name' => 'Promotion & Sales'],
    		['name' => 'Merchandising']
    	]);
    }
}
