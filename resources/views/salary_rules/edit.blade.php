<form action="{{ route('salary_rule.update') }}">
	{{ csrf_field() }}
	{{ id_field($data->id) }}
	{{ method_field('PUT') }}
	{{ input_hidden('employee', $data->employee) }}
	<div class="row">
		<div class="col-md-12">
			{{ input_text('', 'Employee', '('.$data->emp->ein.') '.$data->emp->name, 'readonly') }}
		</div>
		<div class="col-md-12">
			{{ input_money('basic_salary', '', $data->basic_salary, 'data-default-value="0"') }}
		</div>
		<div class="col-md-12">
			{{ input_money('allowance', '', $data->allowance, 'data-default-value="0"') }}
		</div>
		<div class="col-md-12">
			{{ input_money('eat_cost', '', $data->eat_cost, 'data-default-value="0"') }}
		</div>
		<div class="col-md-12">
			{{ input_money('transportation', '', $data->transportation, 'data-default-value="0"') }}
		</div>
		<div class="col-md-12">
			<div class="alert alert-info">
				<h4><i class="icon fa fa-info-circle"></i> Please Read :)</h4>
				Use dot (.) to enter decimal
			</div>
		</div>
		<div class="col-md-12">
			{{ save_button('update').save_close_button('update') }}
		</div>
	</div>
</form>