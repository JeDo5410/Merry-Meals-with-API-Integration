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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
      @media (min-width: 1025px) {
    .h-custom {
        height: 100vh !important;
    }
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
    width: 0%;
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
      height: 13px;
    }

    .required-field::after {
      content: " *";
      color: red;
    }

    .error-message {
      color: red;
      font-size: 0.875em;
      margin-top: 0.25rem;
    }

    .donation-buttons {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 10px;
    margin-bottom: 20px;
}

.donation-amount {
    background-color: #f8f9fa;
    border: 2px solid #dee2e6;
    border-radius: 8px;
    padding: 15px 10px;
    font-size: 1.1rem;
    font-weight: bold;
    color: #495057;
    transition: all 0.3s ease;
    cursor: pointer;
}

.donation-amount:hover {
    background-color: #e9ecef;
    border-color: #ced4da;
}

.donation-amount.active {
    background-color: #007bff;
    border-color: #007bff;
    color: white;
}

.donation-amount.active:hover {
    background-color: #0056b3;
    border-color: #0056b3;
}

.custom-amount {
    grid-column: span 3;
    display: flex;
    align-items: center;
    background-color: #f8f9fa;
    border: 2px solid #dee2e6;
    border-radius: 8px;
    padding: 10px;
    margin-top: 10px;
}

.custom-amount label {
    margin-right: 10px;
    font-weight: bold;
    color: #495057;
}

.custom-amount input {
    flex-grow: 1;
    border: none;
    background-color: transparent;
    font-size: 1.1rem;
    color: #495057;
    outline: none;
}

.custom-amount input:focus {
    background-color: white;
}

.dollar-sign {
    font-weight: bold;
    color: #495057;
    margin-right: 5px;
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
                                        <h1 class="main-heading text-center">Donate Dignity and Care</h1>
                                        <p class="text-center fw-light mb-5" style="font-size:14px;">Your gift will help us support local programs that keep seniors safe and living independently nationwide.</p>
                                        
                                        @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    @if (session('error'))
                                        <div class="alert alert-danger">
                                            {{ session('error') }}
                                        </div>
                                    @endif
                                        
                                    <div class="progress-indicator">
                                      <div class="progress-bar">
                                          <div class="progress-bar-fill"></div>
                                      </div>
                                      <div class="progress-step active">
                                          <div class="progress-step-number">1</div>
                                          <div class="progress-step-label">Donation</div>
                                      </div>
                                      <div class="progress-step">
                                          <div class="progress-step-number">2</div>
                                          <div class="progress-step-label">Billing</div>
                                      </div>
                                      <div class="progress-step">
                                          <div class="progress-step-number">3</div>
                                          <div class="progress-step-label">Payment</div>
                                      </div>
                                  </div>

                                        <form id="donationForm" action="{{ route('saveDonationFee') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="donation-buttons">
                                              <button type="button" class="donation-amount" data-amount="1000">$1,000</button>
                                              <button type="button" class="donation-amount" data-amount="500">$500</button>
                                              <button type="button" class="donation-amount" data-amount="300">$300</button>
                                              <button type="button" class="donation-amount" data-amount="200">$200</button>
                                              <button type="button" class="donation-amount" data-amount="100">$100</button>
                                              <button type="button" class="donation-amount" data-amount="50">$50</button>
                                              <div class="custom-amount">
                                                  <label for="donor_fee">Other Amount:</label>
                                                  <span class="dollar-sign">$</span>
                                                  <input id="donor_fee" name="donor_fee" type="number" placeholder="Enter amount" required min="1" step="0.01" />
                                              </div>
                                          </div>

                                            <div class="input-control mb-3">
                                                <label for="donor_tribute" class="required-field">Tribute Type</label>
                                                <select name="donor_tribute" id="donor_tribute" class="form-control" required>
                                                    <option value="">Select tribute type</option>
                                                    <option value="In Honor Of">In Honor Of</option>
                                                    <option value="In Memory Of">In Memory Of</option>
                                                    <option value="On Behalf Of">On Behalf Of</option>
                                                </select>
                                                <div class="error-message"></div>
                                            </div>

                                            <div class="input-control mb-4">
                                                <label for="donor_honoree_name" class="required-field">Honoree Name</label>
                                                <input name="donor_honoree_name" type="text" id="donor_honoree_name" class="form-control" placeholder="Enter honoree's name" required />
                                                <div class="error-message"></div>
                                            </div>

                                            <button type="submit" class="btn btn-primary btn-lg btn-block">
                                                Continue to Billing
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
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('donationForm');
    const donorFee = document.getElementById('donor_fee');
    const donorTribute = document.getElementById('donor_tribute');
    const donorHonoreeName = document.getElementById('donor_honoree_name');
    const donationButtons = document.querySelectorAll('.donation-amount');

    donationButtons.forEach(button => {
        button.addEventListener('click', function() {
            const amount = this.getAttribute('data-amount');
            donorFee.value = amount;
            donationButtons.forEach(btn => btn.classList.remove('active', 'btn-primary'));
            this.classList.add('active', 'btn-primary');
        });
    });

    donorFee.addEventListener('input', function() {
        donationButtons.forEach(btn => btn.classList.remove('active', 'btn-primary'));
    });

    form.addEventListener('submit', function(e) {
        if (!validateInputs()) {
            e.preventDefault(); // Prevent form submission only if validation fails
        }
    });

    function setError(element, message) {
        const inputControl = element.parentElement;
        const errorDisplay = inputControl.querySelector('.error-message');
        errorDisplay.innerText = message;
        element.classList.add('is-invalid');
        element.classList.remove('is-valid');
    }

    function setSuccess(element) {
        const inputControl = element.parentElement;
        const errorDisplay = inputControl.querySelector('.error-message');
        errorDisplay.innerText = '';
        element.classList.add('is-valid');
        element.classList.remove('is-invalid');
    }

    function validateInputs() {
        let isValid = true;
        const donorFeeValue = donorFee.value.trim();
        const donorTributeValue = donorTribute.value.trim();
        const donorHonoreeNameValue = donorHonoreeName.value.trim();

        if (donorFeeValue === '' || isNaN(donorFeeValue) || Number(donorFeeValue) <= 0) {
            setError(donorFee, 'Please enter a valid donation amount');
            isValid = false;
        } else {
            setSuccess(donorFee);
        }

        if (donorTributeValue === '') {
            setError(donorTribute, 'Please select a tribute type');
            isValid = false;
        } else {
            setSuccess(donorTribute);
        }

        if (donorHonoreeNameValue === '') {
            setError(donorHonoreeName, 'Please enter the honoree name');
            isValid = false;
        } else {
            setSuccess(donorHonoreeName);
        }

        return isValid;
    }

    // Real-time validation
    [donorFee, donorTribute, donorHonoreeName].forEach(input => {
        input.addEventListener('input', validateInputs);
    });

    // Special handling for select element
    donorTribute.addEventListener('change', validateInputs);
});
</script>
</body>
@endsection