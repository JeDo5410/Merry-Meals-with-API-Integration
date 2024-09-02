@section('title')
    Menu Create
@endsection

@extends('Users.Partner.layouts.app')

@section('content')	
<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
<link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

<!-- <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'> -->

<!-- Animate.css -->
<link rel="stylesheet" href="{{ asset('css/animate.css') }}">
<!-- Icomoon Icon Fonts-->
<link rel="stylesheet" href="{{ asset('css/icomoon.css') }}">
<!-- Bootstrap  -->
<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
<!-- Superfish -->
<link rel="stylesheet" href="{{ asset('css/superfish.css') }}">

<link rel="stylesheet" href="{{ asset('css/style.css') }}">


<style>
	.create_new{
		padding: 25px 0;
	}
	label{
		padding-top: 20px;
	}

	.update_btn{
		background-color: #2F4B26;
		color: white;
		margin-top: 15px;
		margin-bottom: 20px;
		border: 1px solid none;
		border-radius: 10px;
		padding: 10px 5px;
		justify-content: center;
	}

</style>

<body>
	<div class="container create_new animate-box">
		<h1 style="margin-top: 50px; color:#003366; font-weight: bold; text-transform:capitalize;" class="text-center">Create New Menu </h1>

		<div class="row ">
			<form action="{{ route('partner#saveMenu') }}" method="POST" enctype="multipart/form-data">
				@csrf
				{{-- create image --}}
				<div class="col-sm-6">
					<img src="/images/add_new_menu_img.svg" class="img-fluid " alt="" style="padding-top: 10px;">
				</div>

				{{-- create menu form starts --}}
				<div class="col-sm-6">
					<label for="basic-url">Menu Title</label>
					<input type="text" class="form-control" placeholder="Menu title" name="menu_title" required>

					<label for="basic-url">Menu Description</label>
					<textarea class="form-control" id="" cols="30" rows="7" placeholder="Menu description " name="menu_description" required></textarea>

					<label for="basic-url">Menu Picture</label>
					<input type="file" class="form-control" name="menu_image" required>

					<label for="basic-url">Allergens</label>
					<textarea class="form-control" id="" cols="30" rows="5" placeholder="Allergens information" name="menu_allergens" required></textarea>

					<label for="menu_nutritions">Nutritions</label>
    				<textarea class="form-control" id="menu_nutritions" name="menu_nutritions" rows="5" placeholder="Enter nutrients in this format: Calories: XXX, Proteins: XXX, ..." required></textarea>
    				<small id="nutritionsHelp" class="form-text text-muted">Please enter nutrients in the format: Calories: XXX, Proteins: XXX, ...</small><br>

					<label for="ingredients">Ingredients</label>
					<input type="text" class="form-control" id="ingredients" name="ingredients" placeholder="Enter the ingredients included" required>

					<label for="expiry_date">Expiry Date</label>
					<input type="date" class="form-control" id="expiry_date" name="expiry_date" required>

					<label for="safety_training">Food Safety Training Completed</label>
					<select class="form-control" id="safety_training" name="safety_training" required>
						<option value="yes">Yes</option>
						<option value="no">No</option>
					</select>

					<label for="separate_storage">Separate Storage for Raw and Cooked Food</label>
					<select class="form-control" id="separate_storage" name="separate_storage" required>
						<option value="yes">Yes</option>
						<option value="no">No</option>
					</select>
					
					<input type="hidden" class="form-control" placeholder="Put your partner name here" name="partner" value="{{ $partnerData->id }}" required>

					<input type="submit" value="Update Menu" class="btn btn-primary p-3" style="margin: 25px 0;">
				</div>
				{{-- create menu form ends --}}
			</form>
		</div>
	</div>
</body>


	<script src="{{ asset('js/jquery.min.js') }}" defer></script>
	<!-- jQuery Easing -->
	<script src="{{ asset('js/jquery.easing.1.3.js') }}" defer></script>
	<!-- Bootstrap -->
	<script src="{{ asset('js/bootstrap.min.js') }}" defer></script>
	<!-- Waypoints -->
	<script src="{{ asset('js/jquery.waypoints.min.js') }}" defer></script>
	<script src="{{ asset('js/sticky.js') }}"></script>

	<!-- Stellar -->
	<script src="{{ asset('js/jquery.stellar.min.js') }}" defer></script>
	<!-- Superfish -->
	<script src="{{ asset('js/hoverIntent.js') }}" defer></script>
	<script src="{{ asset('js/superfish.js') }}" defer></script>
	
	<!-- Main JS -->
	<script src="{{ asset('js/main.js') }}" defer></script>

@endsection