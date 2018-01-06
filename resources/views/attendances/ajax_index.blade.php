<div class="content-wrapper">
  <section class="content-header">
    <h1>Attendances</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Attendances</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        {{ success_failed_alert() }}
      </div>
      <div class="col-xs-12">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#data" data-toggle="tab">Data</a></li>
            <li><a href="#new" data-toggle="tab">New</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="data">
              <form action="{{ route('attendance.delete_selected') }}">
                <div class="row">
                  <div class="col-md-12 margin-bottom">
                    <div class="row">
                      <div class="col-md-2">
                        {{ export_delete_selected_button('attendance') }}      
                      </div>
                      <div class="col-md-2">
                        @include('attendances.select_filter')
                      </div>
                      @include('attendances.filter_by_date')
                    </div>
                  </div>
                  <div class="col-md-12">
                    <table id="datatable" data-url="{{ route('attendance.dt') }}" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Employee</th>
                          <th>Created At</th>
                          <th>Status</th>
                          <th>Enter At</th>
                          <th>Out At</th>
                          <th>Information</th>
                          <th width="80px">Action</th>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
              </form>
            </div>
            <div class="tab-pane" id="new">
              @include('attendances.add')
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
