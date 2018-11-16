<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">

<!-- Mirrored from getbootstrapadmin.com/remark/base/pages/login-v2.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 13 Nov 2018 04:19:03 GMT -->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="bootstrap admin template">
  <meta name="author" content="">

  <title>Login | {{ config('app.name', 'Sistem Informasi Miftahul Huda') }}</title>

  <link rel="apple-touch-icon" href="{{asset('/assets/img/logo/apple-touch-icon.png')}}">
  <link rel="shortcut icon" href="{{asset('/assets/img/logo/favicon.ico')}}">

  <!-- Stylesheets -->
  <link rel="stylesheet" href="{{asset('/assets/css/bootstrap.min599c.css')}}">
  <link rel="stylesheet" href="{{asset('/assets/css/bootstrap-extend.min599c.css')}}">
  <link rel="stylesheet" href="{{asset('/assets/css/site.min599c.css')}}">

  <!-- Plugins -->
  <link rel="stylesheet" href="{{asset('/assets/vendor/asscrollable/asScrollable.min599c.css')}}">
  <link rel="stylesheet" href="{{asset('/assets/vendor/switchery/switchery.min599c.css')}}">
  <link rel="stylesheet" href="{{asset('/assets/vendor/intro-js/introjs.min599c.css')}}">
  <link rel="stylesheet" href="{{asset('/assets/vendor/slidepanel/slidePanel.min599c.css')}}">
  <link rel="stylesheet" href="{{asset('/assets/vendor/flag-icon-css/flag-icon.min599c.css')}}">

  <!-- Page -->
  <link rel="stylesheet" href="{{asset('/assets/css/pages/login-v2.min599c.css')}}">

  <!-- Fonts -->
  <link rel="stylesheet" href="{{asset('/assets/fonts/web-icons/web-icons.min599c.css')}}">
  <link rel="stylesheet" href="{{asset('/assets/fonts/brand-icons/brand-icons.min599c.css')}}">
  <link rel='stylesheet' href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic">


  <!--[if lt IE 9]>
    <script src="../../global/vendor/html5shiv/html5shiv.min.js?v4.0.2"></script>
    <![endif]-->

  <!--[if lt IE 10]>
    <script src="../../global/vendor/media-match/media.match.min.js?v4.0.2"></script>
    <script src="../../global/vendor/respond/respond.min.js?v4.0.2"></script>
    <![endif]-->

  <!-- Scripts -->
  <script src="{{asset('/assets/vendor/breakpoints/breakpoints.min599c.js')}}"></script>
  <script>
    Breakpoints();
  </script>
</head>
<body class="animsition page-login-v2 layout-full page-dark">
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
  <style>
    body {
      background: transparent;
    }
  </style>
  <!-- Page -->
  <div class="page" data-animsition-in="fade-in" data-animsition-out="fade-out">
    <div class="page-content">
      <div class="page-brand-info">
        <div class="brand">
          <img class="brand-img" src="assets/img/logo/logo@2x.png" alt="...">
          <h2 class="brand-text font-size-40">Simida</h2>
        </div>
        <p class="font-size-20">Pesantren Miftahul-Huda Manonjaya Tasikmalaya bentuk penerus bangsa berakhlakul karimah imtaq cerdas terampil dan jiwa usaha.</p>
      </div>

      <div class="page-login-main animation-slide-right animation-duration-1">
        <div class="brand hidden-md-up"> <!--  -->
          <h3 class="brand-text font-size-40">Simida</h3>
        </div>
        <h3 class="font-size-24">Sign In</h3>
        <p>Silahkan masukan Username & Password untuk melanjutkan.</p>

        <form method="post" action="{{ route('login') }}">
            {{ csrf_field() }}
          <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
            <label class="sr-only" for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Username.." value="{{ old('username') }}" autofocus>
            @if ($errors->has('username'))
                <span class="help-block">
                    <strong>{{ $errors->first('username') }}</strong>
                </span>
            @endif
          </div>
          <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label class="sr-only" for="inputPassword">Password</label>
            <input type="password" class="form-control" id="inputPassword" name="password"
              placeholder="Password">
            @if ($errors->has('passwrod'))
                <span class="help-block">
                    <strong>{{ $errors->first('passwrod') }}</strong>
                </span>
            @endif
          </div>
          <div class="form-group clearfix">
            <div class="checkbox-custom checkbox-inline checkbox-primary float-left">
              <input type="checkbox" id="rememberMe" name="remember" {{ old('remember') ? 'checked' : '' }}>
              <label for="rememberMe">Remember me</label>
            </div>
            <a class="float-right" href="{{ route('password.request') }}">
                Forgot Your Password?
            </a>
          </div>
          <button type="submit" class="btn btn-primary btn-block">Sign in</button>
        </form>

        <!-- <p>No account? <a href="register-v2.html">Sign Up</a></p> -->

        <footer class="page-copyright">
          <p>© 2018 Simida</p>
<!--
          <div class="social">
            <a class="btn btn-icon btn-round social-twitter mx-5" href="javascript:void(0)">
            <i class="icon bd-twitter" aria-hidden="true"></i>
          </a>
            <a class="btn btn-icon btn-round social-facebook mx-5" href="javascript:void(0)">
            <i class="icon bd-facebook" aria-hidden="true"></i>
          </a>
            <a class="btn btn-icon btn-round social-google-plus mx-5" href="javascript:void(0)">
            <i class="icon bd-google-plus" aria-hidden="true"></i>
          </a>
          </div>
-->
        </footer>
      </div>

    </div>
  </div>
  <!-- End Page -->


  <!-- Core  -->
  <script src="{{asset('/assets/vendor/babel-external-helpers/babel-external-helpers599c.js?v4.0.2')}}"></script>
  <script src="{{asset('/assets/vendor/jquery/jquery.min599c.js?v4.0.2')}}"></script>
  <script src="{{asset('/assets/vendor/popper-js/umd/popper.min599c.js?v4.0.2')}}"></script>
  <script src="{{asset('/assets/vendor/bootstrap/bootstrap.min599c.js?v4.0.2')}}"></script>
  <script src="{{asset('/assets/vendor/animsition/animsition.min599c.js?v4.0.2')}}"></script>
  <script src="{{asset('/assets/vendor/mousewheel/jquery.mousewheel599c.js?v4.0.2')}}"></script>
  <script src="{{asset('/assets/vendor/asscrollbar/jquery-asScrollbar.min599c.js?v4.0.2')}}"></script>
  <script src="{{asset('/assets/vendor/asscrollable/jquery-asScrollable.min599c.js?v4.0.2')}}"></script>
  <script src="{{asset('/assets/vendor/ashoverscroll/jquery-asHoverScroll.min599c.js?v4.0.2')}}"></script>

  <!-- Plugins -->
  <script src="{{asset('/assets/vendor/switchery/switchery.min599c.js?v4.0.2')}}"></script>
  <script src="{{asset('/assets/vendor/intro-js/intro.min599c.js?v4.0.2')}}"></script>
  <script src="{{asset('/assets/vendor/screenfull/screenfull599c.js?v4.0.2')}}"></script>
  <script src="{{asset('/assets/vendor/slidepanel/jquery-slidePanel.min599c.js?v4.0.2')}}"></script>

  <!-- Plugins For This Page -->
  <script src="{{asset('/assets/vendor/jquery-placeholder/jquery.placeholder599c.js?v4.0.2')}}"></script>
</body>


<!-- Mirrored from getbootstrapadmin.com/remark/base/pages/login-v2.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 13 Nov 2018 04:19:04 GMT -->
</html>