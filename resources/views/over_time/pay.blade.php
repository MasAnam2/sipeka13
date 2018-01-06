<form onsubmit="save(this, event, 'update')" action="{{ route('overtime.pay') }}" method="post">
  {{ csrf_field() }}
  {{ method_field('PUT') }}
  {{ id_field($data->id) }}
  <div class="row">
    <div class="col-md-12">
      {!! ed_inp_txt($data->pay, 'pay', 'Pay ($)') !!}
    </div>
    <div class="col-md-12">
      {{ save_button('update').' '. save_close_button('update') }} 
    </div>
  </div>
</form>