<div class="content-wrapper">
  <section class="content-header">
    <h1>Company Profile</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Company Profile</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        {{ success_failed_alert() }}
      </div>
      <div class="col-md-6">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">
              Company Profile
            </h3>
            <div class="box-tools pull-right">
              <button onclick="companyEdit(event)" data-toggle="tooltip" title="Edit" type="button" class="btn btn-primary btn-xs">
                <i class="fa fa-pencil"></i>
              </button>
            </div>
          </div>
          <div class="box-body" id="company-profile-view">
            @include('company_profile.view')
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<div class="modal fade" id="company-modal-edit">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('company_profile.update') }}" id="company-modal-edit-form" onsubmit="updateCompanyProfile(event, this)">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title">Company Profile Edit</h4>
        </div>
        <div class="modal-body"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          {{ simpanBtn('Save changes') }}
        </div>
      </form>
    </div>
  </div>
</div>