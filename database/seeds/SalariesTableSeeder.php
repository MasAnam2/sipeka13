<?php

use Illuminate\Database\Seeder;
use App\Models\OverTime;

class SalariesTableSeeder extends Seeder
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
    	$p = 0;
    	DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    	DB::table('salaries')->truncate();
    	$date = [
    		[
    			'month' => '1',
    			'year' => '2017'
    		],
    		[
    			'month' => '2',
    			'year' => '2017'
    		],
    		[
    			'month' => '3',
    			'year' => '2017'
    		],
    		[
    			'month' => '4',
    			'year' => '2017'
    		],
    		[
    			'month' => '5',
    			'year' => '2017'
    		],
    		[
    			'month' => '6',
    			'year' => '2017'
    		],
    		[
    			'month' => '7',
    			'year' => '2017'
    		],
    		[
    			'month' => '8',
    			'year' => '2017'
    		],
    		[
    			'month' => '9',
    			'year' => '2017'
    		],
    		[
    			'month' => '10',
    			'year' => '2017'
    		],
    		[
    			'month' => '11',
    			'year' => '2017'
    		],
    		[
    			'month' => '12',
    			'year' => '2017'
    		],
    		[
    			'month' => '1',
    			'year' => '2018'
    		],
    	];
    	foreach($date as $dat){
    		$month = $dat['month'];
    		$year = $dat['year'];
    		foreach (DB::table('employees')->inRandomOrder()->get() as $e) {
    			$punishment = round($faker->numberBetween(0, 2000000), -4);
    			if($punishment > 0){
    				$p++;
    			}
    			if($p > 10) {
    				$punishment = 0;
    			}
    			$overtimeExist    = App\Models\Employee::find($e->id)->over_times()->whereMonth('created_at', $month)->whereYear('created_at', $year)->count()>0;
    			$resultOverTime   = $overtimeExist ? App\Models\Employee::find($e->id)->over_times()->resultThisMonth($month, $year) : 0 ;
    			$data[] = [
    				'created_at' => $year.'-'.$month.'-'.$faker->randomElement(range(1,5)),
    				'month' => $month,
    				'year' => $year,
    				'over_time_total' => $resultOverTime,
    				'loan' => 0,
    				'thr' => round($faker->numberBetween(0, 2000000), -4),
    				'reward' => round($faker->numberBetween(0, 2000000), -4),
    				'punishment' => $punishment,
    				'salary_rule' => DB::table('salary_rules')->where('employee', $e->id)->where('status', '1')->first()->id,
    				'employee' => $e->id
    			];
    		}
    	}
    	foreach(array_chunk($data, 200) as $d){
    		DB::table('salaries')->insert($d);
    	}
    }
}
