<?php 

use Barryvdh\DomPDF\Facade as PDF;

function generate_pdf($filename, $view_path, $data, $l=false, $additionalOper)
{
	$oper  = [
	'data'      => $data
	];
	$oper = array_merge($oper, $additionalOper);
	$pdf = PDF::loadView($view_path, $oper);
	$pdf->setPaper('a4');
	if($l)
		$pdf->setPaper('a4', 'landscape');
	return $pdf->download($filename.' ['.now().'].pdf');
}

use Maatwebsite\Excel\Facades\Excel;

function generate_excel($filename, $modul, $datas)
{
	return Excel::create($filename, function($excel) use ($datas, $modul){
		$excel->setTitle(companyName().' '.$modul);
		$excel->setCreator(companyName())->setCompany(companyName());
		$excel->setDescription(companyName().' '.$modul);
		$excel->sheet('data', function($sheet) use ($datas){
			$sheet->with($datas);
			$sheet->row(1, function($row){
				$row->setFontWeight('bold');
			});
		});
	})->export('xlsx');
}