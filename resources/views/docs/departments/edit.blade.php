@extends('layouts.view', ['title'=>'Docs | Edit Department', 'modul'=> 'documentation'])
@section('content')
@include('docs.departments.ajax_edit')
@endsection