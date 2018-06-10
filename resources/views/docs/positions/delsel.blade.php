@extends('layouts.view', ['title'=>'Docs | Delete Selected Position', 'modul'=> 'documentation'])
@section('content')
@include('docs.positions.ajax_delsel')
@endsection