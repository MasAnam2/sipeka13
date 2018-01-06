<form id="dis-form" action="{{ $disable }}" method="post">
	{{ csrf_field() }}
	<input type="hidden" name="id" id="dis-id">
	{{ method_field('DELETE') }}
</form>