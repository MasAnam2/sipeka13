<div class="content-wrapper">
  @include('docs.departments.content_header')
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <i class="fa fa-book"></i>
            <h3 class="box-title">Edit Department</h3>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                <ol>
                  <li>
                    Click edit button
                    <br>
                    <div align="center">
                      <img src="{{ asset('images/docs/department/edit/click-edit-btn.png') }}" alt="Click edit button">
                    </div>
                    <br>
                  </li>
                  <li>
                    Just wait until popup edit form appear. Enter and type in input form
                    <br>
                    <div align="center">
                      <img src="{{ asset('images/docs/department/edit/enter-and-type.png') }}" alt="Just wait until popup edit form appear. Enter and type in input form">
                    </div>
                    <br>
                  </li>
                  <li>
                    Wait until appear success notification
                    <br>
                    <div align="center">
                      <img src="{{ asset('images/docs/department/edit/success-notif.png') }}" alt="Wait until appear success notification">
                    </div>
                    <br>
                  </li>
                  <li>
                    If appear red notification like department has been already been taken, that's mean, the name of department has already in database
                    <br>
                    <div align="center">
                      <img src="{{ asset('images/docs/department/edit/failed-alert.png') }}" alt="If appear red notification like department has been already been taken, that's mean, the name of department has already in database">
                    </div>
                    <br>
                  </li>
                </ol>
              </div>
              <div class="col-md-12">
                <a onclick="toDocs('/departments/create', 'Docs | Delete Department')" href="#"><i class="fa fa-long-arrow-left"></i> Create Department</a>
                <a onclick="toDocs('/departments/delete', 'Docs | Delete Department')" href="#" class="pull-right">Delete Department <i class="fa fa-long-arrow-right"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>