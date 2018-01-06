<div class="content-wrapper">
  <section class="content-header">
    <h1>Salary Rules</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Salary Rules</li>
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
              <form action="{{ route('salary_rule.delete_selected') }}">
                <div class="row">
                  <div class="col-md-12 margin-bottom">
                    <div class="row">
                      <div class="col-md-4">
                        @if($department == 'all')
                        {{ export_delete_selected_button('salary_rule') }}      
                        @else
                        {{ print_link(route('salary_rule.print_filter', [$department])).excel_link(route('salary_rule.excel_filter', [$department])).pdf_link(route('salary_rule.pdf_filter', [$department])) }}
                        @endif
                      </div>
                      <div class="col-md-4">
                        @include('salary_rules.select_filter')
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <table id="datatable" data-url="{{ $dt_url }}" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Employee</th>
                          <th>Basic Salary (Rp)</th>
                          <th>Allowance (Rp)</th>
                          <th>Eat Cost (Rp)</th>
                          <th>Transportation (Rp)</th>
                          <th width="100px">Action</th>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
              </form>
            </div>
            <div class="tab-pane" id="new">
              @include('salary_rules.add')
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
