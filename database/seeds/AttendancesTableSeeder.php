<?php

use Illuminate\Database\Seeder;
use App\Models\OverTime;
use App\Models\Attendance;
class AttendancesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker\Factory::create('id_ID');
    	Attendance::truncate();
    	OverTime::truncate();
    	$out_rule = new DateTime(DB::table('settings')->where('key', 'over_time')->first()->value);
    	$attendanceData = [];
    	$overtimeData = [];
    	$employees = DB::table('employees')->inRandomOrder()->get();
    	foreach(range(0, 365) as $loop){
    		$date = date('Y-m-d', strtotime('-'.$loop.' days'));
    		$i = 1;
    		$jmlLibur = 0;
    		foreach($employees as $e){
    			$status = '0';
    			if($jmlLibur < 6){
    				$status = $faker->randomElement(['0', '1', '2']);
    			}
    			$jam = $faker->randomElement(range(15,23));
    			$menit = $faker->randomElement(range(0,59));
    			$menit = $menit < 10 ? '0'.$menit : $menit;
    			$detik = $faker->randomElement(range(0,59));
    			$detik = $detik < 10 ? '0'.$detik : $detik;
    			$out_at = $status == '0' ? $jam.':'.$menit.':'.$detik : null;

    			$jam = $faker->randomElement(range(6,9));
    			$menit = $faker->randomElement(range(0,59));
    			$menit = $menit < 10 ? '0'.$menit : $menit;
    			$detik = $faker->randomElement(range(0,59));
    			$detik = $detik < 10 ? '0'.$detik : $detik;
    			$enter_at = $status == '0' ? $jam.':'.$menit.':'.$detik : null;
    			$attendance = [
    				'created_at' => $date,
    				'status' => $status,
    				'information' => $status != '0' ? 'Dummy Reason' : '',
    				'enter_at' => $enter_at,
    				'out_at' => $out_at,
    				'employee' => $e->id
    			];
    			$attendanceData[] = $attendance;
    			if($out_at){
    				$out      = new DateTime($out_at);
    				if($out > $out_rule){
    					$overtimeData[] = [
    						'employee'   => $e->id,
    						'created_at' => $date,
    						'pay' => round($faker->numberBetween(20000, 100000), -3),
    						'information' => $faker->text(100)
    					];
    				}	
    			}else{
    				$jmlLibur++;
    			}
    		}
    	}
    	// DB::enableQueryLog();
    	foreach(array_chunk($attendanceData, 200) as $a){
	    	DB::table('attendances')->insert($a);
    	}
    	foreach(array_chunk($overtimeData, 200) as $a){
	    	DB::table('over_times')->insert($a);
    	}
    	$a = ('insert attendances '.count($attendanceData).' rows');
    	$b = ('insert over time '.count($overtimeData).' rows');
    	// var_dump(DB::getQueryLog());
    	var_dump($a);
    	var_dump($b);
    }
}
