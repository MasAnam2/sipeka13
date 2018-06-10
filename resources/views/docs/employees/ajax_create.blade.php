<div class="content-wrapper">
  @include('docs.employees.content_header')
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <i class="fa fa-book"></i>
            <h3 class="box-title">Create Employee</h3>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                <ol>
                  <li>
                    Click New
                    <br>
                    <div align="center">
                      <img style="max-width: 1000px" src="{{ asset('images/docs/employees/create/click-new.png') }}" alt="Click New">
                    </div>
                    <br>
                  </li>
                  <li>
                    Please read instruction alert before
                    <br>
                    <div align="center">
                      <img style="max-width: 1000px" src="{{ asset('images/docs/employees/create/read-me-first.png') }}" alt="Please read instruction alert before">
                    </div>
                    <br>
                  </li>
                  <li>
                    Enter and fill all input form
                    <br>
                    <div align="center">
                      <img style="max-width: 1000px" src="{{ asset('images/docs/employees/create/enter-and-type.png') }}" alt="Enter and fill all input form">
                    </div>
                    <br>
                  </li>
                  <li>
                    Click save button
                    <br>
                    <div align="center">
                      <img style="max-width: 1000px" src="{{ asset('images/docs/employees/create/click-save-btn.png') }}" alt="Click save button">
                    </div>
                    <br>
                  </li>
                  <li>
                    Wait until appear success notification
                  </li>
                  <li>
                    If appear red notification, check form again, maybe there is input that cannot pass
                    <br>
                    <div align="center">
                      <img style="max-width: 1000px" src="{{ asset('images/docs/employees/create/failed-alert.png') }}" alt="If appear red notification, check form again, maybe there is input that cannot pass">
                    </div>
                    <br>
                  </li>
                </ol>
              </div>
              <div class="col-md-12">
                <a onclick="toDocs()" href="#"><i class="fa fa-long-arrow-left"></i> Back To Docs</a>
                <a onclick="toDocs('/employees/detail', 'Docs | Employee Detail')" href="#" class="pull-right">Employee Detail <i class="fa fa-long-arrow-right"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>