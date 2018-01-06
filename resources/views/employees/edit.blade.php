<form role="form" action="{{ route('employee.update') }}" method="post" enctype="multipart/form-data">
  {{ csrf_field() }}
  {{ id_field($data->id) }}
  {{ method_field('PUT') }}
  {{ input_hidden('old_nin', $data->nin).input_hidden('old_ein', $data->ein)}}
  <div class="row">
    <div class="col-md-6">
      {{ input_text('nin', 'NIN', $data->nin) }}
    </div>
    <div class="col-md-6">
      {{ input_text('ein', 'EIN', $data->ein) }}
    </div>
    <div class="col-md-6">
      {{ input_text('name', '', $data->name) }}
    </div>
    <div class="col-md-6">
      {{ select('gender', '', ['Male', 'Female'], '', $data->gender) }}
    </div>
    <div class="col-md-6">
      {{ input_text('born_in', '', $data->born_in) }}
    </div>
    <div class="col-md-6">
      {{ input_datepicker('birthdate', '', str_replace('-', '/', $data->birthdate)) }}
    </div>
    <div class="col-md-6">
      {{ input_text('city', 'City Now', $data->city) }}
    </div>
    <div class="col-md-6">
      {{ select('marital_status', '', ['Maried','No Maried'], '', $data->marital_status) }}
    </div>
    <div class="col-md-12">
      {{ textarea('address', 'Full Address', $data->address) }}
    </div>
    <div class="col-md-6">
      {{ input_text('last_education', '', $data->last_education) }}
    </div>
    <div class="col-md-6">
      {{ input_file('photo', '', 'accept="image/*"') }}
    </div>
    <div class="col-md-6">
      {{ select('department_id', '', department()->departments_select(), '', $data->department) }}
    </div>
    <div class="col-md-6">
      {{ select('position_id', '', position()->positions_select(), '', $data->position) }}
    </div>
    <div class="col-md-6">
      {{ input_datepicker('joined_at', '', str_replace('-', '/', $data->joined_at)) }}
    </div>
    <div class="col-md-12">
      <div class="alert alert-info">
        <h4>Read Me :)</h4>
        NIN : National Identity Number (Nomor Induk Kewarganegaraan)<br>
        EIN : Employee Identity Number (Nomor Induk Pegawai)<br>
        Photo may blank if do not to change<br>
        Photo must be .jpg or .png<br>
        Photo Dimension must 300x400 pixel
      </div>
    </div>
    <div class="col-md-12">
    {{ save_button('update').save_close_button('update') }}
    </div>
  </div>
</form>