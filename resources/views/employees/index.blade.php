@extends('layouts.view', ['modul'=>'employees', 'title'=>'Employees'])
@section('content')
@include('employees.ajax_index')
@endsection