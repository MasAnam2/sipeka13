@extends('layouts.export.template')
@section('content')
@include('layouts.export.header')
<h3 class="text-center">Employees</h3>
<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>EIN</th>
			<th>Name</th>
			<th>Gender</th>
			<th>Department</th>
			<th>Position</th>
			<th>Joined At</th>
		</tr>
	</thead>
	<tbody>
		<?php $no = 1; ?>
		@foreach($data as $d)
		<tr>
			<td>{{ $d->ein }}</td>
			<td>{{ $d->name }}</td>
			<td>{{ gender($d->gender) }}</td>
			<td>{!! $d->dep ? $d->dep->name : not_set() !!}</td>
			<td>{!! $d->pos ? $d->pos->name : not_set() !!}</td>
			<td>{!! invalidDate($d->joined_at) ? merah($d->joined_at) : english_date($d->joined_at) !!}</td
		</tr>
		@endforeach
	</tbody>
</table>
Total : {{ count($data) }}<br>
Male total : {{ $male_total }}<br>
Female total : {{ count($data)-$male_total }}<br>
@endsection