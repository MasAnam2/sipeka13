@extends('layouts.view', ['title'=>'Docs | Delete Selected Employee', 'modul'=> 'documentation'])
@section('content')
@include('docs.employees.ajax_delsel')
@endsection