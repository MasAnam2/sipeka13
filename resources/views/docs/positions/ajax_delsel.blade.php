<div class="content-wrapper">
  @include('docs.positions.content_header')
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <i class="fa fa-book"></i>
            <h3 class="box-title">Delete Selected Position</h3>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                <ol>
                  <li>
                    Check data will you to delete
                    <br>
                    <div align="center">
                      <img src="{{ asset('images/docs/positions/delete-selected/check.png') }}" alt="Check data will you to delete">
                    </div>
                    <br>
                  </li>
                  <li>
                    Click delete selected button
                    <br>
                    <div align="center">
                      <img src="{{ asset('images/docs/positions/delete-selected/click-delete-selected-btn.png') }}" alt="Click delete selected button">
                    </div>
                    <br>
                  </li>
                  <li>
                    Just wait until popup confirmation appear. Click ok or cancel
                    <br>
                    <div align="center">
                      <img src="{{ asset('images/docs/positions/delete-selected/popup-conf.png') }}" alt="Just wait until popup confirmation appear. Click ok or cancel">
                    </div>
                    <br>
                  </li>
                  <li>
                    If click ok, wait until appear success notification
                    <br>
                    <div align="center">
                      <img src="{{ asset('images/docs/positions/delete-selected/success-notif.png') }}" alt="If click ok, wait until appear success notification">
                    </div>
                    <br>
                  </li>
                </ol>
              </div>
              <div class="col-md-12">
                <a onclick="toDocs('/positions/delete', 'Docs | Delete Position')" href="#"><i class="fa fa-long-arrow-left"></i> Delete Position</a>
                <a onclick="toDocs()" href="#" class="pull-right">Back To Docs <i class="fa fa-long-arrow-right"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>