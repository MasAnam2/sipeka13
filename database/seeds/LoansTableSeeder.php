<?php

use Illuminate\Database\Seeder;

class LoansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker\Factory::create('id_ID');
    	$data = [];
    	foreach(DB::table('employees')->inRandomOrder()->take(30)->get() as $d){
    		$data[] = [
    			'created_at' => $faker->dateTimeBetween('-1 years', '-7 days'),
    			'total' => $faker->numberBetween(500000, 2000000),
    			'status' => $faker->randomElement(['0', '1']),
    			'information' => $faker->text(100),
    			'employee' => $d->id
    		];
    	}
    	DB::table('loans')->insert($data);
    }
}
