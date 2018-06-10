<div class="content-wrapper">
  @include('docs.departments.content_header')
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <i class="fa fa-book"></i>
            <h3 class="box-title">Create Department</h3>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                <ol>
                  <li>
                    Click New
                    <br>
                    <div align="center">
                      <img src="{{ asset('images/docs/department/create/click-new.png') }}" alt="Click New">
                    </div>
                    <br>
                  </li>
                  <li>
                    Enter and type in input form
                    <br>
                    <div align="center">
                      <img src="{{ asset('images/docs/department/create/enter-and-type.png') }}" alt="Enter and type in input form">
                    </div>
                    <br>
                  </li>
                  <li>
                    Wait until appear success notification
                    <br>
                    <div align="center">
                      <img src="{{ asset('images/docs/department/create/success-notif.png') }}" alt="Wait until appear success notification">
                    </div>
                    <br>
                  </li>
                  <li>
                    If appear red notification like department has been already been taken, that's mean, the name of department has already in database
                    <br>
                    <div align="center">
                      <img src="{{ asset('images/docs/department/create/failed-alert.png') }}" alt="If appear red notification like department has been already been taken, that's mean, the name of department has already in database">
                    </div>
                    <br>
                  </li>
                </ol>
              </div>
              <div class="col-md-12">
                <a onclick="toDocs()" href="#"><i class="fa fa-long-arrow-left"></i> Back To Docs</a>
                <a onclick="toDocs('/departments/edit', 'Docs | Edit Department')" href="#" class="pull-right">Edit Department <i class="fa fa-long-arrow-right"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>