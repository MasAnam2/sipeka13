<div class="content-wrapper">
  <section class="content-header">
    <h1>Loans</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Loans</li>
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
              <form action="{{ route('loan.delete_selected') }}">
                <div class="row">
                  <div class="col-md-12 margin-bottom">
                    <div class="row">
                      <div class="col-md-4">
                        {{ export_delete_selected_button('loan') }}
                      </div>
                      <div class="col-md-8">
                        @include('loans.select_filter')
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <table id="datatable" data-url="{{ route('loan.dt') }}" class="table table-bordered table-striped">
                      @include('loans.thead')
                    </table>
                  </div>
                </div>
              </form>
            </div>
            <div class="tab-pane" id="new">
              @include('loans.add')
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>