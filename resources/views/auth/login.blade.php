<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">

<!-- Mirrored from getbootstrapadmin.com/remark/base/pages/login-v2.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 13 Nov 2018 04:19:03 GMT -->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="bootstrap admin template">
  <meta name="author" content="">

  <title>Login | Simida</title>

  <link rel="apple-touch-icon" href="assets/img/logo/apple-touch-icon.png">
  <link rel="shortcut icon" href="assets/img/logo/favicon.ico">

  <!-- Stylesheets -->
  <link rel="stylesheet" href="assets/css/bootstrap.min599c.css">
  <link rel="stylesheet" href="assets/css/bootstrap-extend.min599c.css">
  <link rel="stylesheet" href="assets/css/site.min599c.css">

   <!-- Plugins -->
  <link rel="stylesheet" href="assets/vendor/animsition/animsition.min599c.css?v4.0.2">
  <link rel="stylesheet" href="assets/vendor/asscrollable/asScrollable.min599c.css?v4.0.2">
  <link rel="stylesheet" href="assets/vendor/switchery/switchery.min599c.css?v4.0.2">
  <link rel="stylesheet" href="assets/vendor/intro-js/introjs.min599c.css?v4.0.2">
  <link rel="stylesheet" href="assets/vendor/slidepanel/slidePanel.min599c.css?v4.0.2">
  <link rel="stylesheet" href="assets/vendor/flag-icon-css/flag-icon.min599c.css?v4.0.2">

  <!-- Fonts -->
  <link rel="stylesheet" href="assets/fonts/web-icons/web-icons.min599c.css">
  <link rel="stylesheet" href="assets/fonts/brand-icons/brand-icons.min599c.css">
  <link rel='stylesheet' href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic">

  <!-- Scripts -->
  <script src="assets/vendor/breakpoints/breakpoints.min599c.js"></script>
  <script>
    Breakpoints();
  </script>
  
  <link rel="stylesheet" href="assets/css/pages/login-v2.min599c.css">
  <!-- Plugins For This Page -->
  <link rel="stylesheet" href="assets/vendor/formvalidation/formValidation.min599c.css?v4.0.2">
  
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
        <!--/.brand-->
        <div class="brand-contex">
            <p class="font-size-20">Sistem Informasi dan Manajemen pendidikan di pesantren atau madrasah dari mulai Ibtidaiyah, Tsanawiyah sampai Ma'had Aly</p>
        </div>
        <!--/.brand-contex-->
        <div class="brand-logo">
            <img class="brand-img2" src="assets/img/logo/Pondok.png" alt="...">
            <p class="brand-text" style="font-size: 14px;font-weight: 400;">Pesantren Miftahul Huda</p>
        </div><!--/.brand-logo-->
    </div>

      <div class="page-login-main animation-slide-right animation-duration-1">
        <div class="brand hidden-md-up"> <!--  -->
          <h3 class="brand-text font-size-40">Simida</h3>
        </div>
        <h3 class="font-size-24">Sign In</h3>
        <p>Silahkan masukan Account Anda untuk melanjutkan.</p>

        

        <form method="post" action="{{ route('login') }}"  id="formLogin">
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
          <button id="" type="submit" class="btn btn-primary btn-block">Login</button>
        </form>

<!--        <p>No account? <a href="register-v2.html">Sign Up</a></p>-->

        <footer class="page-copyright">
          <!-- <p>------------------------</p> -->
          <p>© 2018 Simida | powered by <a href="https://birutekno.com" target="_blank">birutekno.inc</a></p>
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

</body>
<!-- Core  -->
<script src="assets/vendor/babel-external-helpers/babel-external-helpers599c.js?v4.0.2"></script>
<script src="assets/vendor/jquery/jquery.min599c.js?v4.0.2"></script>
<script src="assets/vendor/popper-js/umd/popper.min599c.js?v4.0.2"></script>
<script src="assets/vendor/bootstrap/bootstrap.min599c.js?v4.0.2"></script>
<script src="assets/vendor/animsition/animsition.min599c.js?v4.0.2"></script>
<script src="assets/vendor/mousewheel/jquery.mousewheel599c.js?v4.0.2"></script>
<script src="assets/vendor/asscrollbar/jquery-asScrollbar.min599c.js?v4.0.2"></script>
<script src="assets/vendor/asscrollable/jquery-asScrollable.min599c.js?v4.0.2"></script>
<script src="assets/vendor/ashoverscroll/jquery-asHoverScroll.min599c.js?v4.0.2"></script> 
  <!-- Scripts -->
  <script src="assets/js/component.min599c.js?v4.0.2"></script>
  <script src="assets/js/plugin.min599c.js?v4.0.2"></script>
  <script src="assets/js/base.min599c.js?v4.0.2"></script>
  <script src="assets/js/config.min599c.js?v4.0.2"></script>

  <script src="assets/js/section/menubar.min599c.js?v4.0.2"></script>
  <script src="assets/js/section/gridMenu.min599c.js?v4.0.2"></script>
  <script src="assets/js/section/sidebar.min599c.js?v4.0.2"></script>
  <script src="assets/js/section/pageAside.min599c.js?v4.0.2"></script>
  <script src="assets/js/plugin/menu.min599c.js?v4.0.2"></script>
  <!-- Page -->
  <script src="assets/js/site.min599c.js?v4.0.2"></script>
  <script src="assets/js/code-editor.min599c.js"></script>
  <!-- Plugins For This Page -->
  <script src="assets/vendor/jquery-placeholder/jquery.placeholder599c.js?v4.0.2"></script>
  <script src="assets/vendor/formvalidation/formValidation.min599c.js?v4.0.2"></script>
  <script src="assets/vendor/formvalidation/framework/bootstrap4.min599c.js?v4.0.2"></script>
  <script src="assets/js/validation.min599c.js?v4.0.2"></script>
</html>

