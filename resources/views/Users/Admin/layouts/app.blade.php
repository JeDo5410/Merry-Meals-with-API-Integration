<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        @yield('title')
    </title>

    <!------------CSS-------------->
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('main/css/style.css')}}"> --}}

    <!-- Bootstrap CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

      <!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="shortcut icon" href="favicon.ico">

	<!-- <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'> -->
	
	<!-- Animate.css -->
	<link rel="stylesheet" type="text/css" href="{{ url('/css/animate.css') }}" >
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" type="text/css" href="{{ url('/css/icomoon.css') }}">
	<!-- Bootstrap  -->
	<link rel="stylesheet" type="text/css" href="{{ url('/css/bootstrap.css') }}">
	<!-- Superfish -->
	<link rel="stylesheet" type="text/css" href="{{ url('/css/superfish.css') }}">

	<link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}">


	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

  </head>
<body style="min-height: 100vh;
display: flex;
flex-direction: column;">
<style>
.nav-header #fh5co-logo img {
        width: 70px; /* Set the desired width */
        height: 70px; /* Maintain aspect ratio */
    }

.sf-menu li a {
  font-size: 16px;
  font-weight: 500;
  color: #3d6359;
  text-transform: uppercase;
  position: relative;
  display: inline-block;
  padding: 10px 20px;
  transition: color 0.3s ease;
  text-decoration: none !important;
}

.sf-menu li a:hover {
  color: #132923 !important; 
}
  .dropdown-menu {
      padding: 10px;
  }

  .dropdown-item {
      font-size: 16px;
      font-weight: normal;
      color: #3d6359; 
      text-transform: uppercase; 
      white-space: nowrap; 
      transition: color 0.3s ease;
      text-decoration: none !important;
  }

  .dropdown-item:hover {
      color: #132923 !important; 
  }
</style>
    <!-- Option 1: Bootstrap Bundle with Popper -->
<header id="fh5co-header-section" class="sticky-banner">
    <div class="container">
        <div class="nav-header">
            <a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle dark"><i></i></a>
            <div id="fh5co-logo"><a href="/" ><img src="{{ url('/images/1.png') }}" alt="company logo"></a></div>
            <!-- START #fh5co-menu-wrap -->
           <!--Start end if -->
       
            <nav id="fh5co-menu-wrap" role="navigation">
                    <ul class="sf-menu" id="fh5co-primary-menu">
                        <li class="active">
                            <a href="{{ route('admin#index') }}">Home</a>
                        </li>
                        <li>
                          <a href="#" class="fh5co-sub-ddown">Manage Users</a>
                          <ul class="fh5co-sub-menu">
                              <li><a href="{{ route('admin#allMembers') }}">Member and Care Giver</a></li>
                              <li><a href="{{ route('admin#allPartners') }}">Partners</a></li>
                              <li><a href="{{ route('admin#allVolunteers') }}">Volunteers</a></li>
                              <li><a href="{{ route('admin#allDonors') }}">Donors</a></li>
                          </ul>
                      </li>

                      <li><a href="{{ route('admin#allMenus') }}">Manage Menus</a></li>
                        <li><a href="{{ route('admin#allDeliveries') }}">Manage Deliveries</a></li>
                        <li><a href="/about">About</a></li>
                        <li><a href="/contact">Contact</a></li>
                        
                        <button type="button" class="btn btn-blue dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" 
                            style="
                                font-size: 16px;
                                font-weight: 500;
                                color: #3d6359 /* White text */
                                background-color: transparent; /* Transparent background */
                                padding: 10px 20px;
                                text-decoration: none !important; /* Remove underline */
                                text-transform: uppercase; 
                                display: inline-block; ">
                            Account
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" style="width: auto;">
                            <li style="padding: 10px 20px; ">
                                <span><strong>{{ Auth()->user()->name }}</strong></span> 
                                <br>{{ Auth()->user()->email }}</br> 
                            </li>
                            <li>
                                <button class="dropdown-item" style="font-size: 25px;">
                                    <a href="{{ route('admin#updateProfile', Auth()->user()->id) }}">
                                        Update Profile
                                    </a>
                                </button>
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button type="submit" class="dropdown-item" style="font-size: 25px;">
                                        <a>Logout</a>
                                    </button>
                                </form>
                            </li>
                        </ul>                  
                      
                      
                  
                    </ul>

                     
                    
                 
                
            </nav>
          
        </div>
    </div>
</header>


<!-- END nav -->

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


</div>
<!-- END fh5co-page -->

</div>
<!-- END fh5co-wrapper -->

<!-- jQuery -->

<script src="js/jquery.min.js"></script>
<!-- jQuery Easing -->
<script src="js/jquery.easing.1.3.js"></script>
<!-- Bootstrap -->
<script src="js/bootstrap.min.js"></script>
<!-- Waypoints -->
<script src="js/jquery.waypoints.min.js"></script>
<script src="js/sticky.js"></script>

<!-- Stellar -->
<script src="js/jquery.stellar.min.js"></script>
<!-- Superfish -->
<script src="js/hoverIntent.js"></script>
<script src="js/superfish.js"></script>

<!-- Main JS -->
<script src="js/main.js"></script>

  <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


</body>
</html>

