<?php
function random($ar)
{
  return $ar[array_rand($ar)];
}
$ar = [0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f'];
$colors = [];
for($a=1;$a<=200;$a++)
  array_push($colors, ('#'.random($ar).random($ar).random($ar).random($ar).random($ar).random($ar)));
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta name="description" content="Aplikasi penggajian yang mudah digunakan untuk melakukan penggajian">
  <meta name="keywords" content="HRIS Application, Aplikasi penggajian karyawan, Sistem penggajian karyawan">
  <meta name="author" content="Hairul Anam">
  <title>Login HRIS</title>
  <link href="{{ asset('metro/build/css/metro.css') }}" rel="stylesheet">
  <link href="{{ asset('metro/build/css/metro-icons.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('plugins/animate/animate.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/animate/animate.delay.min.css') }}">
  <link href="{{ asset('metro/build/new_preloader.min.css') }}" rel="stylesheet">
  <script src="{{ asset('metro/build/js/jquery-2.1.3.min.js') }}"></script>
  <script src="{{ asset('metro/build/js/metro.js') }}"></script>
  <style>
    body{
      overflow: hidden;
    }
    .login-form {
      width: 25rem;
      height: 18.75rem;
      position: fixed;
      top: 55%;
      margin-top: -9.375rem;
      left: 50%;
      margin-left: -12.5rem;
      opacity: 0;
      -webkit-transform: scale(.8);
      transform: scale(.8);
      -webkit-transition: .5s;
      transition: .5s;
    }
    .logo-lisun{
      top: 30%;
      left: 50%;
      position: fixed;
      width : 200px;
      height: 100px;
      margin-left: -100px;
      margin-top: -100px;
    }
    .loader{
      width: 100%;
      height: 100%;
      top: 40%;
      left: 50%;
      position: fixed;
      margin-left: -50px;
      margin-top: -50px;
    }
    .lingkaran{
      border: 10px dashed white;
      width: 600px;
      height: 600px;
      background: none;
      border-radius: 50%;
      -webkit-animation: spin 10s infinite;
      -moz-animation: spin 10s infinite;
      animation: spin 10s infinite;
      position: fixed;
      top: 50%;
      left: 50%;
      margin-left: -300px;
      margin-top: -300px;
      overflow: hidden;
      display: none;
      opacity: .8;
    }
    .back-home{
      position: fixed;
      top: 10px;
      left: 10px;
      font-size: 30px;
      border: 5px solid white;
      color: white;
      padding: 5px 5px;
      border-radius: 50%;
      width: 50px;
      height: 50px;
      cursor: pointer;
    }

    <?php echo "
    @-moz-keyframes spin {
      from { -moz-transform: rotate(0deg); }
      to { -moz-transform: rotate(360deg); }
    }
    @-webkit-keyframes spin {
      from { -webkit-transform: rotate(0deg); }
      to { -webkit-transform: rotate(360deg); }
    }
    @keyframes spin {
      from {transform:rotate(0deg);}
      to {transform:rotate(360deg);}
    }
    .rainbow {
      background: ".random($colors).";
      position: relative;
      -webkit-animation: rainbow infinite alternate;  Safari 4.0 - 8.0 
      -webkit-animation-duration: 2s; /* Safari 4.0 - 8.0 */
      animation: rainbow infinite alternate;
      animation-duration: 100s;

    }
    @-webkit-keyframes rainbow {";
    $anim = "";
    for($i=10;$i<=100;$i+=10)
      $anim .= $i."% {background-color: ".random($colors).";} ";
    echo $anim."}
    @keyframes rainbow {".$anim."}"  ?>
  </style>
  <script>
    $(document).ready(function(){
      var form = $(".login-form");
      form.css({
        opacity: 1,
        "-webkit-transform": "scale(1)",
        "transform": "scale(1)",
      });
      setTimeout(function(){
        $('.image-container').addClass('rounded bordered handing ani');
        $('.lingkaran').fadeIn(5000);
      }, 4000);
    });
  </script>
</head>
<body class="rainbow">
  <div class="loader"></div>
  <div class="cc">
    <div class="login-form padding20 block-shadow animate4 animated fadeInUp {{ $bg = set_background(color()) }}">
      <form action="{{ route('login') }}" method="post">
        {{ csrf_field() }}
        <?php $lightColor = ['bg-white', 'bg-grayLighter', 'bg-lightOrange'] ?>
        <h1 class="text-light align-center animate8 animated fadeIn @if(in_array($bg, $lightColor)) fg-black @else fg-white @endif">Login to service</h1>
        <hr class="thin {{ $color = set_background(color()) }} animate10 animated rotateInDownLeft"/>
        <br />
        <div class="input-control text full-size animate10 animated fadeInLeft @if(count($errors)>0) error @endif" data-role="input">
          <label for="username" class="@if(in_array($bg, $lightColor)) fg-black @endif">Username:</label>
          <input required type="text" class="@if(in_array($bg, $lightColor)) bg-black @endif rounded" name="username" id="username">
          <button class="button helper-button clear"><span class="@if(in_array($bg, $lightColor)) fg-black @endif mif-cross"></span></button>
          <span class="help-block margin20 no-margin-left no-margin-right"><strong class="fg-red">@if($errors->has('username')) {{ $errors->first('username') }} @endif</strong></span>
        </div>
        <br />
        <br />
        <div class="input-control password full-size animate12 animated fadeInRight @if(count($errors)>0) error @endif" data-role="input">
          <label for="password" class="@if(in_array($bg, $lightColor)) fg-black @endif">Password:</label>
          <input required type="password" class="@if(in_array($bg, $lightColor)) bg-black @endif" name="password" id="password">
          <button class="button helper-button reveal"><span class="@if(in_array($bg, $lightColor)) fg-black @endif mif-looks"></span></button>
          <span class="help-block"><strong></strong></span>
        </div>
        <br />
        <br />
        <div class="form-actions">
          <div class="animate16 animated bounce" >
            <button onclick="login(event)" type="submit" class="button {{ $color }} full-size animate14 animated fadeIn">Login</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <script type="text/javascript">
    function login(e)
    {
      e.preventDefault();
      $('.cc').fadeOut('slow');
      $('.loader').html('<div data-role="preloader" data-type="ring"></div>').append('<h3 class="margin50 no-margin-left no-margin-right no-margin-bottom fg-white">Login</h3>');
      var login;
      setInterval(function(){
        login = $('.loader').find('h3');
        login.append('.');
        if(login.text()=='Login......')
          login.text('Login');
      }, 200);
      setTimeout(function(){
        $('form').unbind('submit').submit();
      }, 5000);
    }
    function to_home()
    {
      window.location = '{{ route('home') }}'
    }
  </script>
</body>
</html>