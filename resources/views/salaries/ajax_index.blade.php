<div class="content-wrapper">
  <section class="content-header">
    <h1>Salaries</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Salaries</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        {{ success_failed_alert() }}
      </div>
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Filter</h3>
          </div>
          <div class="box-body">
            <div class="row">
              {{-- @foreach(range(1, 12) as $month)
              <div class="col-md-2">
                {{ icheck('filter_month', english_month_name($month), $month) }}
              </div>
              @endforeach --}}
              <div class="col-md-3">
                {{ input_datepicker('filter_date_salaries', 'Filter Period (Year - Month)', $date) }}
              </div>
              <div class="col-md-3">
                <label for="">Click to filter</label>
                <br>
                {!! primBtn('Filter', 'onclick="filterSalaries()"') !!}
              </div>
            </div>
          </div>
        </div>
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
                <div class="col-md-12 margin-bottom">
                  @if($date == '')
                  {{ export_delete_selected_button('salary') }}      
                  @else
                  {{ print_link(route('salary.print_filter', [$date])).excel_link(route('salary.excel_filter', [$date])).pdf_link(route('salary.pdf_filter', [$date])) }}
                  @endif
                </div>
                <div class="col-md-12 tbl">
                  <table id="datatable" data-url="{{ $dt_url }}" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th width="10px">#</th>
                        <th>Employee</th>
                        <th>Created At</th>
                        <th>Period</th>
                        <th>Clear Salary (Rp)</th>
                        <th width="200px">Action</th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="new">
              @include('salaries.add')
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>