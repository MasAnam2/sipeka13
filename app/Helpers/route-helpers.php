<?php 

function deleted_selected_route($controller, $routePrefix)
{
	Route::delete('delete_selected', $controller.'deleteSelected')->name($routePrefix.'.delete_selected');
}

function export_route($c, $r, $same=false)
{
	if($same==false){
		Route::get('print', $c.'to_print')->name($r.'.print');
		Route::get('pdf', $c.'pdf')->name($r.'.pdf');
		Route::get('excel', $c.'excel')->name($r.'.excel');
	}else{
		Route::get($r.'/print', $c.'to_print')->name($r.'.print');
		Route::get($r.'/pdf', $c.'pdf')->name($r.'.pdf');
		Route::get($r.'/excel', $c.'excel')->name($r.'.excel');
	}
}