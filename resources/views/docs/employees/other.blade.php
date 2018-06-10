@extends('layouts.view', ['title'=>'Docs | Other Employee Docs', 'modul'=> 'documentation'])
@section('content')
@include('docs.employees.ajax_other')
@endsection