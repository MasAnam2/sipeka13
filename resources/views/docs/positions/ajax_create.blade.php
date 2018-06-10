<div class="content-wrapper">
  @include('docs.positions.content_header')
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <i class="fa fa-book"></i>
            <h3 class="box-title">Create Position</h3>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                <ol>
                  <li>
                    Click New
                    <br>
                    <div align="center">
                      <img src="{{ asset('images/docs/positions/create/click-new.png') }}" alt="Click New">
                    </div>
                    <br>
                  </li>
                  <li>
                    Enter and type in input form
                    <br>
                    <div align="center">
                      <img src="{{ asset('images/docs/positions/create/enter-and-type.png') }}" alt="Enter and type in input form">
                    </div>
                    <br>
                  </li>
                  <li>
                    Wait until appear success notification
                    <br>
                    <div align="center">
                      <img src="{{ asset('images/docs/positions/create/success-notif.png') }}" alt="Wait until appear success notification">
                    </div>
                    <br>
                  </li>
                  <li>
                    If appear red notification like position has been already been taken, that's mean, the name of position has already in database
                    <br>
                    <div align="center">
                      <img style="max-width: 1000px" src="{{ asset('images/docs/positions/create/failed-alert.png') }}" alt="If appear red notification like position has been already been taken, that's mean, the name of department has already in database">
                    </div>
                    <br>
                  </li>
                </ol>
              </div>
              <div class="col-md-12">
                <a onclick="toDocs()" href="#"><i class="fa fa-long-arrow-left"></i> Back To Docs</a>
                <a onclick="toDocs('/positions/edit', 'Docs | Edit Position')" href="#" class="pull-right">Edit Position <i class="fa fa-long-arrow-right"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>