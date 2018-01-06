<form id="remove-form" action="{{ route($modul.'.remove') }}" method="post">
	{{ csrf_field() }}
	<input type="hidden" name="id" id="remove-id">
	<input type="hidden" name="_method" value="DELETE">
</form>
@push('function')
function remove(id)
{
  var confir = confirm('Are you sure?');
  if(confir){
    $('#remove-id').val(id);
    $('#remove-form').submit();
  }
}
@endpush