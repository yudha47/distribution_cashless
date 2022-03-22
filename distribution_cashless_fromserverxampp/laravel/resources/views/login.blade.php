<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>Daily Distribution Case</title>
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="css/simplebar.css">
    <!-- Fonts CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="css/feather.css">
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="css/daterangepicker.css">
    <!-- App CSS -->
    <link rel="stylesheet" href="css/app-light.css" id="lightTheme">
    <link rel="stylesheet" href="css/app-dark.css" id="darkTheme" disabled>
    <style>
      body {
        background:url('./assets/images/dose-media-bU6JyhSI6zo-unsplash.jpg') no-repeat;
        padding-top:80px;
        background-position: center top;
        background-repeat: no-repeat;
        background-size: cover;
      }
    </style>
  </head>
  <body class="light ">
    <div class="wrapper">
      <div class="row align-items-center h-100 mt-3" style="margin: 0">
        <form id="login-space" class="col-lg-4 col-md-6 col-10 mx-auto text-center rounded-lg p-5" style="" action="{{url('/login')}}" method="post">
          @csrf
          <a class="navbar-brand mx-auto mt-2 mb-2 flex-fill text-center" href="/">
            {{-- <svg version="1.1" id="logo" class="navbar-brand-img brand-md" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120" xml:space="preserve">
              <g>
                <polygon class="st0" points="78,105 15,105 24,87 87,87 	" />
                <polygon class="st0" points="96,69 33,69 42,51 105,51 	" />
                <polygon class="st0" points="78,33 15,33 24,15 87,15 	" />
              </g>
            </svg> --}}
            <img src="./assets/images/AAI_Icon.png" alt="" class="img-fluid" style="width: 30%">
          </a>
          <h1 class="h4 mt-4">Sign in</h1>
          <p class="mb-3 h5 font-weight-light">Daily Distribution CJ - Cashless</p>

          @if(session()->has('loginError'))
          <div class="alert alert-danger alert-dismissible">
            {{ session('loginError') }}
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          </div>
          @endif
          
          <div class="form-group">
            <label for="inputEmail" class="sr-only">Username</label>
            <input type="text" id="username" name="username" class="form-control form-control-lg text-center" placeholder="Username" required="" autofocus="">
          </div>
          <div class="form-group">
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="password" name="password" class="form-control form-control-lg text-center" placeholder="Password" required="">
          </div>
          <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
          <p class="mt-5 mb-3 font-weight-light">© 2022 <br> ACROSS ASIA ASSIST</p>
        </form>
      </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/moment.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/simplebar.min.js"></script>
    <script src='js/daterangepicker.js'></script>
    <script src='js/jquery.stickOnScroll.js'></script>
    <script src="js/tinycolor-min.js"></script>
    <script src="js/config.js"></script>
    <script src="js/apps.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag()
      {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());
      gtag('config', 'UA-56159088-1');
    </script>
  </body>
</html>