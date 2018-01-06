<?php

use Illuminate\Database\Seeder;
use App\Models\Employee;
use Faker\Factory;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    	Employee::truncate();
    	$faker = Factory::create('id_ID');
    	$data = [];
    	Employee::where('id', '>', '41')->delete();
    	foreach(range(1, 200) as $loop){
    		$gender = $faker->randomElement(['0','1']);
    		$data[] = [
    			'ein' => $faker->unique()->numberBetween(1000, 9999),
    			'nin' => $faker->unique()->numberBetween(1000000, 9999999),
    			'name' => $faker->unique()->name($gender == '0' ? 'male' : 'female'),
    			'gender' => $gender,
    			'born_in' => $faker->city,
    			'city' => $faker->city,
    			'marital_status' => $faker->randomElement(['0','1']),
				'last_education' => $faker->city.' University',
				'address' => $faker->address,
				'birthdate' => $faker->dateTimeBetween('-40 years', '-17 years'),
				'joined_at' => $faker->dateTimeBetween('-15 years', 'now'),
				'department_id' => App\Models\Department::inRandomOrder()->first()->id,
				'position_id' => App\Models\Position::inRandomOrder()->first()->id
    		];
    	}
    	Employee::insert($data);
    }
}
