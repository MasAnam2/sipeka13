@extends('layouts.export.template')
@section('content')
@include('layouts.export.header')
<h3 class="text-center">Over Time</h3>
@include('over_time.export.export_view')
@endsection