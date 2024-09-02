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
            width: 25%;
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
                                        <h1 class="main-heading text-center">Billing Information</h1>
                                        <p class="text-center fw-light mb-5" style="font-size:14px;">Please provide your billing details to complete your donation.</p>
                                        
                                        <div class="progress-indicator">
                                          <div class="progress-bar">
                                              <div class="progress-bar-fill"></div>
                                          </div>
                                          <div class="progress-step">
                                              <div class="progress-step-number">1</div>
                                              <div class="progress-step-label">Donation</div>
                                          </div>
                                          <div class="progress-step active">
                                              <div class="progress-step-number">2</div>
                                              <div class="progress-step-label">Billing</div>
                                          </div>
                                          <div class="progress-step">
                                              <div class="progress-step-number">3</div>
                                              <div class="progress-step-label">Payment</div>
                                          </div>
                                      </div>

                                        <form id="form" action="{{ route('saveBilling')}}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6 mb-4">
                                                    <div class="input-control form-outline">
                                                        <label class="form-label" for="donor_first_name">First Name</label>
                                                        <input name="donor_first_name" type="text" id="donor_first_name" class="form-control form-control-lg" />
                                                        <div class="error"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-4">
                                                    <div class="input-control form-outline">
                                                        <label class="form-label" for="donor_last_name">Last Name</label>
                                                        <input name="donor_last_name" type="text" id="donor_last_name" class="form-control form-control-lg" />
                                                        <div class="error"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-4">
                                                <div class="input-control form-outline">
                                                    <label class="form-label" for="donor_address">Address</label>
                                                    <input name="donor_address" type="text" id="donor_address" class="form-control form-control-lg" />
                                                    <div class="error"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-4">
                                                    <div class="input-control form-outline">
                                                        <label class="form-label" for="donor_city">City</label>
                                                        <input name="donor_city" type="text" id="donor_city" class="form-control form-control-lg" />
                                                        <div class="error"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-4">
                                                    <div class="input-control form-outline">
                                                        <label class="form-label" for="donor_state">State</label>
                                                        <input name="donor_state" type="text" id="donor_state" class="form-control form-control-lg" />
                                                        <div class="error"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-4">
                                                    <div class="input-control form-outline">
                                                        <label class="form-label" for="donor_country">Country</label>
                                                        <input name="donor_country" type="text" id="donor_country" class="form-control form-control-lg" />
                                                        <div class="error"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-4">
                                                    <div class="input-control form-outline">
                                                        <label class="form-label" for="donor_phone">Phone</label>
                                                        <input name="donor_phone" type="tel" id="donor_phone" class="form-control form-control-lg" />
                                                        <div class="error"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-4">
                                                <div class="input-control form-outline">
                                                    <label class="form-label" for="donor_email">Email</label>
                                                    <input name="donor_email" type="email" id="donor_email" class="form-control form-control-lg" />
                                                    <div class="error"></div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-lg btn-block">
                                                Continue to Payment
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
<script>
  const form = document.getElementById('form');
  const donor_first_name = document.getElementById('donor_first_name');
  const donor_last_name = document.getElementById('donor_last_name');
  const donor_address = document.getElementById('donor_address');
  const donor_city = document.getElementById('donor_city');
  const donor_state = document.getElementById('donor_state');
  const donor_country = document.getElementById('donor_country');
  const donor_email = document.getElementById('donor_email');
  const donor_phone = document.getElementById('donor_phone');

  form.addEventListener('submit', (e) => {
    e.preventDefault();

    validateInputs();
  });

  const setError = (element, message) => {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error');

    errorDisplay.innerText = message;
    inputControl.classList.add('error');
    inputControl.classList.remove('success');
  };

  const setSuccess = (element) => {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error');

    errorDisplay.innerText = '';
    inputControl.classList.add('success');
    inputControl.classList.remove('error');
  };

  const isValidEmail = donor_email => {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(donor_email).toLowerCase());
}

  const validateInputs = () => {
    const donor_first_name_value = donor_first_name.value.trim();
    const donor_last_name_value = donor_last_name.value.trim();
    const donor_address_value = donor_address.value.trim();
    const donor_city_value = donor_city.value.trim();
    const donor_state_value = donor_state.value.trim();
    const donor_country_value = donor_country.value.trim();
    const donor_email_value = donor_email.value.trim();
    const donor_phone_value = donor_phone.value.trim();

    if (donor_first_name_value === '') {
      setError(donor_first_name, 'This field is required');
      return false;
    } else {
      setSuccess(donor_first_name);
    }

    if (donor_last_name_value === '') {
      setError(donor_last_name, 'This field is required');
      return false;
    }  else {
      setSuccess(donor_last_name);
    }

    if (donor_address_value === '') {
      setError(donor_address, 'This field is required');
      return false;
    } else {
      setSuccess(donor_address);
    }

    if (donor_city_value === '') {
      setError(donor_city, 'This field is required');
      return false;
    } else {
      setSuccess(donor_city);
    }

    if (donor_state_value === '') {
      setError(donor_state, 'This field is required');
      return false;
    } else {
      setSuccess(donor_state);
    }

    if (donor_country_value === '') {
      setError(donor_country, 'This field is required');
      return false;
    } else {
      setSuccess(donor_country);
    }

    if(donor_email_value === '') {
        setError(donor_email, 'This field is required');
    } else if (!isValidEmail(donor_email_value)) {
        setError(donor_email, 'Provide a valid email address');
        return false;
    } else {
        setSuccess(donor_email);
    }

    if (donor_phone_value === '') {
      setError(donor_phone, 'This field is required');
      return false;
    } else {
      setSuccess(donor_phone);
    }
      form.submit();

  };
</script>
  </body>
@endsection