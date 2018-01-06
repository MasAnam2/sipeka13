<table class="table table-bordered table-striped">
	<tr>
		<td><strong>Employee</strong></td>
		<td>{{ '('.$data->emp->ein.') '.$data->emp->name }}</td>
	</tr>
	<tr>
		<td><strong>Department</strong></td>
		<td>{!! $data->emp->dep ? $data->emp->dep->name : merah('NOT SET') !!}</td>
	</tr>
	<tr>
		<td><strong>Position</strong></td>
		<td>{!! $data->emp->pos ? $data->emp->pos->name : merah('NOT SET') !!}</td>
	</tr>
	<tr>
		<td><strong>Period</strong></td>
		<td>{{ month_name($data->month).' '.$data->year }}</td>
	</tr>
	<tr>
		<td><strong>Basic Salary</strong></td>
		<td>Rp. <div class="pull-right">{{ rupiah($data->sr->basic_salary) }}</div></td>
	</tr>
	<tr>
		<td><strong>Transportation</strong></td>
		<td>Rp. <div class="pull-right">{{ rupiah($data->sr->transportation) }}</div></td>
	</tr>
	<tr>
		<td><strong>Allowance</strong></td>
		<td>Rp. <div class="pull-right">{{ rupiah($data->sr->allowance) }}</div></td>
	</tr>
	<tr>
		<td><strong>Eat Cost</strong></td>
		<td>Rp. <div class="pull-right">{{ rupiah($data->sr->eat_cost) }}</div></td>
	</tr>
	<tr>
		<td><strong>Over Time Total</strong></td>
		<td>Rp. <div class="pull-right">{{ rupiah($data->over_time_total) }}</div></td>
	</tr>
	<tr>
		<td><strong>Loan</strong></td>
		<td>Rp. <div class="pull-right">{{ rupiah($data->loan) }}</div></td>
	</tr>
	{{-- <tr>
		<td><strong>BPJS</strong></td>
		<td>Rp. <div class="pull-right">{{ rupiah($data->sr->bpjs) }}</div></td>
	</tr> --}}
	<tr>
		<td><strong>THR</strong></td>
		<td>Rp. <div class="pull-right">{{ rupiah($data->thr) }}</div></td>
	</tr>
	<tr>
		<td><strong>Reward</strong></td>
		<td>Rp. <div class="pull-right">{{ rupiah($data->thr) }}</div></td>
	</tr>
	<tr>
		<td><strong>Clear Salary</strong></td>
		<td>Rp. <div class="pull-right">{{ rupiah($data->clear_salary) }}</div></td>
	</tr>
</table>