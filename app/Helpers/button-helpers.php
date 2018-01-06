<?php
function ed_btn($id)
{
	return '<span data-role="hint" data-hint-background="bg-darkMagenta" data-hint-color="fg-white" data-hint-mode="2" data-hint="Edit" data-hint-position="top"
	><a href="#" onclick="edit(\''.$id.'\')" class="button bg-darkMagenta fg-white cycle-button"><span class="mif-pencil"></span></a></span>';
}

function edit_btn($id)
{
	echo ed_btn($id);
}

function get_edit_button($id, $url, $prefix='', $size='')
{
	return '<a data-toggle="tooltip" title="Edit" href="#" onclick="edit(\''.$id.'\', \''.$url.'\', \''.$prefix.'\', \''.$size.'\')" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-pencil"></i></a>';
}

function edit_button($id, $size='')
{
	echo get_edit_button($id, $size);
}

function det_btn($event=null)
{
	return '<a data-role="hint" data-hint-background="bg-darkIndigo" data-hint-color="fg-white" data-hint-mode="2" data-hint="Detail" data-hint-position="top" onclick="detail(\''.$event.'\')" class="button fg-white bg-darkIndigo cycle-button" href="#"><span class="mif-eye"></span></a>';
}

function get_detail_button($id, $url, $prefix='', $size='')
{
	$event = 'detail(\''.$id.'\', \''.$url.'\', \''.$prefix.'\', \''.$size.'\')';
	return '<a data-toggle="tooltip" title="Detail" onclick="'.$event.'" class="btn btn-warning btn-sm btn-flat" href="#"><i class="fa fa-eye"></i></a>';
}

function get_delete_button($id, $url=null)
{
	return '<a data-toggle="tooltip" title="Delete" onclick="remove('.$id.', \''.$url.'\')" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-trash"></i></a>';
}

function delete_button($id)
{
	echo get_delete_button($id);
}

function save_button($action='insert', $text='Save', $additional='')
{
	$action = $action==''?'insert':$action;
	$text = $text==''?'Save':$text;
	$event = 'save(this, event, \''.$action.'\')';
	echo '<a onclick="'.$event.'" '.$additional.' id="save" class="btn btn-primary btn-flat btn-sm">'.$text.'</a>';
}

function simpanBtn($text='Save', $additional='')
{
	$text = $text==''?'Save':$text;
	echo '<button type="submit" '.$additional.' id="simpan-btn" class="btn btn-primary btn-flat btn-sm">'.$text.'</button>';
}

function save_close_button($action='insert', $text='Save & Close', $additional='')
{
	$onclick = 'save(this, event, \''.$action.'\', true)';
	echo '<a onclick="'.$onclick.'" '.$additional.' id="save-close" class="btn btn-default btn-sm btn-flat">'.$text.'</a>';
}

function delete_selected_button()
{
	echo '<a href="#" onclick="deleteSelected(this)" class="btn btn-flat btn-danger btn-sm delete-button-selected" style="display: none;">Delete Selected</a>';
}

function export_delete_selected_button($modul)
{
	export_button($modul).delete_selected_button();
}

function export_button($modul)
{
	print_button($modul).excel_button($modul).pdf_button($modul);
}

function excel_button($modul)
{
	echo '<a target="_blank" href="'.route($modul.'.excel').'" data-toggle="tooltip" title="Export to Excel" class="btn btn-sm btn-flat btn-success"><i class="fa fa-file-excel-o"></i></a>';
}

function pdf_button($modul)
{
	echo '<a target="_blank" href="'.route($modul.'.pdf').'" data-toggle="tooltip" title="Export to PDF" class="btn btn-sm btn-flat btn-danger"><i class="fa fa-file-pdf-o"></i></a>';
}

function print_button($modul)
{
	echo '<a data-toggle="tooltip" title="Print" target="_blank" href="'.route($modul.'.print').'" class="btn btn-sm btn-flat btn-default"><i class="fa fa-print"></i></a>';
}

function getPrintBtn($link, $text)
{
	return '<a data-toggle="tooltip" title="'.$text.'" target="_blank" href="'.$link.'" class="btn btn-sm btn-flat btn-default"><i class="fa fa-print"></i></a>';
}

function getExcelBtn($link, $text)
{
	return '<a data-toggle="tooltip" title="'.$text.'" target="_blank" href="'.$link.'" class="btn btn-sm btn-flat btn-success"><i class="fa fa-file-excel-o"></i></a>';
}

function getPDFBtn($link, $text)
{
	return '<a data-toggle="tooltip" title="'.$text.'" target="_blank" href="'.$link.'" class="btn btn-sm btn-flat btn-danger"><i class="fa fa-file-pdf-o"></i></a>';
}

function excel_link($link)
{
	echo '<a target="_blank" href="'.$link.'" data-toggle="tooltip" title="export to excel" class="btn btn-sm btn-flat btn-success"><i class="fa fa-file-excel-o"></i></a>';
}

function pdf_link($link)
{
	echo '<a target="_blank" href="'.$link.'" data-toggle="tooltip" title="export to pdf" class="btn btn-sm btn-flat btn-danger"><i class="fa fa-file-pdf-o"></i></a>';
}

function print_link($link)
{
	echo '<a data-toggle="tooltip" title="print" target="_blank" href="'.$link.'" class="btn btn-sm btn-flat btn-default"><i class="fa fa-print"></i></a>';
}

function refresh_btn($callback)
{
	$hint = 'data-role="hint" data-hint-color="fg-white" data-hint-mode="2" data-hint-position="bottom"';
	echo '<a '.$hint.' href="#" onclick="'.$callback.'" data-hint="Refresh" data-hint-background="bg-cyan" class="button bg-cyan fg-white cycle-button"><span class="mif-loop2"></span></a>
	';
}

function refresh_button($callback)
{
	$hint = 'data-role="hint" data-hint-color="fg-white" data-hint-mode="2" data-hint-position="bottom"';
	echo '<a '.$hint.' href="#" onclick="'.$callback.'" data-hint="Refresh" data-hint-background="bg-cyan" class="button bg-cyan fg-white cycle-button"><span class="mif-loop2"></span></a>
	';
}

function get_restore_button($id, $url=null)
{
	return '<a '.hint('Restore', 'blue').' href="#" onclick="restore(\''.$id.'\', \''.$url.'\')" class="button bg-blue fg-white cycle-button"><i class="fa fa-undo"></i></a>
	';
}

function get_permanent_delete_button($id, $url)
{
	return '<a '.hint('Permanent delete', 'red').' href="#" onclick="permanentDelete(\''.$id.'\', \''.$url.'\')" class="button bg-red fg-white cycle-button"><i class="fa fa-trash"></i></a>
	';
}

function reload_btn()
{
	$hint = 'data-role="hint" data-hint-color="fg-white" data-hint-mode="2" data-hint-position="bottom"';
	return '<a '.$hint.' href="#" onclick="refreshTable()" data-hint="Refresh" data-hint-background="bg-cyan" class="button bg-cyan fg-white cycle-button"><span class="mif-loop2"></span></a>
	';
}

function get_salary_slip_button($url)
{
	return '<a data-toggle="tooltip" title="Print Salary Slip" target="_blank" href="'.$url.'" class="btn btn-sm btn-flat btn-default"><i class="fa fa-print"></i></a>';
}

function primBtn($text, $additional){
	return '<button class="btn btn-primary btn-flat" type="button" '.$additional.'>'.$text.'</button>';
}