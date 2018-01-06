@extends('layouts.view', ['title'=>'Loans with filter', 'modul'=>'loan'])
@section('content')
@include('loans.ajax_filter')
@endsection