@section('title')
    Update {{ $updateMenu->menu_title }}
@endsection

@extends('Users.Admin.layouts.app')

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
	.update_menu{
		padding: 20px 0;
	}
	label{
		padding-top: 20px;
	}

	.update_btn{
		background-color: #2F4B26;
		color: white;
		margin-top: 15px;
		padding: 10px 5px;
		justify-content: center;
	}

</style>

<body>
	<div class="container animate-box update_menu">
		<h1 style="margin-top: 50px; color:#003366; font-weight: bold; text-transform:capitalize;" class="text-center">Update {{ $updateMenu->menu_title }} </h1>

		<div class="row">
			<form action="{{ route('partner#saveUpdate', $updateMenu->id) }}" method="POST" enctype="multipart/form-data">
				@csrf
				<div class="col-sm-6">
					@if ($updateMenu->menu_image)
						<img src="{{ asset('uploads/meal/'. $updateMenu->menu_image) }}" class="img-fluid" alt="menu image ">
					@endif
				</div>

				<div class="col-sm-6">
					<label for="basic-url">Menu Title</label>
					<input type="text" class="form-control" placeholder="Put your menu title here" name="menu_title" value="{{ old('menu_title', $updateMenu->menu_title) }}" required>

					<label for="basic-url">Menu Description</label>
					<textarea class="form-control" id="" cols="30" rows="7" placeholder="Put your menu description here" name="menu_description" required>{{ old('menu_description', $updateMenu->menu_description) }}</textarea>

					<label for="basic-url">Menu Picture</label>
					<input type="file" class="form-control" name="menu_image" value="{{ $updateMenu->menu_image }}" required>

					<label for="basic-url">Allergens</label>
					<textarea class="form-control" id="" cols="30" rows="5" placeholder="Allergens information" name="menu_allergens" required>{{ old('menu_allergens', $updateMenu->menu_allergens) }}</textarea>

					<label for="menu_nutritions">Nutritions</label>
    				<textarea class="form-control" id="menu_nutritions" name="menu_nutritions" rows="5" placeholder="Enter nutrients in this format: Calories: XXX, Proteins: XXX, ..." required>{{ old('menu_nutritions', $updateMenu->menu_nutritions) }}</textarea>
    				<small id="nutritionsHelp" class="form-text text-muted">Please enter nutrients in the format: Calories: XXX, Proteins: XXX, ...</small><br>

					

					<input type="submit" value="Update Menu" class="btn btn-primary p-3" style="margin: 25px 0;">
				</div>
			</form>
		</div>
	</div>
	
</body>
	<!-- jQuery -->


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
