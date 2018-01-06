<div class="col-md-4">
	{{ input_text('basic_salary', 'Basic Salary (Rp)', $basic_salary, 'readonly') }}
</div>
<div class="col-md-4">
	{{ input_text('allowance', 'Allowance (Rp)', $allowance, 'readonly') }}
</div>
<div class="col-md-4">
	{{ input_text('transportation', 'Transportation (Rp)', $transportation, 'readonly') }}
</div>
<div class="col-md-4">
	{{ input_text('eat_cost', 'Eat Cost (Rp)', $eat_cost, 'readonly') }}
</div>
<div class="col-md-4">
	{{ input_text('over_time_total', 'Result Over Time (Rp)', $result_over_time, 'readonly') }}
</div>
<div class="col-md-4">
	{{ input_text('loan', 'Loan (Rp)', $loan, 'readonly') }}
</div>
<div class="col-md-12">
	<div class="row">
		<div class="col-md-3">
			{{ input_radio('pay', 'Pay Loan', '1', 'checked data-check="pay"') }}
		</div>
		<div class="col-md-3">
			{{ input_radio('pay', 'No Pay Loan', '0', 'data-check="nopay"') }}
		</div>	
	</div>
</div>
<div class="col-md-12">
	<table class="table">
		<thead>
			<tr>
				@foreach(attendance_status_array() as $k => $v)
				<th>{{ $v }}</th>
				@endforeach
			</tr>
		</thead>
		<tbody>
			<tr>
				@foreach ($attendances as $total)
				<td>{{ $total }}</td>
				@endforeach
			</tr>
		</tbody>
	</table>
</div>
<div class="col-md-4">
	{{ input_money('thr', 'THR (Rp)', '0', 'onkeyup="setClearSalary(this, event)" onkeydown="setClearSalary(this, event)"') }}
</div>
<div class="col-md-4">
	{{ input_money('reward', 'Reward (Rp)', '0', 'onkeyup="setClearSalary(this, event)" onkeydown="setClearSalary(this, event)"') }}
</div>
<div class="col-md-4">
	{{ input_money('punishment', 'Punishment (Rp)', '0', 'onkeyup="setClearSalary(this, event)" onkeydown="setClearSalary(this, event)"') }}
</div>
<div class="col-md-4">
	{{ input_text('', 'Clear Salary (Rp)', $temp_total_no_loan-$loan, 'readonly data-clear-salary') }}
	{{ input_hidden('temp_total_no_loan', $temp_total_no_loan) }}
	{{ input_hidden('withLoan', 'true') }}
	{{ input_hidden('salary_rule', $salary_rule) }}
</div>
<div class="col-md-12">
	<div class="alert alert-info">
		<h4>Read Me</h4>
		If data in period exist will be update
	</div>
</div>
<script>
	// pluginsRender();
	setTimeout(function(){
		$('[data-check="pay"]').on('ifChecked', function(e){
			$('input[name="withLoan"]').val('true');
			setClearSalary(this, event)
		});
		$('[data-check="nopay"]').on('ifChecked', function(e){
			$('input[name="withLoan"]').val('false');
			setClearSalary(this, event)
		});
	}, 2000);
</script>