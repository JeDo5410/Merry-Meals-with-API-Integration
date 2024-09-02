@section('title')
    About Us
@endsection

@extends('layouts.app')

@section('content')
</head>
  <style>
    .what-we-do{
      padding: 0px 0;
    }

    .about{
      padding: 10px 0;
    }

    .about-title{
      position: relative;
    }

    .about-title::after{
      content: "";
      width: 25%;
      height: 2px;
      display: flex;
      position: absolute;
      background-color: red;
      bottom: -9px;
    }

    .mission{
      padding-bottom: 20px;
    }

    .icon-star{
      color:goldenrod;
      padding: 5px;
      font-size: 20px;
    }

    .icon-user3{
      font-size: 100px;
      padding: 10px 0;
    }
  </style>
</head>

<body class="antialiased">

  {{-- about us - what we do starts --}}
  <div class="container-fluid what-we-do">
    <div class="row">
      <div class="col-sm-6" style="padding: 25px 30px;">
          <h1 style="font-weight: bold"><span style="color: #003366; ">What</span> We Do</h1>
          <p style="font-size: 20px;">
            <span style="color: #003366; ">Meals on Wheels</span> is dedicated to delivering hot, nutritious meals to qualified adults who are unable to cook for themselves
            due to age, disease, or disability. Our service goes beyond meal delivery, offering tailored meal preparation that considers
            individual dietary needs and preferences. We ensure timely and efficient meal delivery with the help of our committed volunteers
            and reliable partners, providing a vital lifeline to those in need within our community.
          </p>
      </div>
      <div class="col-sm-6">
        <div class="about-img img-fluid">
          <img src="https://plus.unsplash.com/premium_photo-1683134055585-3d84cb07b60e?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mjl8fHZvbHVudGVlciUyMGRvbmF0aW9uJTIwZ3JvdXB8ZW58MHx8MHx8fDA%3D" alt="" width="100%" class="img-fluid">
        </div>
      </div>
    </div>
  </div>
  {{-- about us - what we do ends --}}

  {{-- about us - about starts --}}
  <div class="container about animate-box" data-animate-effect="fadeIn">
    <h1 class="about-title">About Meals on Wheels</h1>
    <p>
      Welcome to Meals on Wheels, a charitable organization dedicated to providing hot,
      nutritious noon meals to qualified adults living at home.
      Our mission is to ensure that individuals who are unable to cook for themselves
      or maintain their nutritional status due to age, disease, or disability receive the meals
      they need to stay healthy and happy.
    </p>
    <p>
      Meals on Wheels was founded on the belief that everyone deserves access to wholesome and nutritious food,
      regardless of their circumstances. We saw a gap in the community where many adults,
      particularly the elderly and those with disabilities, struggled to prepare meals for themselves.
      With the help of dedicated volunteers, generous donors, and committed partners,
      Meals of Wheels was established to fill this need.
    </p>

    <div class="row">
      <div class="col-sm-6">
        <div class="col-sm-2">
          <i class="icon-spoon-knife" style="font-size: 50px; text-align: center; align-items: center;"></i>
        </div>
        <div class="col-sm-10">
          <p>
            Our team of dedicated chefs and nutritionists prepare healthy and balanced meals daily, ensuring all dietary requirements are met.
          </p>
        </div>
      </div>

      <div class="col-sm-6">
        <div class="col-sm-2">
          <i class="icon-clipboard" style="font-size: 50px; text-align: center; align-items: center;"></i>
        </div>
        <div class="col-sm-10">
          <p>
            Meals are tailored to the specific needs of each member, taking into account allergies, medical conditions, and personal preferences.
          </p>
        </div>
      </div>
      
    </div>

  </div>
  
  {{-- about us - about ends --}}

  {{-- about us - mission&vision starts --}}
  <div class="container mission animate-box" data-animate-effect="fadeIn">
    <h1 style="text-align: center; font-weight: bold; padding: 30px 0;">Meals on Wheels Mission & Vision</h1>
    <div class="row" style="text-align: center;">
      <div class="col-sm-4">
        <h3>Our mission</h3>
        <p>Our mission is to deliver nutritious meals and compassionate support to those in need.</p>
      </div>
      <div class="col-sm-4">
        <h3>Our Vision</h3>
        <p>Our vision is to provide a community where everyone has access to healthy meals and support.</p>
      </div>
      <div class="col-sm-4">
        <h3>Our goals</h3>
        <p>Our goals are to ensure that every individual in need receives a nutritious meal daily
           and to build a strong, dedicated network of volunteers.</p>
      </div>
    </div>
  </div>
  {{-- about us - mission&vision ends --}}

  {{-- about us - feedback starts --}}
  <div class="container animate-box" data-animate-effect="fadeIn">
    <div class="card mb-3" >
      <div class="row g-0">
        <div class="col-md-4 align-self-center align-items-center" style="text-align: center">
          <i class="icon-user3"></i>
          <h4>James Jordan</h4>
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h5 class="card-title"><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i></h5>
            <p class="card-text">
              "I've been using the Meals on Wheels service for my elderly parents, and it has been a lifesaver.
               The meals are nutritious and delicious, and the delivery is always timely.
               The user-friendly interface of the application makes it easy to manage their meal preferences
               and delivery schedule. The support from the volunteers is outstanding, and the whole process
               has brought peace of mind to our family. Thank you, Meals on Wheels, for your dedication and excellent service!"</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- about us - feedback ends --}}

</body>

@endsection