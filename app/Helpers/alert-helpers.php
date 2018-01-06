<?php

#ALERT

function failedAlert($position='new')
{
	echo getFailedAlert($position);
}

function getFailedAlert($position='new')
{
	$class = $position=='edit' ? 'failed-alert2' : 'failed-alert';
	return '<div class="callout callout-danger '.$class.'" style="display: none;"><h4>Failed!</h4><p></p></div>';
}

function successAlert($position='new')
{
	echo getSuccessAlert($position);
}

function getSuccessAlert($position='new')
{
	$class = $position=='edit' ? 'success-alert2' : 'success-alert';
	return '<div class="callout callout-success '.$class.'" style="display: none;"><h4>Success :)</h4><p></p></div>';
}

function success_failed_alert()
{
	successAlert().failedAlert();
}

function success_failed_alert_2()
{
	successAlert('edit').failedAlert('edit');
}

function fullAlert($position='new')
{
	echo get_row(get_col_md(12, getSuccessAlert($position)).get_col_md(12, getFailedAlert($position)));
}