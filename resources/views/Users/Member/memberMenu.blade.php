@section('title')
    All Menu
@endsection

@extends('Users.Member.layouts.app')
@php
// Retrieve partners from the users table joined with the partners table
$partners = DB::table('users')
    ->join('partners', 'users.id', '=', 'partners.user_id')
    ->where('users.role', 'partner')
    ->select('users.id', 'users.name', 'users.geolocation', 'partners.partnership_restaurant')
    ->get();

$partnerData = [];
foreach ($partners as $partner) {
    if ($partner->geolocation) {
        $partnerData[] = [
            'id' => $partner->id,
            'name' => $partner->name,
            'geolocation' => $partner->geolocation,
            'restaurant' => $partner->partnership_restaurant
        ];
    }
}
@endphp

@section('content')		
<style>
	p{
		padding: 0;
		margin: 0;
	}

    .menu_card{
        margin-bottom: 20px;
    }

    .card{
        cursor: pointer;
    }

	.card-title{
		font-size: 20px;
		text-transform: uppercase;
		font-weight: bold;
		padding: 8px 0;
	}

	.card-text{
		padding-top: 5px;
        padding-bottom: 15px;
        font-size: 17px;
	}

    .menu_loc{
        font-weight: bold;
        color: black;
        padding: 0;
    }

	.menu_btn{
        border-radius: 25px;
        border:2px solid #2F4B26;
		color: black;
		padding: 8px 25px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
        transition: 0.5s;
	}

    .menu_btn:hover{
        background-color: #2F4B26;
        color: black;
    }

    .card-footer {
        padding: 0.5rem; 
        text-align: center;
        background-color: #f8f9fa; 
        color: red;
    }
	#map { 
        height: 400px; 
        width: 100%; 
        margin-bottom: 20px;
    }
	.custom-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: #ffffff;
    box-shadow: 0 2px 5px rgba(0,0,0,0.3);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
	}

	.custom-icon-inner {
		display: flex;
		align-items: center;
		justify-content: center;
		width: 100%;
		height: 100%;
		border-radius: 50%;
	}

	.user-icon .custom-icon-inner {
		background-color: #4CAF50; /* Green background for user */
	}

	.partner-icon .custom-icon-inner {
		background-color: #FF5722; /* Orange background for partners */
	}

	.custom-icon i {
		color: white;
	}

	.leaflet-div-icon {
		background: transparent;
		border: none;
	}

	.leaflet-popup-content-wrapper {
		border-radius: 8px;
		padding: 10px;
	}

	.leaflet-popup-content {
		margin: 8px 12px;
		font-size: 14px;
		line-height: 1.4;
	}

