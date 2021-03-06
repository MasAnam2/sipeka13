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
        DB::table('authorities')->truncate();
        DB::table('users')->truncate();
        DB::table('users')->insert([
            'username'  => 'admin',
            'password'  => bcrypt('admin'),
            'level'     => '0',
            'avatar_path'   => '/avatars/default.jpg',
        ]);
        DB::table('authorities')->insert([
            "departments"           => '1',
            "positions"             => '1',
            "employees"             => '1',
            "salary_rules"          => '1',
            "attendances"           => '1',
            "over_time"             => '1',
            "loans"                 => '1',
            "accounts"              => '1',
            "salaries"              => '1',
            "company_profile"       => '1',
            "user"                  => 1,
        ]);
        DB::table('admin_bio')->truncate();
        DB::table('admin_bio')->insert([
            'name'  => 'Hairul Anam',
            'gender'    => '0',
            'address'   => 'Tanggul Kulon',
            'birthdate' => '1998-04-08',
            'born_in'   => 'Jember',
        ]);
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
