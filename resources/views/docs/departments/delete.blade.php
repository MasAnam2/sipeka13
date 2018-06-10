@extends('layouts.view', ['title'=>'Docs | Delete Department', 'modul'=> 'documentation'])
@section('content')
@include('docs.departments.ajax_delete')
@endsection