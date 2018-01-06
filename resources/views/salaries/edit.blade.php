{{ form_open(route('salary.update')) }}
{{ csrf_field() }}
{{ id_field($data->id) }}
{{ method_field('PUT') }}
{{ input_hidden('employee', $data->employee) }}
<div class="row salary-row">
  <div class="col-md-6">
    {{ input_text('', 'Employee', '('.$data->emp->ein.') '.$data->emp->name, 'readonly') }}
  </div>
  <div class="col-md-2">
    {{ input_text('created_at', '', str_replace('-', '/', $data->created_at), 'readonly') }}
  </div>
  <div class="col-md-2">
    {{ input_text('', 'Month', english_month_name($data->month), 'readonly') }}
    {{ input_hidden('month', $data->month) }}
  </div>
  <div class="col-md-2">
    {{ input_text('year', '', $data->year, 'readonly') }}
  </div>
  <div class="col-md-4">
    {{ input_text('basic_salary', 'Basic Salary (Rp)', $data->sr->basic_salary, 'readonly') }}
  </div>
  <div class="col-md-4">
    {{ input_text('allowance', 'Allowance (Rp)', $data->sr->allowance ? $data->sr->allowance : 0, 'readonly') }}
  </div>
  <div class="col-md-4">
    {{ input_text('transportation', 'Transportation (Rp)', $data->sr->transportation, 'readonly') }}
  </div>
  <div class="col-md-4">
    {{ input_text('eat_cost', 'Eat Cost (Rp)', $data->sr->eat_cost, 'readonly') }}
  </div>
  <div class="col-md-4">
    {{ input_text('over_time_total', 'Over Time Total (Rp)', $data->over_time_total, 'readonly') }}
  </div>
  <div class="col-md-4">
    {{ input_text('loan', '', $data->loan, 'readonly') }}
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
          @foreach ($attendances as $a)
          <td>{{ $a }}</td>
          @endforeach
        </tr>
      </tbody>
    </table>
  </div>
  <div class="col-md-6">
    {{ input_money('thr', 'THR (Rp)', $data->thr, 'onkeyup="setClearSalary(this, event)" onkeydown="setClearSalary(this, event)"') }}
  </div>
  <div class="col-md-6">
    {{ input_money('reward', 'Reward (Rp)', $data->reward, 'onkeyup="setClearSalary(this, event)" onkeydown="setClearSalary(this, event)"') }}
  </div>
  <div class="col-md-6">
    {{ input_money('punishment', 'Punishment (Rp)', $data->punishment, 'onkeyup="setClearSalary(this, event)" onkeydown="setClearSalary(this, event)"') }}
  </div>
  <div class="col-md-6">
    {{ input_text('', 'Clear Salary (Rp)', $data->clear_salary, 'readonly data-clear-salary') }}
  </div>
  <div class="col-md-12">
    {{ save_button('update').' '.save_close_button('update') }}
  </div>
</div>
</form>