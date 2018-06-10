@extends('layouts.view', ['title'=>'Docs | Delete Employee', 'modul'=> 'documentation'])
@section('content')
@include('docs.employees.ajax_delete')
@endsection