@extends('layouts.view', ['title'=>'Docs | Employee Detail', 'modul'=> 'documentation'])
@section('content')
@include('docs.employees.ajax_detail')
@endsection