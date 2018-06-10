<div class="content-wrapper">
  @include('docs.employees.content_header')
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <i class="fa fa-book"></i>
            <h3 class="box-title">Delete Employee</h3>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                <ol>
                  <li>
                    Click delete button
                    <br>
                    <div align="center">
                      <img src="{{ asset('images/docs/employees/delete/click-delete-btn.png') }}" alt="Click delete button">
                    </div>
                    <br>
                  </li>
                  <li>
                    Just wait until popup confirmation appear. Click ok or cancel
                    <br>
                    <div align="center">
                      <img src="{{ asset('images/docs/employees/delete/popup-conf.png') }}" alt="Just wait until popup confirmation appear. Click ok or cancel">
                    </div>
                    <br>
                  </li>
                  <li>
                    If click ok, wait until appear success notification
                    <br>
                  </li>
                </ol>
              </div>
              <div class="col-md-12">
                <a onclick="toDocs('/employees/edit', 'Docs | Edit Employee')" href="#"><i class="fa fa-long-arrow-left"></i> Edit Employee</a>
                <a onclick="toDocs('/employees/delete-selected', 'Docs | Delete Selected Employee')" href="#" class="pull-right">Delete Selected Employee <i class="fa fa-long-arrow-right"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>