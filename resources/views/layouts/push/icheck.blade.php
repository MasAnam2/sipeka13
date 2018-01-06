@push('css')
<link rel="stylesheet" href="{{ asset('plugins/iCheck/all.css') }}">
@endpush
@push('script')
<script src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>
@endpush
@push('ready-function')
$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
  checkboxClass: 'icheckbox_minimal-blue',
  radioClass: 'iradio_minimal-blue'
});
@endpush