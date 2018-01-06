<div class="box box-primary">
	<div class="box-header">
		<h3 class="box-title">
			Set Time
		</h3>
	</div>
	<div class="box-body">
		<div class="row">
			<form action="{{ route('over_time.set_time') }}">
				{{ csrf_field() }}
				{{ method_field('PUT') }}
				<div class="col-md-12">
					{{ input_time('set_time', '', $setting) }}
				</div>
				<div class="col-md-12">
					{{ save_button('update') }}
				</div>
			</form>
		</div>
	</div>
</div>
<script>
  $("[data-mask]").inputmask();
</script>