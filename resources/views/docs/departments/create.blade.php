@extends('layouts.view', ['title'=>'Docs | Create Department', 'modul'=> 'documentation'])
@section('content')
@include('docs.departments.ajax_create')
@endsection