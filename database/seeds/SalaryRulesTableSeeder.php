<?php

use Illuminate\Database\Seeder;
use App\Models\SalaryRule;
use App\Models\Employee;
use Faker\Factory;

class SalaryRulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    	SalaryRule::truncate();
    	$faker = Factory::create('id_ID');
    	$data = [];
    	foreach(Employee::inRandomOrder()->get() as $e){
    		$data[] = [
    			'allowance' => round($faker->numberBetween(1000000, 5000000), -5),
    			'basic_salary' => round($faker->numberBetween(3000000, 15000000), -5),
    			'eat_cost' => round($faker->numberBetween(500000, 3000000), -5),
    			'transportation' => round($faker->numberBetween(1000000, 5000000), -5),
    			'employee' => $e->id,
    			'status' => '1'
    		];
    	}
    	// DB::enableQueryLog();
    	SalaryRule::insert($data);
    	// var_dump(DB::getQueryLog());
    }
}
