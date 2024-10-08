@extends('layouts.app')

@section('title', 'Register')

@section('content')
<script src="https://accounts.google.com/gsi/client" async defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.css" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<style type="text/css">
  .card {
      cursor: pointer;
      transition: transform 0.2s ease-in-out;
  }

  .card:hover {
      transform: scale(1.05);
  }

  .box {
      display: none;
      margin-top: 20px;
  }

  .card-header {
      background-color: #007bff;
      color: white;
      text-align: center;
  }

  .card-body {
      padding: 20px;
  }

  .form-group label {
      font-weight: bold;
  }
  .blur-container {
    background: rgba(255, 255, 255, 0.3);
    backdrop-filter: blur(40px);
    padding: 20px 60px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin: 40px 50px;
}
.center-text {
  text-align: center;
  display: flex;
  justify-content: center;
  align-items: center;
}

#map { height: 300px; width: 100%; }

.modal.show {
    display: block !important;
    opacity: 1 !important;
}
.modal-dialog {
    transform: none !important;
    transition: none !important;
}
.modal-backdrop.show {
    opacity: 0.5 !important;
}
.error-message {
        font-size: 0.875em;
        margin-top: 0.25rem;
    }
    .is-invalid {
        border-color: #dc3545;
    }

</style>

<body>
    <div class="container">
        <div class="row" style="display: flex;">
            <div class="col" id="form">
                <div class="blur-container">
                    <x-jet-validation-errors class="mb-4 alert alert-danger" role="alert"/>

                    <h1 class="text-center" style="text-align: center; color:#003366; font-weight: bold; margin:25px 0;">Registration Form</h1>

                    <form id="registrationForm" method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Hidden field to determine selected interest -->
                        <input type="hidden" name="role" id="role" value="{{ $interest }}">

                        <!-- Common fields for all interests -->
                        <div class="row mb-4">
                            <label for="name" class="col-md-4 col-form-label">Name</label>
                            <div class="col-md-8">
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                        </div>

                        <fieldset class="row mb-3">
                            <label class="col-form-label col-sm-4 pt-0">Gender</label>
                            <div class="col-sm-8">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="inline_Radio1" value="0" required="">
                                    <label class="form-check-label" for="inlineRadio1">Male</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="inline_Radio2" value="1" required="">
                                    <label class="form-check-label" for="inlineRadio2">Female</label>
                                </div>
                            </div>
                        </fieldset>

                        <div class="row mb-4">
                            <label for="age" class="col-sm-4 col-form-label">Age</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="age" id="age" required="true">
                            </div>
                        </div>


                        <div class="row mb-4">
                            <label for="phone" class="col-sm-4 col-form-label">Phone number</label>
                            <div class="col-sm-8">
                                <input type="tel" class="form-control" maxlength="11" required="true" name="phone" id="phone">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="address" class="col-sm-4 col-form-label">Address</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" required="true" name="address" id="address"></textarea>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="location" class="col-sm-4 col-form-label">Geo Location</label>
                            <div class="col-sm-8">
                                <div id="map"></div>
                                <input type="text" class="form-control mt-2" name="geolocation" id="location" readonly />
                            </div>
                        </div>


                        <!-- Member-specific fields -->
                        <div class="member box">
                            <div class="row mb-4">
                                <label for="service_eligibility" class="col-md-4 col-form-label">Service Eligibility</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="service_eligibility" required>
                                        <option value="Age">Age</option>
                                        <option value="Disease">Disease</option>
                                        <option value="Disability">Disability</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label for="dietary" class="col-md-4 col-form-label">Dietary Requirements</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="dietary" id="dietary">
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label for="member_meal_duration" class="col-md-4 col-form-label">Meal Plan Duration (days)</label>
                                <div class="col-md-8">
                                    <input type="number" class="form-control" name="member_meal_duration" value="30" readonly>
                                </div>
                            </div>
                        </div>

                        <!-- Partner-specific fields -->
                        <div class="partner box">
                            <div class="row mb-4">
                                <label for="partnership_restaurant" class="col-sm-4 col-form-label">Restaurant Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="partnership_restaurant">
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label for="partnership_duration" class="col-sm-4 col-form-label">Partnership Duration</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="partnership_duration">
                                </div>
                            </div>
                        </div>

                        <!-- Volunteer-specific fields -->
                        <div class="volunteer box">
                            <fieldset class="row mb-3">
                                <label class="col-form-label col-sm-4 pt-0">Volunteer Vaccination Status</label>
                                <div class="col-sm-8">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="volunteer_vaccination" id="inlineRadio1" value="0">
                                        <label class="form-check-label" for="inlineRadio1">Yes</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="volunteer_vaccination" id="inlineRadio2" value="1">
                                        <label class="form-check-label" for="inlineRadio2">No</label>
                                    </div>
                                </div>
                            </fieldset>

                            <div class="row mb-4">
                                <label for="volunteer_duration" class="col-sm-4 col-form-label">Volunteer Duration</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="volunteer_duration">
                                </div>
                            </div>

                            <fieldset class="row mb-3">
                                <label class="col-form-label col-sm-4 pt-0">Available Day</label>
                                <div class="col-sm-8">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="volunteer_available[]" value="Monday" type="checkbox">
                                        <label class="form-check-label" for="inlineCheckbox1">Monday</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="volunteer_available[]" value="Tuesday" type="checkbox">
                                        <label class="form-check-label" for="inlineCheckbox2">Tuesday</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="volunteer_available[]" value="Wednesday" type="checkbox">
                                        <label class="form-check-label" for="inlineCheckbox3">Wednesday</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="volunteer_available[]" value="Thursday" type="checkbox">
                                        <label class="form-check-label" for="inlineCheckbox4">Thursday</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="volunteer_available[]" value="Friday" type="checkbox">
                                        <label class="form-check-label" for="inlineCheckbox5">Friday</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="volunteer_available[]" value="Saturday" type="checkbox">
                                        <label class="form-check-label" for="inlineCheckbox6">Saturday</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="volunteer_available[]" value="Sunday" type="checkbox">
                                        <label class="form-check-label" for="inlineCheckbox7">Sunday</label>
                                    </div>
                                </div>
                            </fieldset>
                        </div>

                        <!-- Submit and Reset buttons -->
                        <div class="row mb-4">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">Continue to Sign Up</button>
                                <button type="reset" class="btn btn-danger ">Clear</button>
                            </div>
                        </div>
                    </form>
                    <form id="googleSignupForm" action="{{ route('auth.google') }}" method="POST" style="display: none;">
                        @csrf
                        <!-- We'll populate this form with JavaScript -->
                    </form>
                    <br>
                    <p>Already have an account? <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500" style="text-decoration: underline;">Login here.</a></p>
                </div>      
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="signupModalLabel">Choose Signup Method</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <button id="emailSignup" class="btn btn-primary btn-block">Sign up with Email</button>
                    <button id="googleSignup" class="btn btn-danger btn-block">Sign up with Google</button>

                    <!-- Email signup form (initially hidden) -->
                    <form id="emailSignupForm" style="display: none;">
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" required>
                        </div>
                        <div class="form-group">
                            <label for="confirmPassword">Confirm Password</label>
                            <input type="password" class="form-control" id="confirmPassword" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Sign Up</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        var role = $("#role").val();
        if (role) {
            $(".box").hide();
            $("." + role).show();
        }

        $("select[name='role']").change(function() {
            var optionValue = $(this).val();
            $("#role").val(optionValue);

            // Hide all boxes and show the selected one
            $(".box").hide();
            $("." + optionValue).show();
        }).change();
    });
    
     // Initialize the map
     var map = L.map('map').setView([0, 0], 2);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        var marker;

        // Function to update marker and input field
        function updateLocation(lat, lng) {
            if (marker) {
                marker.setLatLng([lat, lng]);
            } else {
                marker = L.marker([lat, lng], {draggable: true}).addTo(map);
                marker.on('dragend', function(event) {
                    var position = event.target.getLatLng();
                    updateLocation(position.lat, position.lng);
                });
            }
            document.getElementById('location').value = lat.toFixed(6) + "," + lng.toFixed(6);
        }

        // Add click event to map
        map.on('click', function(e) {
            updateLocation(e.latlng.lat, e.latlng.lng);
        });

        // Try to get user's current location
        if ("geolocation" in navigator) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var lat = position.coords.latitude;
                var lng = position.coords.longitude;
                map.setView([lat, lng], 13);
                updateLocation(lat, lng);
            }, function(error) {
                console.log("Error: ", error);
            });
        }

        document.addEventListener('DOMContentLoaded', (event) => {
            const mainForm = document.getElementById('registrationForm');
            const modal = document.getElementById('signupModal');
            const emailSignupBtn = document.getElementById('emailSignup');
            const googleSignupBtn = document.getElementById('googleSignup');
            const googleSignupForm = document.getElementById('googleSignupForm');
            const emailSignupForm = document.getElementById('emailSignupForm');
            

            // Show modal when main form is submitted
            mainForm.addEventListener('submit', function(e) {
                e.preventDefault();
                if (validateForm(mainForm)) {
                    $(modal).modal('show');
                }
            });

            googleSignupBtn.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Validate the main form first
                if (validateForm(mainForm)) {
                    // Clone all fields from the main form to the Google form
                    const formData = new FormData(mainForm);
                    for (let [name, value] of formData.entries()) {
                        let input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = name;
                        input.value = value;
                        googleSignupForm.appendChild(input);
                    }

                    // Add CSRF token
                    let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    let csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = csrfToken;
                    googleSignupForm.appendChild(csrfInput);

                    
                    // Submit the Google form
                    googleSignupForm.submit();
                }
            });

            // Show email signup form when email button is clicked
            emailSignupBtn.addEventListener('click', function() {
                emailSignupBtn.style.display = 'none';
                googleSignupBtn.style.display = 'none';
                emailSignupForm.style.display = 'block';
            });

            // Handle email signup form submission
            emailSignupForm.addEventListener('submit', function(e) {
                e.preventDefault();
                if (validateEmailSignup()) {
                    // Add email and password to the main form
                    const emailInput = document.createElement('input');
                    emailInput.type = 'hidden';
                    emailInput.name = 'email';
                    emailInput.value = document.getElementById('email').value;
                    mainForm.appendChild(emailInput);

                    const passwordInput = document.createElement('input');
                    passwordInput.type = 'hidden';
                    passwordInput.name = 'password';
                    passwordInput.value = document.getElementById('password').value;
                    mainForm.appendChild(passwordInput);

                    // Submit the main form
                    mainForm.submit();
                }
            });

            // Validate main form
            function validateForm(form) {
                const requiredFields = form.querySelectorAll('[required]');
                for (let field of requiredFields) {
                    if (!field.value.trim()) {
                        alert(`Please fill out the ${field.name} field.`);
                        field.focus();
                        return false;
                    }
                    // Validate name field
                const nameField = form.querySelector('#name');
                if (nameField.value.length < 2 || nameField.value.length > 50) {
                    showError(nameField, 'Name should be between 2 and 50 characters.');
                    nameField.focus();
                    return false;
                }

                const ageField = form.querySelector('#age');
                const age = parseInt(ageField.value);
                if (isNaN(age) || age < 18 || age > 120) {
                    showError(ageField, 'Age should be between 18 and 120.');
                    ageField.focus();
                    return false;
                }

                }
                return true;
            }

             // Function to show error messages
             function showError(field, message) {
                // Remove any existing error message
                const existingError = field.parentElement.querySelector('.error-message');
                if (existingError) {
                    existingError.remove();
                }

                // Create and append error message
                const errorDiv = document.createElement('div');
                errorDiv.className = 'error-message text-danger';
                errorDiv.textContent = message;
                field.parentElement.appendChild(errorDiv);

                // Highlight the field
                field.classList.add('is-invalid');
            }

            // Function to clear error messages
            function clearError(field) {
                const errorDiv = field.parentElement.querySelector('.error-message');
                if (errorDiv) {
                    errorDiv.remove();
                }
                field.classList.remove('is-invalid');
            }

            // Add event listeners to clear errors when user starts typing
            const allFields = mainForm.querySelectorAll('input, select, textarea');
            allFields.forEach(field => {
                field.addEventListener('input', () => clearError(field));
            });

            // Validate email signup
            function validateEmailSignup() {
                const email = document.getElementById('email').value;
                const password = document.getElementById('password').value;
                const confirmPassword = document.getElementById('confirmPassword').value;

                if (password !== confirmPassword) {
                    alert('Passwords do not match');
                    return false;
                }

                // Add more validation as needed

                return true;
            }
        });
    
</script>

@endsection