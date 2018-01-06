<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php if(!isset($title)){ echo '404 Not Found'; }else{ echo $title; } ?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta content="{{ csrf_token() }}" name="csrf_token" id="csrf-token">
  <meta content="{{ config('app.url') }}" name="csrf-token">
  {{-- <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}"> --}}
  {{-- <link rel="stylesheet" href="{{ asset('plugins/font-awesome/4.5.0/css/font-awesome.min.css') }}"> --}}
  {{-- <link rel="stylesheet" href="{{ asset('plugins/ionicons/2.0.1/css/ionicons.min.css') }}"> --}}
  {{-- <link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}"> --}}
  {{-- <link rel="stylesheet" href="{{ asset('plugins/select2/select2.min.css') }}"> --}}
  {{-- <link rel="stylesheet" href="{{ asset('plugins/datepicker/datepicker3.css') }}"> --}}
  <link rel="stylesheet" href="{{ asset('spk/dist/css/spk-libraries.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/iCheck/all.css') }}">
  {{-- <link rel="stylesheet" href="{{ asset('plugins/fonts/sourcesanspro/v9/css/style.css') }}"> --}}
  {{-- <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}"> --}}
  {{-- <link rel="stylesheet" href="{{ asset('dist/css/skins/_all-skins.min.css') }}"> --}}
  {{-- <script src="{{ asset('plugins/jQuery/jquery-2.2.3.min.js') }}"></script> --}}
</head>