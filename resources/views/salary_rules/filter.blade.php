@extends('layouts.view', ['modul'=>'attendance', 'title'=>'Attendances With Filter'])
@section('content')
@include('attendances.ajax_filter')
@endsection