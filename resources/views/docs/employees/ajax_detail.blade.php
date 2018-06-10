<div class="content-wrapper">
  @include('docs.employees.content_header')
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <i class="fa fa-book"></i>
            <h3 class="box-title">Employee Detail</h3>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                <ol>
                  <li>
                    Click detail button
                    <br>
                    <div align="center">
                      <img style="max-width: 1000px" src="{{ asset('images/docs/employees/detail/click-detail-btn.png') }}" alt="Click detail button">
                    </div>
                    <br>
                  </li>
                  <li>
                    Please wait until appear detail view
                    <br>
                    <div align="center">
                      <img style="max-width: 1000px" src="{{ asset('images/docs/employees/detail/detail-view.png') }}" alt="Please read instruction alert before">
                    </div>
                    <br>
                  </li>
                  <li>
                    If photo appear like above, that's mean employee photo not set yet. So turn back to default photo
                    <br>
                  </li>
                </ol>
              </div>
              <div class="col-md-12">
                <a onclick="toDocs('/employees/create', 'Docs | Create Employee')" href="#"><i class="fa fa-long-arrow-left"></i> Create Employee</a>
                <a onclick="toDocs('/employees/other', 'Docs | Other Employee Docs')" href="#" class="pull-right">Other Employee Docs <i class="fa fa-long-arrow-right"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>