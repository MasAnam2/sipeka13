@extends('layouts.view', ['title'=>'Departments', 'modul'=> 'departments'])
@section('content')
@include('departments.ajax_index')
@endsection