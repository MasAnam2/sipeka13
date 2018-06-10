@extends('layouts.view', ['title'=>'Docs | Delete Position', 'modul'=> 'documentation'])
@section('content')
@include('docs.positions.ajax_delete')
@endsection