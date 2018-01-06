<table class="table table-bordered table-striped">
	<tr>
		<td><strong>Employee</strong></td>
		<td>{{ $data->e_name }}</td>
	</tr>
	<tr>
		<td><strong>Department</strong></td>
		<td>{{ $data->d_name }}</td>
	</tr>
	<tr>
		<td><strong>Position</strong></td>
		<td>{{ ($data->p_name) }}</td>
	</tr>
	<tr>
		<td><strong>Start Date</strong></td>
		<td>{{ english_datetime($data->start_date) }}</td>
	</tr>
	<tr>
		<td><strong>End Date</strong></td>
		<td>{{ english_datetime($data->end_date) }}</td>
	</tr>
	<tr>
		<td><strong>Destination</strong></td>
		<td>{{ $data->destination }}</td>
	</tr>
	<tr>
		<td><strong>Goal</strong></td>
		<td>{{ $data->goal }}</td>
	</tr>
	<tr>
		<td><strong>Eat Cost ($)</strong></td>
		<td>{{ $data->eat_cost }}</td>
	</tr>
	<tr>
		<td><strong>Fuel Cost ($)</strong></td>
		<td>{{ $data->fuel_cost }}</td>
	</tr>
	<tr>
		<td><strong>Other Cost ($)</strong></td>
		<td>{{ $data->other_cost }}</td>
	</tr>
</table>