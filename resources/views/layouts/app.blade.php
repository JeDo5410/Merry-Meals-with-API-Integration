<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>

  <!-- Bootstrap CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <!-- Additional CSS -->
  <link rel="stylesheet" type="text/css" href="{{ url('/css/animate.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('/css/icomoon.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('/css/bootstrap.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('/css/superfish.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}">

  <!-- Modernizr JS -->
  <script src="js/modernizr-2.6.2.min.js"></script>

  <!-- Custom CSS -->
  <style>
  /* Navigation link styles */
  .nav-header #fh5co-logo img {
        width: 70px; /* Set the desired width */
        height: 70px; /* Maintain aspect ratio */
    }

  .sf-menu li a {
    font-size: 16px;
    font-weight: bold;
    text-transform: uppercase; /* Convert text to uppercase */
    position: relative;
    display: inline-block;
    padding: 10px 20px;
    transition: color 0.3s ease;
    text-decoration: none !important; /* Remove underline */
  }

  .sf-menu li a:hover {
    color: #132923 !important; /* Darker green on hover */
  }

  /* Register button styles */
  .register-button {
    margin-right: 15px;
    font-weight: bold;
    border: none;
    transition: background-color 0.3s ease;
    text-decoration: none !important; /* Remove underline */
    text-transform: uppercase; /* Convert text to uppercase */
    display: inline-block;
  }

  .register-button:hover {
    background-color: #2F4B26 ; /* Darker green on hover */
    text-decoration: none !important; /* Ensure no underline on hover */
  }
</style>


</head>
<body style="min-height: 100vh; display: flex; flex-direction: column;">
  <!-- Option 1: Bootstrap Bundle with Popper -->
  <header id="fh5co-header-section" class="sticky-banner">
    <div class="container">
      <div class="nav-header">
        <a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle dark"><i></i></a>
        <div id="fh5co-logo">
          <a href="/">
            <img src="{{ url('/images/1.png') }}" alt="company logo">
          </a>
        </div>
        <!-- START #fh5co-menu-wrap -->
        @if (Route::has('login'))
          <nav id="fh5co-menu-wrap" role="navigation">
            @auth
              <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
            @else
              <ul class="sf-menu" id="fh5co-primary-menu">
                <li class="active"><a href="/">Home</a></li>
                <li><a href="/donationFee">Donate</a></li>
                <li>
                  <a href="{{ route('choose.interest') }}" class="fh5co-sub-ddown">Get Involved</a>
                  <ul class="fh5co-sub-menu">
                    <li><a href="{{ route('choose.interest') }}">Be a member</a></li>
                    <li><a href="{{ route('choose.interest') }}">Volunteer</a></li>
                    <li><a href="{{ route('choose.interest') }}">Partner</a></li>
                  </ul>
                </li>
                <li><a href="/about">About</a></li>
                <li><a href="/contact">Contact</a></li>
                <li>
                  <a href="{{ route('login') }}" class="btn btn-primary" style="margin-right: 15px;">Login</a>
                </li>


                 @if (Route::has('choose.interest'))
                    <li>
                        <a href="{{ route('choose.interest') }}" class="btn btn-primary  ">Register</a>
                    </li>
                @endif

              </ul>
            @endauth
          </nav>
        @endif
      </div>
    </div>
  </header>

  <!-- Content -->
  @yield('content')
  <!-- End Content -->

  <footer class="bg-light py-5 mt-auto">
    <div class="container">
        <!-- Copyright and Legal Links -->
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <p class="text-muted mb-0">&copy; 2024 MerryMeal ~ Meals on Wheels Charity. All Rights Reserved.</p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item"><a href="/terms" class="text-muted">Privacy Policy</a></li>
                    <li class="list-inline-item"><a href="/terms" class="text-muted">Terms of Use</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
  <!-- jQuery -->
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <!-- jQuery Easing -->
  <script src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
  <!-- Bootstrap -->
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <!-- Waypoints -->
  <script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
  <script src="{{ asset('js/sticky.js') }}"></script>
  <!-- Stellar -->
  <script src="{{ asset('js/jquery.stellar.min.js') }}"></script>
  <!-- Superfish -->
  <script src="{{ asset('js/hoverIntent.js') }}"></script>
  <script src="{{ asset('js/superfish.js') }}"></script>
  <!-- Main JS -->
  <script src="{{ asset('js/main.js') }}"></script>
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
