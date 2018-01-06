<form id="edit-form" onsubmit="save(this, event, 'update')" role="form" action="{{ route('department.update') }}" method="post">
  {{ csrf_field() }}
  {{ id_field($data->id) }}
  {{ method_field('PUT') }}
  <div class="row">
    <div class="col-md-12">
      {{-- {{ failedAlert('edit') }} --}}
    </div>
    <div class="col-md-12">
      {{ input_text('name', '', $data->name) }}
      {!! old_fl($data->name, 'name') !!}
    </div>
    <div class="col-md-12">
      {{ save_button('update') }} {{ save_close_button('update') }}
    </div>
  </div>
</form>