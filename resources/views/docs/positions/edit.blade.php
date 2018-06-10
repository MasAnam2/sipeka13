@extends('layouts.view', ['title'=>'Docs | Edit Position', 'modul'=> 'documentation'])
@section('content')
@include('docs.positions.ajax_edit')
@endsection