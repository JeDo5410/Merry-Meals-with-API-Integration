@section('title')
    Donation
@endsection
@extends('layouts.app')

@section('content')
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Meals on Wheels - Payment</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        @media (max-width: 991px) {
            .card-registration-2 .bg-indigo {
                border-bottom-left-radius: 15px;
                border-bottom-right-radius: 15px;
            }
        }
        .input-control {
            display: flex;
            flex-direction: column;
        }
        .input-control input {
            border: 2px solid #f0f0f0;
            border-radius: 4px;
            display: block;
            font-size: 12px;
            padding: 10px;
            width: 100%;
        }
        .input-control input:focus {
            outline: 0;
        }
        .input-control.success input {
            border-color: #3CB815;
        }
        .input-control.error input {
            border-color: #F65005;
        }
        .input-control .error {
            color: #F65005;
            font-size: 0.875em;
            height: 13px;
        }
        .progress-indicator {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            width: 100%;
            margin-bottom: 2rem;
            position: relative;
        }

        .progress-step {
            text-align: center;
            position: relative;
            width: 33.33%; 
        }
        .progress-step-number {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #e0e0e0;
            color: #fff;
            font-weight: bold;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 0.5rem;
            position: relative;
            z-index: 2;
        }
        .progress-step.active .progress-step-number {
            background-color: #007bff;
        }
        .progress-step-label {
            font-size: 0.8rem;
            color: #6c757d;
        }
        .progress-step.active .progress-step-label {
            color: #007bff;
            font-weight: bold;
        }
        .progress-bar {
            position: absolute;
            top: 15px;
            left: 16.665%; 
            right: 16.665%; 
            height: 2px;
            background-color: #e0e0e0;
            z-index: 1;
        }
        .progress-bar-fill {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            background-color: #007bff;
            transition: width 0.3s ease;
            width: 50%;
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
                                <div class="col-lg-6">
                                    <div class="p-5">
                                        <h1 class="main-heading text-center">Payment Information</h1>
                                        <p class="text-center fw-light mb-5" style="font-size:14px;">Please enter your payment details to complete your donation.</p>
                                        
                                        <div class="progress-indicator">
                                          <div class="progress-bar">
                                              <div class="progress-bar-fill"></div>
                                          </div>
                                          <div class="progress-step ">
                                              <div class="progress-step-number">1</div>
                                              <div class="progress-step-label">Donation</div>
                                          </div>
                                          <div class="progress-step">
                                              <div class="progress-step-number">2</div>
                                              <div class="progress-step-label">Billing</div>
                                          </div>
                                          <div class="progress-step active">
                                              <div class="progress-step-number">3</div>
                                              <div class="progress-step-label">Payment</div>
                                          </div>
                                      </div>

                                        @if (Session::has('success'))
                                        <div class="alert alert-success text-center">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                            <p>{{ Session::get('success') }}</p>
                                        </div>
                                        @endif

                                        <form role="form" action="{{ route('stripe.post') }}" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                                            @csrf
                                            <div class="mb-4">
                                                <div class="input-control">
                                                    <label class="form-label" for="card_name">Card Holder's Full Name</label>
                                                    <input class="form-control" id="card_name" type="text" required>
                                                </div>
                                            </div>
                                            <div class="mb-4">
                                                <div class="input-control">
                                                    <label class="form-label" for="card_number">Credit Card Number</label>
                                                    <input class="form-control card-number" id="card_number" type="text" required>
                                                </div>
                                            </div>
                                            <div class="mb-4">
                                                <div class="input-control">
                                                    <label class="form-label" for="card_type">Card Type</label>
                                                    <input class="form-control" id="card_type" type="text" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 mb-4">
                                                    <div class="input-control">
                                                        <label class="form-label" for="card_cvc">CVC</label>
                                                        <input class="form-control card-cvc" id="card_cvc" placeholder="ex. 311" type="text" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-4">
                                                    <div class="input-control">
                                                        <label class="form-label" for="card_month">Expiration Month</label>
                                                        <input class="form-control card-expiry-month" id="card_month" placeholder="MM" type="text" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-4">
                                                    <div class="input-control">
                                                        <label class="form-label" for="card_year">Expiration Year</label>
                                                        <input class="form-control card-expiry-year" id="card_year" placeholder="YYYY" type="text" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-lg btn-block">
                                                Pay Now
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-lg-6 bg-indigo text-white">
                                    <img style="height:100%; width: 100%; object-fit: cover; border-top-right-radius: 15px; border-bottom-right-radius: 15px;" src="{{url('/images/donationpage1.png')}}" alt="Seniors in need">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript">
    $(function() {
        var $form = $(".require-validation");
        
        $('form.require-validation').on('submit', function(e) {
            e.preventDefault(); // Prevent form from submitting
            
            var valid = true;
            $form.find('.input-control :input').each(function() {
                if ($(this).val() === '') {
                    valid = false;
                    $(this).parent().addClass('error');
                } else {
                    $(this).parent().removeClass('error');
                }
            });
            
            if (valid) {
                showThankYouAlert();
            } else {
                Swal.fire({
                    title: 'Error!',
                    text: 'Please fill in all required fields.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
        
        function showThankYouAlert() {
            Swal.fire({
                title: 'Thank You!',
                text: 'Your donation is greatly appreciated.',
                icon: 'success',
                confirmButtonText: 'Go to Home',
                confirmButtonColor: '#3CB815'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '/';
                }
            });
        }
    });
    </script>
</body>
@endsection