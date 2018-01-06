@extends('layouts.view', ['modul'=>'attendances', 'title'=>'Attendances'])
@section('content')
@include('attendances.ajax_index')
@endsection