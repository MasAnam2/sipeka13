@extends('layouts.view', ['title'=>'Documentation', 'modul'=> 'documentation'])
@section('content')
@include('docs.ajax_index')
@endsection