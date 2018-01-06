<div class="row">
  <div class="col-md-6">
    <form id="add-enter-form" role="form" action="{{ route('attendance.create') }}" method="post">
      {{ csrf_field() }}
      <div class="panel panel-default">
        <div class="panel-heading">
          Employee To Attendance (One By One)
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-md-12">
              {{ select('employee', '', employee()->employees()) }}
            </div>
            <div class="col-sm-12">
              {{ select('status', '', attendance_status_array(), 'onchange="statusEvent(this)" data-select="status"') }}
            </div>
            <div class="col-md-12">
              {{ input_datepicker('created_at', 'Attendance Date', date('Y/m/d'), 'data-default-value="'.date('Y/m/d').'"') }}
            </div>
            <div class="attendance-time">
              <div class="col-sm-12">
                {{ input_time('enter_at', '', '08:30:00', 'required data-default-value="08:30:00"') }}
              </div>
            </div>
            <div class="attendance-information">
              <div class="col-md-12">
                {{ textarea('information') }}
              </div>
            </div>
            <div class="col-sm-12">
              {{ save_button() }}
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
  <div class="col-md-6">
    <form id="add-enter-multiply-form" role="form" action="{{ route('attendance.create_by_excel') }}" method="post">
      {{ csrf_field() }}
      <div class="panel panel-default">
        <div class="panel-heading">
          Employee To Attendance (Load From Excel File)
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-md-12">
              {{ input_file('attendance_excel', '', 'accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel"') }}
            </div>
            <div class="col-md-12">
              <div class="alert alert-info">
                <h4><i class="icon fa fa-info-circle"></i> Please Read :)</h4>
                File extension must .xls or .xlsx<br>
                <a target="_blank" href="{{ asset('storage/attendances/example/attendance_import_example.xlsx') }}">Download</a> this example for rule of attendance file <br>
                If you upload many rows, upload will be take a long time
              </div>
            </div>
            <div class="col-sm-12">
              {{ save_button() }}
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
<script>
  $("[data-mask]").inputmask();
</script>