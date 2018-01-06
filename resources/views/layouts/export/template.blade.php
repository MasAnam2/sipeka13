<!DOCTYPE html>
<html>
<head>
	<title>Print</title>
	{{-- <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}"> --}}
	<link rel="stylesheet" type="text/css" href="{{ asset('css/report.css') }}">
	@stack('css')
	<style>
		@if(contain(url()->current(), 'pdf'))
		.company-logo{
			position: absolute;
			left: 0px;
			top: 0px;
		}		
		@endif
	</style>
</head>
<body>
	<div class="container-fluid">
		@yield('content')
	</div>
	<script src="{{ asset('plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
	<script type="text/javascript">
		window.print();
		$(document).ready(function(){
			@stack('ready-function');
		});
	</script>
</body>
</html>