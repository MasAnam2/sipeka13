@extends('layouts.export.template')
@section('content')
@include('layouts.export.header')
<h3 class="text-center">Departments</h3>
<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th width="10px">#</th>
			<th>Name</th>
		</tr>
	</thead>
	<tbody>
	@php
		$no= 1;
	@endphp
		@foreach($data as $d)
		<tr>
			<td>{{ $no++ }}</td>
			<td>{{ $d->name }}</td>
		</tr>
		@endforeach
	</tbody>
</table>
@endsection