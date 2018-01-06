@extends('layouts.export.template')
@section('content')
@include('layouts.export.header')
<h3 class="text-center">Accounts</h3>
<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th width="10px">#</th>
			<th>Username</th>
			<th>Level</th>
			<th>Employee</th>
		</tr>
	</thead>
	<tbody>
		<?php $no = 1; ?>
		@foreach($data as $d)
		<tr>
			<td>{{ $no++ }}</td>
			<td>{{ $d->username }}</td>
			<td>{{ level($d->level) }}</td>
			<td>{{ '('.$d->emp->ein.') '.$d->emp->name }}</td>
		</tr>
		@endforeach
	</tbody>
</table>
@endsection