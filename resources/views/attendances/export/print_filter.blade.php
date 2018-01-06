@extends('layouts.export.template')
@section('content')
@include('layouts.export.header')
<h3 class="text-center">Attendances</h3>
Filter use : {{ $time }}
<br>
<br>
@include('attendances.export.table')
@endsection