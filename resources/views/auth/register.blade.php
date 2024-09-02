@extends('layouts.app')

@section('title', 'Register')

@section('content')
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


</style>

<body>
    <div class="container">
        <div class="row" style="display: flex;">
            <div class="col" id="form">
                <div class="blur-container">
                    <x-jet-validation-errors class="mb-4 alert alert-danger" role="alert"/>

                    <h1 class="text-center" style="text-align: center; color:#003366; font-weight: bold; margin:25px 0;">Registration Form</h1>

                    <form method="POST" action="{{ route('register') }}">
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
                            <label for="email" class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" name="email" id="email" required="true">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="password" class="col-sm-4 col-form-label">Password</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" name="password" id="password" required="true">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="password_confirmation" class="col-sm-4 col-form-label">Confirm Password</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required="true">
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
                                <div style="display:flex; align-items: center;">
                                    <input type="text" class="form-control" name="geolocation" id="location" />
                                    <input type="button" value="Get Location" onclick="getlocation()" class="btn btn-primary">
                                    <script>
                                        function getlocation() {
                                            navigator.geolocation.getCurrentPosition(showLoc);
                                        }
                                        function showLoc(pos) {
                                            var lat = pos.coords.latitude;
                                            var log = pos.coords.longitude;
                                            document.getElementById("location").value = lat + "," + log;
                                        }
                                    </script>
                                </div>
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
                                <button type="submit" class="btn btn-primary">Register</button>
                                <button type="reset" class="btn btn-danger ">Clear</button>
                            </div>
                        </div>
                    </form>

                    <br>
                    <p>Already have an account? <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500" style="text-decoration: underline;">Login here.</a></p>
                </div>      
            </div>
        </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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
</script>

@endsection