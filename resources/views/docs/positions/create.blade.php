@extends('layouts.view', ['title'=>'Docs | Create Position', 'modul'=> 'documentation'])
@section('content')
@include('docs.positions.ajax_create')
@endsection