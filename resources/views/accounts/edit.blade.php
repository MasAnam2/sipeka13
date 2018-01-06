{{ form_open(route('account.update')) }}
{{ csrf_field() }}
{{ id_field($data->id) }}
{{ method_field('PUT') }}
{{ input_hidden('old_username', $data->username).input_hidden('employee', $data->employee) }}
<div class="row">
  <div class="col-md-7">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">
          Account Data
        </h3>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            {{ input_text('', 'Employee', '('.$data->emp->ein.') '.$data->emp->name, 'readonly') }}
          </div>
          <div class="col-sm-12">
            {{ select('level', '', account_level_array(), '', $data->level) }}
          </div>
          <div class="col-sm-12">
            {{ input_text('username', '', $data->username) }}
          </div>
          <div class="col-sm-12">
            {{ input_password() }}
          </div>
          <div class="col-sm-12">
            {{ input_password_confirmation() }}
          </div>
          <div class="col-md-12">
            <div class="alert alert-info">
              <h4>Read Me</h4>
              Keep blank password if you don't want to change
            </div>
          </div>
          <div class="col-md-12">
            {{ save_button('update').save_close_button('update') }}
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-5">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Authority</h3>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-12">{{ icheck('departments', '', 1, $data->authority->departments==1 ? 'checked' : '' ) }}</div>
          <div class="col-md-12">{{ icheck('positions', '', 1, $data->authority->positions==1 ? 'checked' : '' ) }}</div>
          <div class="col-md-12">{{ icheck('employees', 'Employee', 1, $data->authority->employees==1 ? 'checked' : '' ) }}</div>
          <div class="col-md-12">{{ icheck('salary_rules', '', 1, $data->authority->salary_rules==1 ? 'checked' : '' ) }}</div>
          <div class="col-md-12">{{ icheck('attendances', '', 1, $data->authority->attendances==1 ? 'checked' : '' ) }}</div>
          <div class="col-md-12">{{ icheck('over_time', '', 1, $data->authority->over_time==1 ? 'checked' : '' ) }}</div>
          <div class="col-md-12">{{ icheck('loans', '', 1, $data->authority->loans==1 ? 'checked' : '' ) }}</div>
          <div class="col-md-12">{{ icheck('accounts', '', 1, $data->authority->accounts==1 ? 'checked' : '' ) }}</div>
          <div class="col-md-12">{{ icheck('salaries', '', 1, $data->authority->salaries==1 ? 'checked' : '' ) }}</div>
          <div class="col-md-12">{{ icheck('company_profile', '', 1, $data->authority->company_profile==1 ? 'checked' : '' ) }}</div>
        </div>
      </div>
    </div>
  </div>
</div>
</form>
<script>
  $('.icheck').iCheck({
    checkboxClass: 'icheckbox_minimal-blue',
    radioClass: 'iradio_minimal-blue'
  });
  $('.select2').select2();
</script>