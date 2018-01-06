<table class="table table-bordered table-striped">
	<tr>
		<td><strong>Departments</strong></td>
		<td>{{ accessed($data->authority->departments) }}</td>
	</tr>
	<tr>
		<td><strong>Positions</strong></td>
		<td>{{ accessed($data->authority->positions) }}</td>
	</tr>
	<tr>
		<td><strong>Employees</strong></td>
		<td>{{ accessed($data->authority->employees) }}</td>
	</tr>
	<tr>
		<td><strong>Salary Rules</strong></td>
		<td>{{ accessed($data->authority->salary_rules) }}</td>
	</tr>
	<tr>
		<td><strong>Attendances</strong></td>
		<td>{{ accessed($data->authority->attendances) }}</td>
	</tr>
	<tr>
		<td><strong>Over Time</strong></td>
		<td>{{ accessed($data->authority->over_time) }}</td>
	</tr>
	<tr>
		<td><strong>Loans</strong></td>
		<td>{{ accessed($data->authority->loans) }}</td>
	</tr>
	<tr>
		<td><strong>Accounts</strong></td>
		<td>{{ accessed($data->authority->accounts) }}</td>
	</tr>
	<tr>
		<td><strong>Salaries</strong></td>
		<td>{{ accessed($data->authority->salaries) }}</td>
	</tr>
	<tr>
		<td><strong>Company Profile</strong></td>
		<td>{{ accessed($data->authority->company_profile) }}</td>
	</tr>
</table>