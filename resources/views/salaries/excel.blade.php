<h3 class="text-center">Positions</h3>
<table id="example1" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th width="10px">#</th>
			<th>Name</th>
			<th>Basic Salary ($)</th>
			<th>Eat Cost ($)</th>
			<th>Allowance ($)</th>
			<th>Incentive ($)</th>
		</tr>
	</thead>
	<tbody>
		<?php $no = 1; ?>
		@foreach($data as $d)
		<tr>
			<td>{{ $no }}</td>
			<td>{{ $d->name }}</td>
			<td>{{ $d->basic_salary }}</td>
			<td>{{ $d->eat_cost }}</td>
			<td>{{ $d->allowance }}</td>
			<td>{{ $d->incentive }}</td>
		</tr>
		<?php $no++ ?>
		@endforeach
	</tbody>
</table>