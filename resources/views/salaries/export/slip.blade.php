@extends('layouts.export.template')
@section('content')
<style>
td{
	padding: 5px;
}
.pull-right {
	float: right;
}
</style>
@include('layouts.export.header')
<div style="border: 1px solid #444444; padding: 10px;">
	<h3 class="text-center">SALARY SLIP</h3>
	{{-- <hr> --}}
	<table>
		<tr>
			<td width="150px">Employee</td>
			<td>{{ $data->emp->name }}</td>
		</tr>
		<tr>
			<td>Department</td>
			<td>{!! $data->emp->dep ? $data->emp->dep->name : merah('NOT SET') !!}</td>
		</tr>
		<tr>
			<td>Position</td>
			<td>{!! $data->emp->pos ? $data->emp->pos->name : merah('NOT SET') !!}</td>
		</tr>
	</table>
	<hr>
	<table width="100%" style="border-collapse: collapse;">
		<tr>
			<td>Basic Salary</td>
			<td width="200px">Rp. <div class="pull-right">{{ rupiah($data->sr->basic_salary) }}</div></td>
		</tr>
		<tr>
			<td>Allowance</td>
			<td>Rp. <div class="pull-right">{{ rupiah($data->sr->allowance) }}</div></td>
		</tr>
		<tr>
			<td>Transportation</td>
			<td>Rp. <div class="pull-right">{{ rupiah($data->sr->transportation) }}</div></td>
		</tr>
		<tr>
			<td>Eat Cost</td>
			<td>Rp. <div class="pull-right">{{ rupiah($data->sr->eat_cost) }}</div></td>
		</tr>
		<tr>
			<td>Over Time</td>
			<td>Rp. <div class="pull-right">{{ rupiah($data->over_time_total) }}</div></td>
		</tr>
		<tr>
			<td>Reward</td>
			<td>Rp. <div class="pull-right">{{ rupiah($data->reward) }}</div></td>
		</tr>
		<tr>
			<td>THR</td>
			<td>Rp. <div class="pull-right">{{ rupiah($data->thr) }}</div></td>
		</tr>
		<tr>
			<td></td>
			<td><hr></td>
			<td width="10px">+</td>
		</tr>
		<tr>
			<td></td>
			<td>Rp. <div class="pull-right">{{ rupiah($data->sr->basic_salary+$data->sr->allowance+$data->sr->eat_cost+$data->sr->transportation+$data->thr+$data->reward+$data->over_time_total) }}</div></td>
		</tr>
		<tr>
			<td>Loan</td>
			<td>Rp. <div class="pull-right">{{ rupiah($data->loan) }}</div></td>
		</tr>
		<tr>
			<td>Punishment</td>
			<td>Rp. <div class="pull-right">{{ rupiah($data->punishment) }}</div></td>
		</tr>
		<tr>
			<td></td>
			<td><hr></td>
			<td width="10px">-</td>
		</tr>
		<tr>
			<td>Clear Salary</td>
			<td>Rp. <div class="pull-right">{{ rupiah($data->clear_salary) }}</div></td>
		</tr>
		<tr>
			<td class="text-right" colspan="2">
				<div class="pull-right">
					{{ convert_number_to_words($data->clear_salary) }} rupiah
				</div>
			</td>
		</tr>
	</table>
	<br>
</div>
{{-- <hr> --}}
@endsection