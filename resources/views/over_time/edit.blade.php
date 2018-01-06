<form action="{{ route('over_time.update') }}">
	{{ id_field($data->id) }}
	{{ csrf_field() }}
	{{ method_field('PUT') }}
	<div class="row">
		<div class="col-md-12">
			{{ input_text('pay', '', $data->pay) }}
		</div>
		<div class="col-md-12">
			{{ textarea('information', '', $data->information) }}
		</div>
		<div class="col-md-12">
			{{ save_button('update').save_close_button('update') }}
		</div>
	</div>
</form>