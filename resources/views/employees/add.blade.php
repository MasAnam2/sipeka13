<form role="form" action="{{ route('employee.create') }}" method="post" enctype="multipart/form-data">
  {{ csrf_field() }}
  <div class="row">
    <div class="col-md-6">
      {{ input_text('nin', 'NIN') }}
    </div>
    <div class="col-md-6">
      {{ input_text('ein', 'EIN') }}
    </div>
    <div class="col-md-6">
      {{ input_text('name') }}
    </div>
    <div class="col-md-6">
      {{ select('gender', '', ['Male', 'Female']) }}
    </div>
    <div class="col-md-6">
      {{ input_text('born_in') }}
    </div>
    <div class="col-md-6">
      {{ input_datepicker('birthdate') }}
    </div>
    <div class="col-md-6">
      {{ input_text('city', 'City Now') }}
    </div>
    <div class="col-md-6">
      {{ select('marital_status', '', ['Maried','No Maried']) }}
    </div>
    <div class="col-md-12">
      {{ textarea('address', 'Full Address') }}
    </div>
    <div class="col-md-6">
      {{ input_text('last_education') }}
    </div>
    <div class="col-md-6">
      {{ input_file('photo', '', 'accept="image/*"') }}
    </div>
    <div class="col-md-6">
      {{ select('department_id', '', department()->departments_select()) }}
    </div>
    <div class="col-md-6">
      {{ select('position_id', '', position()->positions_select()) }}
    </div>
    <div class="col-md-6">
      {{ input_datepicker('joined_at') }}
    </div>
    <div class="col-md-12">
      <div class="alert alert-info">
        <h4>Read Me :)</h4>
        NIN : National Identity Number (Nomor Induk Kewarganegaraan)<br>
        EIN : Employee Identity Number (Nomor Induk Pegawai)<br>
        Photo must be .jpg or .png<br>
        Photo Dimension must 300x400 pixel
      </div>
    </div>
    <div class="col-md-12">
    {{ save_button() }}
    </div>
  </div>
</form>