@extends('layouts.export.template')
@section('content')
@include('layouts.export.header')
<h3 class="text-center">Employee Identity</h3>
<table>
	<tr>
		<td width="70%">
			<table class="table table-bordered table-striped">
				<tr>
					{{-- <td width="10px"><strong>{{ $i++ }}</strong></td> --}}
					<td width="170px"><strong>NIN</strong></td>
					<td>{{ $data->nin }}</td>
				</tr>
				<tr>
					{{-- <td><strong>{{ $i++ }}</strong></td> --}}
					<td><strong>EIN</strong></td>
					<td>{{ $data->ein }}</td>
				</tr>
				<tr>
					{{-- <td><strong>{{ $i++ }}</strong></td> --}}
					<td><strong>Name</strong></td>
					<td>{{ $data->name }}</td>
				</tr>
				<tr>
					{{-- <td><strong>{{ $i++ }}</strong></td> --}}
					<td><strong>Gender</strong></td>
					<td>{{ gender($data->gender) }}</td>
				</tr>
				<tr>
					{{-- <td><strong>{{ $i++ }}</strong></td> --}}
					<td><strong>Born In</strong></td>
					<td>{{ $data->born_in }}</td>
				</tr>
				<tr>
					{{-- <td><strong>{{ $i++ }}</strong></td> --}}
					<td><strong>Birthdate</strong></td>
					<td>{!! invalidDate($data->birthdate) ? merah($data->birthdate) : english_date($data->birthdate) !!}</td>
				</tr>
				<tr>
					{{-- <td><strong>{{ $i++ }}</strong></td> --}}
					<td><strong>Marital Status</strong></td>
					<td>{{ maried($data->marital_status) }}</td>
				</tr>
				<tr>
					{{-- <td><strong>{{ $i++ }}</strong></td> --}}
					<td><strong>City Now</strong></td>
					<td>{{ $data->city }}</td>
				</tr>
				<tr>
					{{-- <td><strong>{{ $i++ }}</strong></td> --}}
					<td><strong>Address</strong></td>
					<td>{{ $data->address }}</td>
				</tr>
				<tr>
					{{-- <td><strong>{{ $i++ }}</strong></td> --}}
					<td><strong>Last Education</strong></td>
					<td>{{ $data->last_education }}</td>
				</tr>
				<tr>
					{{-- <td><strong>{{ $i++ }}</strong></td> --}}
					<td><strong>Department</strong></td>
					<td>{!! $data->dep ? $data->dep->name : not_set() !!}</td>
				</tr>
				<tr>
					{{-- <td><strong>{{ $i++ }}</strong></td> --}}
					<td><strong>Position</strong></td>
					<td>{!! $data->pos ? $data->pos->name : not_set() !!}</td>
				</tr>
				<tr>
					{{-- <td><strong>{{ $i++ }}</strong></td> --}}
					<td><strong>Joined At</strong></td>
					<td>{!! invalidDate($data->joined_at) ? merah($data->joined_at) : english_date($data->joined_at) !!}</td>
				</tr>
			</table>	
		</td>
		<td valign="top">
			<center>
				<img width="150px" 
				@if(isset($excel))
				src="{{ $data->photo ? 'storage/'.$data->photo : 'spk/images/employee-default.png' }}" 
				@else
				src="{{ $data->photo ? asset('storage/'.$data->photo) : asset('spk/images/employee-default.png') }}" 
				@endif
				alt="{{ $data->name }}">
				<p align="center">
					<strong>{{ $data->name }}</strong>
				</p>
			</center>	
		</td>
	</tr>
</table>
@endsection