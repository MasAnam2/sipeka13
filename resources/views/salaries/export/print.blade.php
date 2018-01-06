@extends('layouts.export.template')
@section('content')
@include('layouts.export.header')
<h3 class="text-center">Salaries</h3>
Filter : {{ english_month_name(substr($date, 5)).', '.substr($date, 0, 4) }}
<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th width="10px">#</th>
			<th width="350px">Employee</th>
			<th>Created At</th>
			<th width="80px">Month</th>
			<th width="80px">Year</th>
			<th>Clear Salary (Rp)</th>
		</tr>
	</thead>
	<tbody>
		<?php $no = 1; ?>
		@foreach($data as $d)
		<tr>
			<td>{{ $no++ }}</td>
			<td>{{ '('.$d->emp->ein.') '.$d->emp->name }}</td>
			<td align="right">{{ english_date($d->created_at) }}</td>
			<td align="right">{{ english_month_name($d->month) }}</td>
			<td align="right">{{ $d->year }}</td>
			<td align="right">{{ rupiah($d->clear_salary) }}</td>
		</tr>
		@endforeach
	</tbody>
</table>
@endsection