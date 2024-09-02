@section('title')
	{{ $viewMenu->menu_title }} Details
@endsection

@extends('Users.Member.layouts.app')

@section('content')
<style>
	.menu_details{
		padding: 20px 0;
	}
	.meal_img{
		width: 100%;
		height: 400px;
	}

	.menu_loc{
        font-weight: bold;
        color: black;
    }

	.order_btn{
		width: 150px;
		margin: 20px 0;
		padding: 10px 5px;
		border: 1px solid black;
		background-color: #2F4B26;
		color: white;
		font-weight: bold;
	}
</style>
<body>
    <?php 
        $partner_id = DB::table('menus')->where('id',$viewMenu->id)->value('partner_id');
						//echo $partner_id;
						$partner_user_id = DB::table('partners')->where('id',$partner_id)->value('user_id');
						//echo $partner_user_id;
						$partner_geolocation = DB::table('users')->where('id',$partner_user_id)->value('geolocation');
						//echo $partner_geolocation;
						$user_geolocation = DB::table('users')->where('id',Auth()->user()->id)->value('geolocation');
						//echo $user_geolocation;

						$user_arr = preg_split ("/\,/", $user_geolocation); 
						$partner_arr = preg_split ("/\,/", $partner_geolocation);

						$Lat1 = $user_arr[0];
						$Long1 =  $user_arr[1];
						$Lat2 = $partner_arr[0] ;
						$Long2 = $partner_arr[1];
						$DistanceKM = 0;
						$DistanceMeter = 0;

						if (isset($_POST['Lat1'])) {

                            $Lat1 = $_POST['Lat1'];
                            $Long1 = $_POST['Long1'];
                            $Lat2 = $_POST['Lat2'];
                            $Long2 = $_POST['Long2'];
						}

						$R = 6371;

						$Lat = $Lat2 - $Lat1;
						$Long = $Long2 - $Long1;

						$dLat1 = deg2rad($Lat);
						$dlong1 = deg2rad($Long);

						$a =
							sin($dLat1 / 2) * sin($dLat1 / 2) +
							cos(deg2rad($Lat1)) * cos(deg2rad($Lat2)) *
							sin($dlong1 / 2) * sin($dlong1 / 2);

						$c = 2 * atan2(sqrt($a), sqrt(1 - $a));

						$DistanceKM = $R * $c;

						$DistanceMeter = $DistanceKM * 1000;

						$DistanceKM = round($DistanceKM, 3);

						if ($DistanceKM > 10 ) {
							$message ="Out Of Delivery Range";
						}else{
							$message ="Within Delivery Range";
						}
							
						$weekday=date("w");
						//  echo $weekday."<br>";
						if ($weekday == 0 ||$weekday == 6 ) {
							if ($DistanceKM > 10) {
								$meal_type = "Frozen";
								$message = "This Meal is available today";
							}else{
								// sat or sun and distance less than 10 km
								$meal_type = "Hot";
								$message = "This Meal available only from Monday through Friday";
							}
						}else{
							if ($DistanceKM > 10) {
								$meal_type = "Frozen";
								$message = "Support over weekend only";
							}else{
								$meal_type = "Hot";
								$message = "This Meal is available today";
							}
						}			
	?>

	{{-- menu details page starts --}}
	<div class="container menu_details">

		{{-- menu img and description starts --}}
		<div class="row animate-box">

			<div class="col-sm-6">
				@if ($viewMenu->menu_image)
                    <img src="{{ asset('uploads/meal/'. $viewMenu->menu_image) }}" class="img-fluid meal_img" alt="category image">
                @endif
			</div>

			<div class="col-sm-6">
				<h1 style="margin-top: 50px; color:#003366; font-weight: bold; text-transform:capitalize;">{{ $viewMenu->menu_title }} - Menu Details </h1>
				
				<div class="d-flex justify-content-between align-items-center ">
					<p class="text-left menu_loc">Time Availability - <?php echo $message; ?></p>
					<p class="text-right menu_loc">Meal Type - <?php echo $meal_type; ?></p>
				</div>

				<p>{{ $viewMenu->menu_description }}</p>

			</div>

			@if( $memberData->member_meal_duration != 0 )
                @if($message == "This Meal is available today")
                    <div class="animate-box d-flex justify-content-center align-items-center ">
                        <a href="{{ route('member#orderConfirmation', [ 'partner_id' => $viewMenu -> partner_id, 'menu_id' => $viewMenu-> id, 'user_id' => Auth()->user()->id]) }}"> <input type="submit" value="Order Now" class="order_btn"></a>
                    </div>
                @endif
            @endif
		</div>
		{{-- menu img and description ends --}}

		<hr>
		{{-- allergens & info starts --}}
		<h3 style="margin-top: 50px; color:#003366; font-weight: bold; text-transform:capitalize;">Allergens + nutrition information </h3>
		<div class="row">
			{{-- allergens --}}
			<div class="col-sm-4">
				<h4 class="text-danger" style="font-weight: bold;">Allergens</h4>
				<p class="all_text">{{ $viewMenu->menu_allergens }}</p>
			</div>

			{{-- infomation --}}
			<div class="col-sm-8">
				<h4 class="text-danger" style="font-weight: bold;">Nutritional Information</h4>
				<p class="all_text">The detail nutritional information for this meal are as follows: <br>
					{{ $viewMenu->menu_nutritions }}
				</p>
				
				<a href="{{ route('partner#foodSafety') }}" style="text-decoration: underline; color:#003366;">Click here to view food safety standards -> </a>
			</div>
		</div>
		{{-- allergens & info ends --}}

		{{-- food safety starts --}}
		<h3 style="margin-top: 50px; color:#003366; font-weight: bold; text-transform:capitalize;">Food Safety Information </h3>
		<div class="row">
			{{-- allergens --}}
			<div class="col-sm-4">
				<h4 class="text-danger" style="font-weight: bold;">Ingredients</h4>
				<p class="all_text">{{ $viewMenu->ingredients }}</p>
			</div>

			{{-- infomation --}}
			<div class="col-sm-8">
				<h4 class="text-danger" style="font-weight: bold;">Additional Information</h4>
				<p class="all_text">The additional food safety considerations are as follows: <br>
					<span>Expiry Date - {{ $viewMenu->expiry_date }}</span><br>
					<span>Food Safety Training Completed Status - {{ $viewMenu->safety_training }}</span><br>
					<span>Separate Storage for Raw and Cooked Food - {{ $viewMenu->separate_storage }}</span><br>
				</p>
				
				<a href="{{ route('partner#foodSafety') }}" style="text-decoration: underline; color:#003366;">Click here to view food safety standards -> </a>
			</div>
		</div>
		{{-- food safety ends --}}
	</div>
	
	{{-- menu details page ends --}}


</body>
    

		
			
		</div>
		<!-- fh5co-blog-section -->

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