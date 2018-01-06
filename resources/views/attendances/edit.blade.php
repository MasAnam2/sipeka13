<form action="{{ route('attendance.update') }}">
	{{ csrf_field() }}
	{{ id_field($data->id) }}
	{{ method_field('PUT') }}
	<div class="row">
		<div class="col-md-6">
			{{ input_text('', 'Employee', $data->emp->name, 'readonly') }}
		</div>
		<div class="col-md-6">
			{{ select('status', '', attendance_status_array(), 'onchange="statusEvent(this)" data-select="status"', $data->status) }}
		</div>
		<div class="col-md-6">
			{{ input_datepicker('created_at', '', str_replace('-', '/', $data->created_at)) }}
		</div>
		<div class="attendance-time">
			<div class="col-md-6">
				{{ input_time('enter_at', '', $data->enter_at) }}
			</div>
			<div class="col-md-6">
				{{ input_time('out_at', '', $data->out_at) }}
			</div>
		</div>
		<div class="attendance-information">
			<div class="col-md-12">
				{{ textarea('information', '', $data->information) }}
			</div>
		</div>
		<div class="col-md-12">
			{{ save_button('update').save_close_button('update') }}
		</div>
	</div>
</form>
<script>
	$("[data-mask]").inputmask();
	$('.attendance-status2').select2();
	$('[data-select="status"]').trigger('change');
</script>