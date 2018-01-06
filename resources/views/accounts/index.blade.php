@extends('layouts.view', ['title'=>'Accounts', 'modul'=>'accounts'])
@section('content')
@include('accounts.ajax_index')
@endsection