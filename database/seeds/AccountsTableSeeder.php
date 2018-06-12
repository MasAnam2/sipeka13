<?php

use Illuminate\Database\Seeder;

class AccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        DB::table('users')->insert([
            'username'  => 'admin',
            'password'  => bcrypt('admin'),
            'level'     => '0',
            'avatar_path'   => '/avatars/default.jpg',
        ]);
    	DB::table('users')->where('id', '>', '1')->delete();
    	DB::table('authorities')->where('id', '>', '1')->delete();
    	$faker = Faker\Factory::create('id_ID');
    	$data2 = [];
    	foreach(DB::table('employees')->inRandomOrder()->take(15)->get() as $d){
    		$level = $faker->randomElement(['1', '2', '3']);
    		if(App\User::where('level', '1')->count() > 7){
    			$level = $faker->randomElement(['2', '3']);
    		}
    		if(App\User::where('level', '2')->count() > 5){
    			$level = '3';
    		}
    		$username = $faker->username;
    		$data = [
    			'created_at' => $faker->dateTimeBetween('-1 years', '-7 days'),
    			'level' => $level,
    			'avatar_path' => '/avatars/default.jpg',
    			'employee' => $d->id,
    			'username' => $username,
    			'password' => bcrypt($username),
    		];
    		$user = App\User::create($data);
    		$data2[] = [
    			"departments" => $faker->randomElement(["1", "0"]),
    			"positions" => $faker->randomElement(["1", "0"]),
    			"employees" => $faker->randomElement(["1", "0"]),
    			"salary_rules" => $faker->randomElement(["1", "0"]),
    			"attendances" => $faker->randomElement(["1", "0"]),
    			"over_time" => $faker->randomElement(["1", "0"]),
    			"loans" => $faker->randomElement(["1", "0"]),
    			"accounts" => $faker->randomElement(["1", "0"]),
    			"salaries" => $faker->randomElement(["1", "0"]),
    			"company_profile" => $faker->randomElement(["1", "0"]),
    			"user" => $user->id
    		];
    	}
		DB::table('authorities')->insert($data2);
    }
}
