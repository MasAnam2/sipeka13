<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>login | {{ companyName() }}</title>
  <meta content="{{ csrf_token() }}" name="csrf-token" id="csrf-token">
  <meta content="{{ config('app.url') }}" name="base-url">
  <link rel="stylesheet" href="{{ asset('spk/dist/css/login.min.css') }}">
</head>
<body>
  <div class="wrapper">
    <div class="company-name">
      {{ companyName() }}
    </div>
    <form class="login" action="{{ route('login') }}">
      <p class="title">Log in to access menu</p>
      <input name="username" type="text" placeholder="Username" autofocus/>
      <i class="fa fa-user"></i>
      <input name="password" type="password" placeholder="Password" />
      <i class="fa fa-key"></i>
      <button>
        <i class="spinner"></i>
        <span class="state">Log in</span>
      </button>
    </form>
    <div class="alert"></div>
  </p>
</div>
<script src="{{ asset('spk/dist/js/login-libraries.min.js') }}"></script>
<script src="{{ asset('spk/dist/js/login.js') }}"></script>
{{-- <script src="{{ asset('spk/dist/js/login-fix.min.js') }}"></script> --}}
</body>
</html>
