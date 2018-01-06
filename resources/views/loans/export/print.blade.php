@extends('layouts.export.template')
@section('content')
@include('layouts.export.header')
<h3 class="text-center">Loans</h3>
@yield('filter')
<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th width="10px">#</th>
			<th width="400px">Employee</th>
			<th width="100px">Created At</th>
			<th>Total (Rp)</th>
			<th>Information</th>
			<th width="80px">Status</th>
		</tr>
	</thead>
	<tbody>
		<?php $no = 1; ?>
		@foreach($data as $d)
		<tr>
			<td>{{ $no++ }}</td>
			<td>{{ '('.$d->emp->ein.') '.$d->emp->name }}</td>
			<td align="right">{{ english_date($d->created_at) }}</td>
			<td align="right">{{ rupiah($d->total) }}</td>
			<td>{{ $d->information }}</td>
			<td>{{ loan_status($d->status) }}</td>
		</tr>
		@endforeach
	</tbody>
</table>
@endsection