@section('title')
    All Menu
@endsection

@extends('Users.Volunteer.layouts.app')

@section('content')

<style>

	.tdy_menu{
		padding: 50px 0;
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

</style>

<body>
	<div class="">
		{{-- menu item starts --}}
		<div class="container menu_card">
			{{-- menu row starts --}}
			<div class="row row-cols-1 row-cols-md-3 g-4">
				<div class="col-md-8 col-md-offset-2 text-center animate-box">
					<h1 style="margin-top: 50px; color:#003366; font-weight: bold;">Today's Menus</h1>
				</div>
				{{-- looping for each menu starts --}}
				@foreach ($menuData as $menu)
					<div class="col">
						<div class="card h-100 shadow-lg p-3 bg-white rounded">
							<img src="{{ asset('uploads/meal/' . $menu->menu_image) }}" class="card-img-top" alt="menu image" style="width: 100%; height: 300px; object-fit: cover;">
		
		
							<div class="card-body">
								<h5 class="card-title">{{ $menu->menu_title }}</h5>
								<p class="card-text">{{ $menu->menu_description }}</p>
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

