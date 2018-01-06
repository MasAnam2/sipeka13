@extends('layouts.view', ['title'=>'Loans', 'modul'=>'loans'])
@section('content')
@include('loans.ajax_index')
@endsection