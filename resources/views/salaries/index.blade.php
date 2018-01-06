@extends('layouts.view', ['title'=>'Salaries', 'modul'=>'salaries'])
@section('content')
@include('salaries.ajax_index')
@endsection