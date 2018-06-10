<div class="content-wrapper">
  @include('docs.positions.content_header')
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <i class="fa fa-book"></i>
            <h3 class="box-title">Delete Position</h3>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                <ol>
                  <li>
                    Click delete button
                    <br>
                    <div align="center">
                      <img src="{{ asset('images/docs/positions/delete/click-delete-btn.png') }}" alt="Click delete button">
                    </div>
                    <br>
                  </li>
                  <li>
                    Just wait until popup confirmation appear. Click ok or cancel
                    <br>
                    <div align="center">
                      <img src="{{ asset('images/docs/positions/delete/popup-conf.png') }}" alt="Just wait until popup confirmation appear. Click ok or cancel">
                    </div>
                    <br>
                  </li>
                  <li>
                    If click ok, wait until appear success notification
                    <br>
                    <div align="center">
                      <img src="{{ asset('images/docs/positions/delete/success-notif.png') }}" alt="If click ok, wait until appear success notification">
                    </div>
                    <br>
                  </li>
                </ol>
              </div>
              <div class="col-md-12">
                <a onclick="toDocs('/positions/edit', 'Docs | Edit Position')" href="#"><i class="fa fa-long-arrow-left"></i> Edit Position</a>
                <a onclick="toDocs('/positions/delete-selected', 'Docs | Delete Selected Position')" href="#" class="pull-right">Delete Selected Position <i class="fa fa-long-arrow-right"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>