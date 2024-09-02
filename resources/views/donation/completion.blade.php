@section('title')
    Donation
@endsection
@extends('layouts.app')

@section('content')
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Meals on Wheels - Donation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <style>
      @media (min-width: 1025px) {
    .h-custom {
        height: 100vh !important;
    }
}
.card-registration .select-input.form-control[readonly]:not([disabled]) {
    font-size: 1rem;
    line-height: 2.15;
    padding-left: 0.75em;
    padding-right: 0.75em;
}
.card-registration .select-arrow {
    top: 13px;
}

@media (min-width: 992px) {
    .card-registration-2 .bg-indigo {
        border-top-right-radius: 15px;
        border-bottom-right-radius: 15px;
    }
}
@media (max-width: 1000px) {
    .card-registration-2 .bg-indigo {
        border-bottom-left-radius: 15px;
        border-bottom-right-radius: 15px;
    }
}

body {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
        font-weight: 400;
        font-style: normal;
        line-height: 1.6;
        font-size: 16px;
        background: #F5F5DC; /* Light Beige background */
        color: #003366 ;
        overflow-x: hidden;
    }

    </style>
  </head>
  <body>
  <section class="h-100 h-custom gradient-custom-2">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12">
        <div class="card card-registration card-registration-2" style="border-radius: 15px; border:none;">
          <div class="card-body p-0">
            <div class="row g-0">
              <div class="col-lg-6" >
                <div class="p-5">
                  <div class="p-5">
                 
                      <form class="form-inline text-center mb-4 mb-2">
                      <div class="form-group" style="padding: 0 45px 0 25px ; color: grey; ">
                          <p style="font-size: 10px;">1 <br> DONATION</p>
                        </div>
                        <div class="form-group" style="padding-right:45px ;color: grey;">
                          <p style="font-size: 10px;">2 <br> BILLING</p>
                        </div>
                        <div class="form-group" style="padding-right:45px ;color: grey;">
                          <p style="font-size: 10px;">3 <br> PAYMENT</p>
                        </div>
                        <div class="form-group" style="padding-right:45px ;">
                          <p style="font-size: 10px;color: black;">4 <br> COMPLETION</p>
                        </div>	
                      </form>
                      <div class="mb-4 pb-2" style="padding-top:50px ;">
                        <div class="form-outline form-white" style="text-align: center; color: #3CB815; ">
                          <i class="bi bi-check-circle-fill" style="font-size: 50px; "></i>
                          <h6>SUCCESS!</h6>
                        </div>
                      </div>
             
                      <div class="mb-4 pb-2">
                        <div class="form-outline form-white " style="padding-top:50px ; padding-bottom:35px ;">
                          <p class="fw-normal" style="margin: 0 0 0 15px; font-size: 12px">Thank you for your gift! 
                            Together, we are helping to provide nutritious
                            meals to seniors around the world!
                            An email acknowledging that you have donated
                            will be sent to the email address you provided </p>
                        </div>
                      </div>
                      <button type="button" class="btn btn-light fw-bold " style="margin: 150px 0 0 170px; background-color: #3CB815; font-size: 10px; width: 80px;height: 30px;; color: #F5F5F5;" 
                    data-mdb-ripple-color="dark"><a href="/" style="font-size: 10px; width: 80px;height: 30px;; color: #F5F5F5;" >DONE</a></button>

                  </div>
                </div>
              </div>
              <div class="col-lg-6 bg-indigo text-white">
              <img style="height:700px; width: auto; border-radius: 7px; " src="{{url('/images/donation.jpg')}}" alt="">              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
  </body>
@endsection
