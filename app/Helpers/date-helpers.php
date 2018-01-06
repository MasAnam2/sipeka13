<?php 
function eng_date($date)
{
	return substr($date, 6, 4).'/'.substr($date, 0, 2).'/'.substr($date, 3, 2);
}

function eng_date2($date)
{
	return substr($date, 5, 2).'/'.substr($date, 8, 2).'/'.substr($date, 0, 4);
}

function english_date($date)
{
	return english_month_name(substr($date, 5, 2)).' '.substr($date, 8, 2).', '.substr($date, 0, 4);
}

function english_datetime($d)
{
	if($d==null)
		return '-';
	return english_date($d).' '.substr($d, 11);
}

function month_name($month)
{
	switch ($month) {
		case '01':
		return 'Januari';
		break;
		case '02':
		return 'Februari';
		break;
		case '03':
		return 'Maret';
		break;
		case '04':
		return 'April';
		break;
		case '05':
		return 'Mei';
		break;
		case '06':
		return 'Juni';
		break;
		case '07':
		return 'Juli';
		break;
		case '08':
		return 'Agustus';
		break;
		case '09':
		return 'September';
		break;
		case '10':
		return 'Oktober';
		break;
		case '11':
		return 'November';
		break;
		case '12':
		return 'Desember';
		break;
		
		default:
		return 'Tidak valid!!!';
		break;
	}
}

function english_month_name($month)
{
	switch ($month) {
		case '01':
		return 'Jan';
		break;
		case '02':
		return 'Feb';
		break;
		case '03':
		return 'Mar';
		break;
		case '04':
		return 'Apr';
		break;
		case '05':
		return 'May';
		break;
		case '06':
		return 'Jun';
		break;
		case '07':
		return 'Jul';
		break;
		case '08':
		return 'Aug';
		break;
		case '09':
		return 'Sep';
		break;
		case '10':
		return 'Oct';
		break;
		case '11':
		return 'Nov';
		break;
		case '12':
		return 'Dec';
		break;
		
		default:
		return 'Invalid!!!';
		break;
	}
}

function indo_date($date)
{
	return substr($date, 8, 2).' '.month_name(substr($date, 5, 2)).' '.substr($date, 0, 4);
}

function waktuindo($date)
{
	return indo_date($date).' '.substr($date, 10);
}

function now()
{
	return date('Y-m-d H:i:s');
}

function international_format_date_time($datetime)
{
	return english_month_name(substr($datetime, 5, 2)).' '.substr($datetime, 8, 2).', '.substr($datetime, 0, 4).' '.substr($datetime, 11);
}

function get_time($datetime)
{
	return substr($datetime, 11);
}

function get_date_only($datetime)
{
	return substr($datetime, 0, 10);
}

function time_elapsed_string($datetime, $full = false) {
	$now = new DateTime;
	$ago = new DateTime($datetime);
	$diff = $now->diff($ago);

	$diff->w = floor($diff->d / 7);
	$diff->d -= $diff->w * 7;

	$string = array(
		'y' => 'year',
		'm' => 'month',
		'w' => 'week',
		'd' => 'day',
		'h' => 'hour',
		'i' => 'minute',
		's' => 'second',
	);
	foreach ($string as $k => &$v) {
		if ($diff->$k) {
			$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
		} else {
			unset($string[$k]);
		}
	}

	if (!$full) $string = array_slice($string, 0, 1);
	return $string ? implode(', ', $string) . ' ago' : 'just now';
}

function getFilterTime($time)
{
	$times = [
		'today'      => 'Today',
		'yesterday'  => 'Yesterday',
		'this_week'  => 'This Week',
		'this_month' => 'This Month',
		'this_year'  => 'This Year',
		'all'        => 'All'
	];
	foreach ($times as $key => $value) {
		if($key == $time)
			return $value;
	}
	return english_date($time);
}

function getMonth($date)
{
	$date = str_replace('/', '-', $date);
	return explode("-", $date)[1];
}

function getYear($date)
{
	$date = str_replace('/', '-', $date);
	return explode("-", $date)[0];
}

function getMonthArray()
{
	$month = [];
	for ($i=1; $i <= 12; $i++) { 
		$month[$i] = english_month_name($i);
	}
	return $month;
}

function getYearFromBuildArray()
{
	$year = [];
	for ($i=appYearBuild(); $i <= date('Y'); $i++) { 
		$year[$i] = $i;
	}
	return $year;
}

function invalidDate($date)
{
	return substr($date, 0, 4) == '0000';
}

function filterTime($time, $max, $min = '00:00:00')
{
	if(new DateTime($time) <= new DateTime($max) && new DateTime($time) >= new DateTime($min))
		return $time;
	return filterTime($time, $max, '00:00:00');
}