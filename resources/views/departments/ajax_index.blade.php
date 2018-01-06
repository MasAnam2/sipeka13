<div class="content-wrapper">
  <section class="content-header">
    <h1>Departments</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Departments</li>
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
              <div class="row">
                <form action="{{ route('department.delete_selected') }}">
                  <div class="col-md-12 margin-bottom">
                    {{ export_delete_selected_button('department') }}
                  </div>
                  <div class="col-md-12">
                    <table id="datatable" data-url="{{ route('department.dt') }}" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th width="10px">#</th>
                          <th>Name</th>
                          <th width="200px">Action</th>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </form>
              </div>
            </div>
            <div class="tab-pane" id="new">
              @include('departments.add')
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>