@php
$i = 1;
@endphp
<div class="row">
	<div class="col-md-8">
		<table class="table table-bordered table-striped">
			<tr>
				<td width="10px"><strong>{{ $i++ }}</strong></td>
				<td width="200px"><strong>NIN</strong></td>
				<td>{{ $data->nin }}</td>
			</tr>
			<tr>
				<td><strong>{{ $i++ }}</strong></td>
				<td><strong>EIN</strong></td>
				<td>{{ $data->ein }}</td>
			</tr>
			<tr>
				<td><strong>{{ $i++ }}</strong></td>
				<td><strong>Name</strong></td>
				<td>{{ $data->name }}</td>
			</tr>
			<tr>
				<td><strong>{{ $i++ }}</strong></td>
				<td><strong>Gender</strong></td>
				<td>{{ gender($data->gender) }}</td>
			</tr>
			<tr>
				<td><strong>{{ $i++ }}</strong></td>
				<td><strong>Born In</strong></td>
				<td>{{ $data->born_in }}</td>
			</tr>
			<tr>
				<td><strong>{{ $i++ }}</strong></td>
				<td><strong>Birthdate</strong></td>
				<td>{!! invalidDate($data->birthdate) ? merah($data->birthdate) : english_date($data->birthdate) !!}</td>
			</tr>
			<tr>
				<td><strong>{{ $i++ }}</strong></td>
				<td><strong>Marital Status</strong></td>
				<td>{{ maried($data->marital_status) }}</td>
			</tr>
			<tr>
				<td><strong>{{ $i++ }}</strong></td>
				<td><strong>City Now</strong></td>
				<td>{{ $data->city }}</td>
			</tr>
			<tr>
				<td><strong>{{ $i++ }}</strong></td>
				<td><strong>Address</strong></td>
				<td>{{ $data->address }}</td>
			</tr>
			<tr>
				<td><strong>{{ $i++ }}</strong></td>
				<td><strong>Last Education</strong></td>
				<td>{{ $data->last_education }}</td>
			</tr>
			<tr>
				<td><strong>{{ $i++ }}</strong></td>
				<td><strong>Department</strong></td>
				<td>{!! $data->dep ? $data->dep->name : not_set() !!}</td>
			</tr>
			<tr>
				<td><strong>{{ $i++ }}</strong></td>
				<td><strong>Position</strong></td>
				<td>{!! $data->pos ? $data->pos->name : not_set() !!}</td>
			</tr>
			<tr>
				<td><strong>{{ $i++ }}</strong></td>
				<td><strong>Joined At</strong></td>
				<td>{!! invalidDate($data->joined_at) ? merah($data->joined_at) : english_date($data->joined_at) !!}</td
			</tr>
		</table>	
	</div>
	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-body">
				<center>
					<img style="max-width: 90%;" src="{{ $data->photo ? asset('storage/'.$data->photo) : asset('spk/images/employee-default.png') }}" alt="{{ $data->name }}">
					<p align="center">
						<strong>{{ $data->name }}</strong>
					</p>
				</center>
			</div>
		</div>
	</div>
</div>