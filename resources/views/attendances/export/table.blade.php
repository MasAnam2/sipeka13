<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th width="10px">#</th>
			<th>Employee</th>
			<th>Created At</th>
			<th>Status</th>
			<th>Enter At</th>
			<th>Out At</th>
			<th>Information</th>
		</tr>
	</thead>
	<tbody>
		<?php $no = 1; ?>
		@foreach($data as $d)
		<tr>
			<td>{{ $no++ }}</td>
			<td>{{ '('.$d->emp->ein.') '.$d->emp->name }}</td>
			<td align="right">{{ english_date($d->created_at) }}</td>
			<td>{{ absence_status($d->status) }}</td>
			<td align="right">{{ $d->enter_at }}</td>
			<td align="right">{{ $d->out_at }}</td>
			<td>{{ $d->information }}</td>
		</tr>
		@endforeach
	</tbody>
</table>