<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php if(!isset($title)){ echo '404 Not Found'; }else{ echo $title; } ?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta content="{{ csrf_token() }}" name="csrf-token" id="csrf-token">
  <meta content="{{ config('app.url') }}" name="base-url">
  <link rel="stylesheet" href="{{ asset('spk/dist/css/spk-libraries.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/iCheck/all.css') }}">
</head>
<body class="hold-transition skin-purple sidebar-mini">
	<div id="app">
		<div class="wrapper">
			@include('layouts.header')
			@include('layouts.leftbar')
			<div class="callout callout-success" style="position: fixed; right: 5px; top: 5px; display: none; z-index: 9999;" id="callout-success">
				<h4>Success</h4>
				<p></p>
			</div>
			<div class="callout callout-danger" style="position: fixed; right: 5px; top: 5px; display: none; z-index: 9999;" id="callout-danger">
				<h4>Failed</h4>
				<p></p>
			</div>
			@yield('content')
			@include('layouts.footer')
			{{-- @include('layouts.rightbar') --}}
			@include('layouts.modal')
		</div>
		<div class="msg">
			<div class="callout callout-success">
				<h4>Success</h4>
				<p></p>
			</div>
			<div class="callout callout-danger">
				<h4>Failed</h4>
				<p></p>
			</div>
		</div>
	</div>
	<script src="{{ asset('spk/dist/js/spk-libraries.min.js') }}"></script>
	<script src="{{ asset('spk/dist/js/app.min.js') }}"></script>
	{{-- <script src="{{ asset('spk/dist/js/app.js') }}"></script> --}}
</body>
</html>