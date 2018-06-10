@extends('layouts.view', ['title'=>'Docs | Create Employee', 'modul'=> 'documentation'])
@section('content')
@include('docs.employees.ajax_create')
@endsection