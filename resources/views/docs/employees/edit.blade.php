@extends('layouts.view', ['title'=>'Docs | Edit Employee', 'modul'=> 'documentation'])
@section('content')
@include('docs.employees.ajax_edit')
@endsection