<div class="content-wrapper">
  <section class="content-header">
    <h1>Positions</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Positions</li>
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
            <form action="{{ route('position.delete_selected') }}">
                <div class="row">
                  <div class="col-md-12 margin-bottom">
                    {{ export_delete_selected_button('position') }}
                  </div>
                  <div class="col-md-12 tbl">
                    <table id="datatable" data-url="{{ route('position.dt') }}" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th width="10px">#</th>
                          <th>Name</th>
                          <th width="200px">Action</th>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
              </form>
            </div>
            <div class="tab-pane" id="new">
              @include('positions.add')
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>