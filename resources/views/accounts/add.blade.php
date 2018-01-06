{{ form_open(route('account.create')) }}
{{ csrf_field() }}
<div class="row">
  <div class="col-md-9">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">
          Account Data
        </h3>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            {{ select('employee', '', $employee_model->employees()) }}
          </div>
          <div class="col-sm-12">
            {{ select('level', '', account_level_array()) }}
          </div>
          <div class="col-sm-12">
            {{ input_text('username') }}
          </div>
          <div class="col-sm-12">
            {{ input_password() }}
          </div>
          <div class="col-sm-12">
            {{ input_password_confirmation() }}
          </div>
          <div class="col-md-12">
            <div class="alert alert-info">
              <h4>Read Me :)</h4>
              If employee already had an account before then be overwritten (updated)
            </div>
          </div>
          <div class="col-md-12">
            {{ save_button() }}
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Authority</h3>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-12">{{ icheck(' ', 'Check All', '', 'data-menu="check-all"') }}</div>
          <div class="col-md-12">{{ icheck('departments', '', 1, 'data-menu="member"') }}</div>
          <div class="col-md-12">{{ icheck('positions', '', 1, 'data-menu="member"') }}</div>
          <div class="col-md-12">{{ icheck('employees', '', 1, 'data-menu="member"') }}</div>
          <div class="col-md-12">{{ icheck('salary_rules', '', 1, 'data-menu="member"') }}</div>
          <div class="col-md-12">{{ icheck('attendances', '', 1, 'data-menu="member"') }}</div>
          <div class="col-md-12">{{ icheck('over_time', '', 1, 'data-menu="member"') }}</div>
          <div class="col-md-12">{{ icheck('loans', '', 1, 'data-menu="member"') }}</div>
          <div class="col-md-12">{{ icheck('accounts', '', 1, 'data-menu="member"') }}</div>
          <div class="col-md-12">{{ icheck('salaries', '', 1, 'data-menu="member"') }}</div>
          <div class="col-md-12">{{ icheck('company_profile', '', 1, 'data-menu="member"') }}</div>
        </div>
      </div>
    </div>
  </div>
</div>
</form>

<script>
  function accountEvent(){
    $('[data-menu="check-all"]').on('ifChecked', function(e){
      $('[data-menu="member"]').iCheck('check');
    });

    $('[data-menu="check-all"]').on('ifUnchecked', function(e){
      $('[data-menu="member"]').iCheck('uncheck');
    });
  }
</script>