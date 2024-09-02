@section('title')
    Welcome
@endsection

@extends('Users.Admin.layouts.app')

@section('content')

<style>
    input[type=text] , input[type=number] {
      width: 100%;
      padding: 12px 20px;
      /* margin: 8px 0; */
      display: inline-block;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }

    .btns{
        margin: 20px 0;
    }
</style>

<body>
    <div class="container">
        <h1 class="text-center" style="text-align: center; color:#003366; font-weight: bold; padding: 25px 0;">Profile Settings</h1>

        <div class="row" style="margin: 20px 0;">
            <div class="col-sm-4">
                <img src="/images/profile_pic.svg" alt="profile image" class="img-fluid img-thumbnail">
            </div>
            <div class="col-sm-8" style=" color:#003366; justify-content: center; align-items: center;">
                <h3 style="text-transform: capitalize; color:#003366; font-weight: bold;">{{ $userData->name }}</h3>
                <h4>{{ $userData->email }} <span> </span></h4>
            </div>
        </div>

        <div>
            <h2 style="margin-bottom: 0; color:#003366;">Account</h2><hr>
            <div class="">
                @if (Session::has('dataInform'))
                    <h4 class="alert alert-success animate-box text-center" role="alert">
                        {{ Session::get('dataInform') }}
                    </h4>
                @endif

                <div class="">
                    <form action="{{ route('admin#userUpdated', $userData->id) }}" method="POST">
                        @csrf
                        <div class="row mb-4">
                            <label for="name" class="col-md-2 col-form-label userManagement">Name</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="name"  value="{{ old('name', $userData->name) }}" required>
                            </div>
                        </div>

                        <input name='gender' class="input-md " type="hidden" value="{{ old('gender', $userData->gender) }}"/>

                        <div class="row mb-4">
                            <label for="age" class="col-md-2 col-form-label userManagement">Age</label>
                            <div class="col-md-10">
                                <input type="number" class="form-control" name="age" value="{{ old('age', $userData->age) }}" required>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="email" class="col-md-2 col-form-label userManagement">Email</label>
                            <div class="col-md-10">
                                <input type="email" class="form-control" name="email"  value="{{ old('email', $userData->email) }}" required>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="phone" class="col-md-2 col-form-label userManagement">Contact</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="phone" value="{{ old('phone', $userData->phone) }}" required>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="address" class="col-md-2 col-form-label userManagement">Address</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="address" value="{{ old('address', $userData->address) }}" required>
                            </div>
                        </div>            
                        
                        <div class="text-center btns"> 
                            <button class="btn btn-primary">Update</button> &nbsp;
                            <button class="btn btn-danger"><a href="#" style="font-size: 15px;">Cancel</a></button>
                        </div>
            
                    </form>
            
                    <form action="{{ route('admin#volunteerUpdated', $userData->id) }}" method="POST">
                        @csrf
                        <h3>Specific Requirements</h3>

						<input name="volunteer_vaccination" class="input-md col-md-12" type="hidden" value="{{ old('volunteer_vaccination', $volunteerData->volunteer_vaccination) }}"/>

                        <div class="row mb-4">
                            <label for="volunteer_duration" class="col-md-2 col-form-label userManagement">Volunteer Duration</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="volunteer_duration" value="{{ old('volunteer_duration', $volunteerData->volunteer_duration) }}" required>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="volunteer_available" class="col-md-2 col-form-label userManagement">Availability</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="volunteer_available" value="{{ old('volunteer_available', $volunteerData->volunteer_available) }}" required>
                            </div>
                        </div>   
            
                        <div class="text-center btns"> 
                            <button class="btn btn-primary">Update</button> &nbsp;
                            <button class="btn btn-danger"><a href="#" style="font-size: 15px;">Cancel</a></button>
                        </div>
                    </form>

                </div>
            
            </div>
        </div>
    </div>
</body>
		

@endsection