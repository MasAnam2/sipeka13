<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th width="10px">#</th>
			<th>Employee</th>
			<th>Created At</th>
			<th>Pay (Rp)</th>
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
			<td align="right">{{ rupiah($d->pay) }}</td>
			<td>{{ $d->information }}</td>
		</tr>
		@endforeach
	</tbody>
</table>