</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.css" />

	<body>
		<div class="">
			{{-- title & warning starts --}}
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center animate-box">
						<h1 style="margin-top: 50px; color:#003366; font-weight: bold;">Menus</h1>
					</div>
				</div>
				<div class="alert alert-info animate-box text-center" role="alert">
					<p>
                        Note: The menu will be available based on your current location.
                        If your location is within 10 km and it is weekdays, the hot noon meal will be served.
                        If your location is not within 10 km and it is weekends, the frozen meal will be served. Thank you for your attention!!
					</p>
				</div>
			</div>
			{{-- title & warning ends --}}

			{{-- map starts --}}
			<div class="container">
				<div id="map"></div>
			</div>
			{{-- map ends --}}

			{{-- menu item starts --}}
			<div class="container menu_card">
				{{-- menu row starts --}}
				<div class="row row-cols-1 row-cols-md-3 g-4">
					{{-- looping for each menu starts --}}
					@foreach ($menuData as $menu)
						<div class="col">
							<div class="card h-100 shadow-lg p-3 bg-white rounded">
								<img src="{{ asset('uploads/meal/' . $menu->menu_image) }}" class="card-img-top" alt="menu image" style="width: 100%; height: 300px; object-fit: cover;">
			
								<?php 
								$partner_id = DB::table('menus')->where('id',$menu->id)->value('partner_id');
								$partner_user_id = DB::table('partners')->where('id',$partner_id)->value('user_id');
								$partner_geolocation = DB::table('users')->where('id',$partner_user_id)->value('geolocation');
								$user_geolocation = DB::table('users')->where('id',Auth()->user()->id)->value('geolocation');
			
								$user_arr = preg_split ("/\,/", $user_geolocation); 
								$partner_arr = preg_split ("/\,/", $partner_geolocation);
			
								$Lat1 = $user_arr[0];
								$Long1 = $user_arr[1];
								$Lat2 = $partner_arr[0];
								$Long2 = $partner_arr[1];
								$DistanceKM = 0;
			
								$R = 6371;
								$Lat = $Lat2 - $Lat1;
								$Long = $Long2 - $Long1;
			
								$dLat1 = deg2rad($Lat);
								$dLong1 = deg2rad($Long);
			
								$a = sin($dLat1 / 2) * sin($dLat1 / 2) +
									 cos(deg2rad($Lat1)) * cos(deg2rad($Lat2)) *
									 sin($dLong1 / 2) * sin($dLong1 / 2);
			
								$c = 2 * atan2(sqrt($a), sqrt(1 - $a));
								$DistanceKM = $R * $c;
								$DistanceKM = round($DistanceKM, 3);
			
								$weekday = date("w");
			
								if ($weekday == 0 || $weekday == 6) {
									if ($DistanceKM > 10) {
										$meal_type = "Cold meal";
										$message = "This Meal is available today";
									} else {
										$meal_type = "Hot meal";
										$message = "This Meal available only from Monday through Friday";
									}
								} else {
									if ($DistanceKM > 10) {
										$meal_type = "Cold meal";
										$message = "Support over weekend only";
									} else {
										$meal_type = "Hot meal";
										$message = "This Meal is available today";
									}
								}
								?>
			
								<div class="card-body">
									<h5 class="card-title">{{ $menu->menu_title }}</h5>
									<p class="card-text">{{ $menu->menu_description }}</p>
									<div class="d-flex justify-content-between align-items-center">
										<div>
											<p class="mb-1 text-right">{{ $meal_type }}</p>
											<p class="mb-1 text-left"><?php echo $DistanceKM; ?> Km&nbsp;near you</p>
										</div>
										<a href="{{ route('member#viewMenu', $menu->id) }}" class="menu_btn">See more</a>
									</div>
								</div>
								<div class="card-footer border-success">
									<?php echo $message; ?>
								</div>
							</div>
						</div>
					@endforeach
					{{-- looping for each menu ends --}}
				</div>
				{{-- menu row ends --}}
			</div>
			
			{{-- menu item ends --}}
		</div>
	</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js"></script>

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
	<script>
document.addEventListener('DOMContentLoaded', function() {
    // Parse member location
    var userGeolocation = "{{ Auth()->user()->geolocation }}";
    var [userLat, userLng] = userGeolocation.split(',').map(Number);

    // Initialize map
    var map = L.map('map').setView([userLat, userLng], 11);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Define custom icon styles
    var memberIcon = L.divIcon({
        className: 'custom-icon user-icon',
        html: '<div class="custom-icon-inner"><i class="fas fa-user"></i></div>',
        iconSize: [40, 40],
        iconAnchor: [20, 20],
        popupAnchor: [0, -20]
    });

    var partnerIcon = L.divIcon({
        className: 'custom-icon partner-icon',
        html: '<div class="custom-icon-inner"><i class="fas fa-store"></i></div>',
        iconSize: [40, 40],
        iconAnchor: [20, 20],
        popupAnchor: [0, -20]
    });

    // Add member marker
    L.marker([userLat, userLng], {icon: memberIcon}).addTo(map)
        .bindPopup("<strong>Your Location</strong>")
        .openPopup();

    // Add partner markers
    var partners = @json($partnerData);

    partners.forEach(function(partner) {
        if (partner.geolocation) {
            var [partnerLat, partnerLng] = partner.geolocation.split(',').map(Number);
            L.marker([partnerLat, partnerLng], {icon: partnerIcon}).addTo(map)
                .bindPopup(partner.restaurant);
        }
    });
});
</script>

@endsection

