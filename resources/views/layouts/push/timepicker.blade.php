@push('css')
<link rel="stylesheet" href="{{ asset('plugins/timepicker/bootstrap-timepicker.min.css') }}">
@endpush
@push('script')
<script src="{{ asset('plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
@endpush
@push('ready-function')
$(".timepicker").timepicker({
  showInputs: false,
  minuteStep : 1,
  secondStep : 1,
  showSeconds : true,
  showMeridian : false
});
@endpush