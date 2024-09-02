@section('title')
    Contact Us
@endsection

@extends('layouts.app')

@section('content')

</head>
  <style>

    input[type=text] , textarea {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }

    input[type=submit] {
      width: 100%;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    ul li{
      padding: 10px 0;
    }

    li a{
      color:  ;
    }

    a:hover{
      text-decoration: underline;
    }

  </style>

</head>

<body class="antialiased">   
      <h1 style="color: #003366; text-align: center; padding: 15px 0; font-weight: bold;">Contact Us</h1>

      {{-- contact us - location map starts --}}
      <div>
        <iframe 
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d255281.19051494342!2d103.67943493762235!3d1.3143378894806832!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31da11238a8b9375%3A0x887869cf52abf5c4!2sSingapore!5e0!3m2!1sen!2smm!4v1720947306301!5m2!1sen!2smm" 
          width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" 
          referrerpolicy="no-referrer-when-downgrade">
        </iframe>
      </div>
      {{-- contact us - location map ends --}}

      {{-- contact us - contact info & form starts --}}
      <div class="container" style="padding: 30px 0;">
        <div class="row">

          {{-- contact info starts --}}
          <div class="col-sm-4">
            <h3 style="text-align: center; font-weight: bold; color: #003366;">Contact Information</h3>
            <ul>
              <li>Location - <a href="https://maps.app.goo.gl/zwP8rVQdRcbfY5iT9" target="_blank">Singapore</a></li>
              <li>Email - <a href="http://gmail.com" target="_blank">MealsOnWheels@gmail.com</a></li>
              <li>Phone Number - <a href="">+9986554677</a> </li>
              <li>Website - <a href="#" target="_blank">MealsOnWheels.com</a></li>
            </ul>
          </div>
          {{-- contact info ends --}}

          {{-- contact form starts --}}
          <div class="col-sm-8">
            <h3 style="text-align: center; font-weight: bold; color: #003366;">Contact Form</h3>
            <form action="">
              <label for="username">Name</label>
              <input type="text" id="name" name="username" placeholder="Type your name"><br>

              <label for="">Email</label>
              <input type="text" id="email" name="email" placeholder="Type your email"><br>

              <label for="">Subject</label>
              <input type="text" id="subject" name="subject" placeholder="Type your subject"><br>

              <label for="">Message</label>
              <textarea placeholder="Your message..."></textarea>

              <input type="submit" value="Submit" class="btn btn-primary">
            </form>
          </div>
          {{-- contact form ends --}}
        </div>
      </div>
      {{-- contact us - contact info & form ends --}}
</body>
@endsection