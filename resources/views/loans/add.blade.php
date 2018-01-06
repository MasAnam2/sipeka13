<form onsubmit="save(this, event)" role="form" action="{{ route('loan.create') }}" method="post">
  {{ csrf_field() }}
  <div class="row">
    <div class="col-md-6">
      {{ select('employee', '', $employee_model->employees()) }}
    </div>
    <div class="col-md-6">
      {{ input_datepicker('created_at', '', date('Y/m/d'), 'data-default-value="'.date('Y/m/d').'"') }}
    </div>
    <div class="col-md-6">
      {{ input_text('total', '', 0, 'data-default-value="0"') }}
    </div>
    <div class="col-md-6">
      {{ textarea('information') }}
    </div>
    <div class="col-md-12">
      {{ save_button() }}
    </div>
  </div>
</form>