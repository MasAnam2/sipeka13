<form onsubmit="save(this, event)" role="form" action="{{ route('department.create') }}" method="post">
  {{ csrf_field() }}
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="name">Name</label>
        <select name="name[]" id="name" multiple class="form-control select2" style="width: 100%;"></select>
        <span class="help-block">
          <strong></strong>
        </span>
      </div>
    </div>
    <div class="col-md-12">
    {{ save_button() }}
    </div>
  </div>
</form>