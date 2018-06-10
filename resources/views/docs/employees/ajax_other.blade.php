<div class="content-wrapper">
  @include('docs.employees.content_header')
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <i class="fa fa-book"></i>
            <h3 class="box-title">Other Employee Docs</h3>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                <ul>
                  <li>
                    There are 3 kinds to export data, choose what you needed
                    <br>
                    <div align="center">
                      <img src="{{ asset('images/docs/employees/other/3-kinds.png') }}" alt="Check data will you to delete">
                    </div>
                    <br>
                  </li>
                  <li>
                    Why department and position appear {!! merah('NOT SET') !!} ? It is happen because department or position has been deleted
                    <br>
                    <div align="center">
                      <img src="{{ asset('images/docs/employees/other/not-set-info.png') }}" alt="Check data will you to delete">
                    </div>
                    <br>
                  </li>
                </ul>
              </div>
              <div class="col-md-12">
                <a onclick="toDocs('/employees/delete-selected', 'Docs | Delete Selected Employee')" href="#"><i class="fa fa-long-arrow-left"></i> Delete Selected Employee</a>
                <a onclick="toDocs()" href="#" class="pull-right">Back To Docs <i class="fa fa-long-arrow-right"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>