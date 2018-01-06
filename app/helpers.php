<?php

$helpers = [
'bs-helpers',
'app-helpers',
'form-helpers',
'date-helpers',
'event-helpers',
'alert-helpers',
'model-helpers',
'route-helpers',
'button-helpers',
'export-helpers',
];

foreach ($helpers as $h) {
	require_once 'Helpers/'.$h.'.php';
}

function contain($string, $search)
{
	return strpos($string, $search) !== false;
}

function upper($string)
{
	return ucwords(strtolower($string));
}

function rupiah($duit)
{
	return number_format($duit, 2);
}
function copyright()
{
	$date = 2017;
	if($date!=date('Y'))
		$date .= ' - '.date('Y');
	return '<strong>Copyright &copy; '.$date.' <a href="#">E Boaz System</a>.</strong> All rights
	reserved.';
}

function level($id)
{
	foreach (account_level_array() as $key => $value) {
		if($key == $id)
			return $value;
	}
}

function account_level_array()
{
	$accounts = [1=>'Admin', 2=>'Supervisor', 3=>'Manager'];
	return $accounts;
}

function id_field($id)
{
	echo '<input type="hidden" name="id" value="'.$id.'">';
}

function accessed($status)
{
	if($status==0)
		return 'Not Authorized';
	return 'Authorized';
}

function employee_type($type)
{
	if($type==1)
		return 'Free Employee';
	return 'Permanent Employee';
}

function active_modul($m, $modul)
{
	if($modul==$m) echo 'class="active"';
}

function maried($i)
{
	switch ($i) {
		case 0:
		return 'Maried';
		break;
		
		default:
		return 'No Maried';
		break;
	}
}

function non_active($i)
{
	switch ($i) {
		case 1:return 'Stand Down';break;
		case 2:return 'Chronic Pain';break;
		case 3:return 'Move District';break;
		case 4:return 'Family Reason';break;
		case 5:return 'No Mention';break;
		case 6:return 'Termination Of Employment';break;
		case 7:return 'Other';break;
		default:return 'invalid';break;
	}
}

function local_file($path)
{
	return str_replace('\\', '/', public_path($path));
}

function simple_route($controller, $route_name, $rules, $show = true)
{
	$controller .= 'Controller@';
	if($show)
		Route::get($route_name.'s', $controller.'index')->name($route_name.'s');
	else
		Route::get($route_name, $controller.'index')->name($route_name);
	$crud = str_split($rules);
	if(in_array('c', $crud))
		Route::post($route_name.'/create', $controller.'create')->name($route_name.'.create');
	if(in_array('u', $crud)){
		Route::post($route_name.'/edit', $controller.'edit')->name($route_name.'.edit');
		Route::put($route_name.'/update', $controller.'update')->name($route_name.'.update');
	}
	if(in_array('d', $crud))
		Route::delete($route_name.'/remove', $controller.'remove')->name($route_name.'.remove');
	if(in_array('t', $crud))
		Route::post($route_name.'/dt', $controller.'dt')->name($route_name.'.dt');
	if(in_array('e', $crud))
		export_route($controller, $route_name, true);
}

function array_key_rename($array, $rename)
{
	$newArray = [];
	foreach ($array as $key => $value) {
		$newValue = [];
		foreach ($value as $k => $v) {
			$get_it = false;
			foreach ($rename as $rk => $rv) {
				if($rk==$k){
					$get_it = true;
					$newValue = array_add($newValue, $rv, $v);
					break;
				}
			}
			if($get_it){
				unset($newValue[$k]);
			}else{
				$newValue = array_add($newValue, $k, $v);
			}
		}
		array_push($newArray, $newValue);
	}
	return $newArray;
}

function active_avatar()
{
	return Auth::user()->avatar_path=='' ? asset('avatars/default.jpg') : asset('storage/'.Auth::user()->avatar_path);
}

function gender($gender)
{
	if($gender==1)
		return 'Female';
	return 'Male';
}

function loan_status($status)
{
	switch ($status) {
		case 1:
		return 'Paid';
		break;
		
		default:
		return 'No Paid';
		break;
	}
}

function terbilang($satuan)
{
	if($satuan<0)
		return 'Tidak valid';
	$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
	if ($satuan < 12)
		return " " . $huruf[$satuan];
	elseif ($satuan < 20)
		return terbilang($satuan - 10) . "belas";
	elseif ($satuan < 100)
		return terbilang($satuan / 10) . " puluh" . terbilang($satuan % 10);
	elseif ($satuan < 200)
		return " seratus" . terbilang($satuan - 100);
	elseif ($satuan < 1000)
		return terbilang($satuan / 100) . " ratus" . terbilang($satuan % 100);
	elseif ($satuan < 2000)
		return " seribu" . terbilang($satuan - 1000);
	elseif ($satuan < 1000000)
		return terbilang($satuan / 1000) . " ribu" . terbilang($satuan % 1000);
	elseif ($satuan < 1000000000)
		return terbilang($satuan / 1000000) . " juta" . terbilang($satuan % 1000000);
	elseif ($satuan >= 1000000000)
		return "Hasil terbilang tidak dapat di proses karena nilai uang terlalu besar!"; 
}


function attendance_status_array()
{
	return ['Present', 'Absent', 'Sick'];
}

function absence_status($status)
{
	foreach (attendance_status_array() as $k => $s) {
		if($status == $k){
			return $s;
		}
	}
}

function prefix_file()
{
	return str_slug(companyName(), '_').'_';
}

function fileNameWithPrefix($filename)
{
	return prefix_file().$filename;
}

function merah($text)
{
	return '<strong><font color="red">'.$text.'</font></strong>';
}

function not_set()
{
	return merah('NOT SET');
}

function word($text)
{
	return ucwords(str_replace('_', ' ', $text));
}

function convert_number_to_words($number) {
    
    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );
    
    if (!is_numeric($number)) {
        return false;
    }
    
    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }
    
    $string = $fraction = null;
    
    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }
    
    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }
    
    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }
    
    return $string;
}