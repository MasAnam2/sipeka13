<form id="add-enter-multiply-form" role="form" action="{{ route('salary_rule.create') }}" method="post">
  {{ csrf_field() }}
  <div class="row">
    <div class="col-md-6">
      {{ select('employee', '', employee()->employees()) }}
    </div>
    <div class="col-md-6">
      {{ input_money('basic_salary', '', '0', 'data-default-value="0"') }}
    </div>
    <div class="col-md-6">
      {{ input_money('allowance', '', '0', 'data-default-value="0"') }}
    </div>
    <div class="col-md-6">
      {{ input_money('eat_cost', '', '0', 'data-default-value="0"') }}
    </div>
    <div class="col-md-6">
      {{ input_money('transportation', '', '0', 'data-default-value="0"') }}
    </div>
    <div class="col-md-12">
      <div class="alert alert-info">
        <h4><i class="icon fa fa-info-circle"></i> Please Read :)</h4>
        If employee already set salary rule, data will be update<br>
        Use dot (.) to enter decimal
      </div>
    </div>
    <div class="col-sm-12">
      {{ save_button() }}
    </div>
  </div>
</form>