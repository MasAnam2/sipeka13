<form onsubmit="save(this, event)" role="form" action="{{ route('loan.update') }}" method="post">
  {{ csrf_field() }}
  {{ id_field($data->id) }}
  {{ method_field('PUT') }}
  {{ input_hidden('employee', $data->employee) }}
  <div class="row">
    <div class="col-md-12">
      {{ input_text('', 'Employee', '('.$data->emp->ein.') '.$data->emp->name, 'readonly') }}
    </div>
    <div class="col-md-12">
      {{ input_datepicker('created_at', '', str_replace('-', '/', $data->created_at)) }}
    </div>
    <div class="col-md-12">
      {{ input_text('total', '', $data->total) }}
    </div>
    <div class="col-md-12">
      {{ textarea('information', '', $data->information) }}
    </div>
    <div class="col-md-12">
      {{ select('status', '', ['No Paid', 'Paid'], '', $data->status) }}
    </div>
    <div class="col-md-12">
      {{ save_button('update').save_close_button('update') }}
    </div>
  </div>
</form>