{{ form_open(route('salary.create')) }}
{{ csrf_field() }}
<div class="row salary-row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header">
        <h4 class="title">Insert Individual</h4>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-3">
            {{ select('employee', '', employee()->employees(), 'onchange="checkSalary(this)" data-salary="ddd"') }}
          </div>
          <div class="col-md-3">
            {{ input_datepicker('created_at', '', date('Y/m/d'), 'data-default-value="'.date('Y/m/d').'"') }}
          </div>
          <div class="col-md-3">
            {{ select('month', '', getMonthArray(), 'onchange="checkSalary(this)"', date('m')) }}
          </div>
          <div class="col-md-3">
            {{ select('year', '', getYearFromBuildArray(), 'onchange="checkSalary(this)"', date('Y')) }}
          </div>
          <div class="salary-content">
          </div>
          <div class="col-md-12">
            {{ save_button() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</form>