{{ form_open(route('position.create')) }}
  {{ csrf_field() }}
  <div class="row">
    <div class="col-md-12">
      {{ input_multi_text('name') }}
    </div>
    <div class="col-md-12">
      {{ save_button() }}
    </div>
  </div>
</form>