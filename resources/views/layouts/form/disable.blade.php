<form id="disable-form" action="{{ $disable }}" method="post">
	{{ csrf_field() }}
	<input type="hidden" name="id" id="disable-id">
	<input type="hidden" name="_method" value="DELETE">
</form>