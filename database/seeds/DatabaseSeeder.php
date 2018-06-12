<?php

use Illuminate\Database\Seeder;
// use EmployeesTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SettingTableSeeder::class);
        $this->call(CompanyTableSeeder::class);
    	$this->call(DepartmentsTableSeeder::class);
    	$this->call(PositionsTableSeeder::class);
        $this->call(EmployeesTableSeeder::class);
        $this->call(SalaryRulesTableSeeder::class);
        $this->call(AttendancesTableSeeder::class);
        $this->call(LoansTableSeeder::class);
        $this->call(AccountsTableSeeder::class);
        $this->call(SalariesTableSeeder::class);
        $this->call(MenuTableSeeder::class);
    }
}
