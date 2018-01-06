@push('modal')
<div class="modal fade detail-modal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title detail-title"></h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12 detail-body">
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endpush
@push('function')
function detail(id) 
{
  $.ajax({
    type : 'POST',
    url : '{{ $detail_route }}',
    data : {
      _token : '{{ csrf_token() }}',
      id : id
    },
    success : function(resp)
    {
      $('.detail-body').html(resp);
      $('.detail-title').text('Mutation Detail');
      $('.detail-modal').modal();
    }
  });
}
@endpush