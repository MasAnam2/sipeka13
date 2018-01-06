<?php 

use App\Company;

#APP DETAIL

function companyName()
{
	$c = Company::find(1);
	return strtoupper($c->name);
}

function companyLogoExport()
{
	$c = Company::find(1);
	return 'storage/'.$c->logo_export;
}

function companyAddress()
{
	$c = Company::find(1);
	return $c->address;
}

function companyContact()
{
	$c = Company::find(1);
	return $c->contact;
}

function companyEmail()
{
	$c = Company::find(1);
	return $c->email;
}

function appName()
{
	return 'SiPeKa Application';
}

function appVersion()
{
	return '1.3.0';
}

function appYearBuild()
{
	return 2017;
}

function appCreator()
{
	return 'Hairul Anam';
}

function title()
{
	return ' | '.appName();
}