@extends('layouts.view', ['title'=>'Docs | Delete Selected Department', 'modul'=> 'documentation'])
@section('content')
@include('docs.departments.ajax_delsel')
@endsection