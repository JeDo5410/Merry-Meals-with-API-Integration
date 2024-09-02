@section('title')
    Menu Management
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
	.card-box {
    padding: 20px;
    border-radius: 3px;
    margin-bottom: 30px;
    background-color: #fff;
	transition: 0.3s;
	}

	.thumb-lg {
		height: 88px;
		width: 88px;
		margin-bottom: 15px;
	}
	.img-thumbnail {
		padding: .25rem;
		background-color: #fff;
		border: 1px solid #dee2e6;
		border-radius: .25rem;
		max-width: 100%;
		height: auto;
	}

</style>

<body>
	<div class="container-fluid">
		<h1 class="text-center" style="margin-top: 50px; color:#003366; font-weight: bold;">Menus Information</h1>

		@if (Session::has('menuCreated'))
			<div class="alert alert-success animate-box" role="alert">
				{{ Session::get('menuCreated') }}
			</div>
		@endif
		@if (Session::has('menuDeleted'))
			<div class="alert alert-danger animate-box" role="alert">
				{{ Session::get('menuDeleted') }}
			</div>
		@endif
		@if (Session::has('updateData'))
            <div class="alert alert-success animate-box" role="alert">
                {{ Session::get('updateData') }}
            </div>
       @endif


		{{-- menu row starts --}}
		<div class="row">
			@foreach ($menuData as $menu)
				<div class="col-lg-4">
					<div class="card-box">
						<div class="member-card pt-2 pb-2 h-100">
							<img src="{{ asset('uploads/meal/' . $menu->menu_image) }}" class="card-img-top" alt="menu image" style="width: 100%; height: 300px; object-fit: cover;">
		
							<div class="card-body">
								<h3 class="card-title" style="text-transform: capitalize;">{{ $menu->menu_title }}</h3>
								<p class="card-text">{{ $menu->menu_description }}</p>
							</div>
	
							@if ( Auth::user() -> role == 'admin')
									<a href="{{ route('admin#updateMenu', $menu->id) }}" class="btn btn-primary">
										<i class="icon-edit"> </i> Update Menu
									</a>
									<a href="{{ route('admin#deleteMenu', $menu->id) }}" class="btn btn-danger">
										<i class="icon-trash"></i> Delete Menu
									</a>
								@endif
						</div>
					</div>
				</div>
			@endforeach

		</div>
		{{-- menu row ends --}}

		
	</div>
</body>


	@endsection
