@extends('layouts.export.template')
@section('content')
@include('layouts.export.header')
<h3 class="text-center">Salary Rules</h3>
@isset($dept)
@if($dept != 'all')
<strong>Department : </strong>{{ department()->find($dept)->name }}
<br><br>
@endif
@endisset
<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>#</th>
			<th>Employee</th>
			<th>Basic Salary (Rp)</th>
			<th>Allowance (Rp)</th>
			<th>Eat Cost (Rp)</th>
			<th>Transportation (Rp)</th>
		</tr>
	</thead>
	<tbody>
		<?php $no = 1; ?>
		@foreach($data as $d)
		<tr>
			<td>{{ $no++ }}</td>
			<td>{{ '('.$d->emp->ein.') '.$d->emp->name }}</td>
			<td>{{ rupiah($d->basic_salary) }}</td>
			<td>{{ rupiah($d->allowance) }}</td>
			<td>{{ rupiah($d->eat_cost) }}</td>
			<td>{{ rupiah($d->transportation) }}</td>
		</tr>
		@endforeach
	</tbody>
</table>
@endsection