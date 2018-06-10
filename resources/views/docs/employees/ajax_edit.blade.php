<div class="content-wrapper">
  @include('docs.employees.content_header')
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <i class="fa fa-book"></i>
            <h3 class="box-title">Edit Employee</h3>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                <ol>
                  <li>
                    Click edit button
                    <br>
                    <div align="center">
                      <img src="{{ asset('images/docs/employees/edit/click-edit-btn.png') }}" alt="Click edit button">
                    </div>
                    <br>
                  </li>
                  <li>
                    Please read instruction alert before
                    <br>
                    <div align="center">
                      <img style="max-width: 1000px" src="{{ asset('images/docs/employees/edit/read-me-first.png') }}" alt="Please read instruction alert before">
                    </div>
                    <br>
                  </li>
                  <li>
                    Just wait until popup edit form appear. Enter and edit input form
                    <br>
                    <div align="center">
                      <img src="{{ asset('images/docs/employees/edit/enter-and-type.png') }}" alt="Just wait until popup edit form appear. Enter and type in input form">
                    </div>
                    <br>
                  </li>
                  <li>
                    Click save or save&close button
                    <br>
                    <div align="center">
                      <img style="max-width: 1000px" src="{{ asset('images/docs/employees/edit/save-btn.png') }}" alt="Click save button">
                    </div>
                    <br>
                  </li>
                  <li>
                    Wait until appear success notification
                    <br>
                  </li>
                  <li>
                    If appear red notification, check form again, maybe there is input that cannot pass
                    <br>
                    <div align="center">
                      <img style="max-width: 1000px" src="{{ asset('images/docs/employees/edit/failed-alert.png') }}" alt="If appear red notification, check form again, maybe there is input that cannot pass">
                    </div>
                    <br>
                  </li>
                </ol>
              </div>
              <div class="col-md-12">
                <a onclick="toDocs('/employees/detail', 'Docs | Employee Detail')" href="#"><i class="fa fa-long-arrow-left"></i> Employee Detail</a>
                <a onclick="toDocs('/employees/delete', 'Docs | Delete Employee')" href="#" class="pull-right">Delete Employee <i class="fa fa-long-arrow-right"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>