@extends('layouts.view', ['title'=>'Positions', 'modul'=> 'positions'])
@section('content')
@include('positions.ajax_index')
@endsection