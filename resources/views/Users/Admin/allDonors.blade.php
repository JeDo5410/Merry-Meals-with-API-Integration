@section('title')
    Welcome
@endsection

@extends('Users.Admin.layouts.app')

@section('content')

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
	.text-pink {
		color: #ff679b!important;
	}
	.btn-rounded {
		border-radius: 2em;
	}
	.text-muted {
		color: #98a6ad!important;
	}
	h4 {
		line-height: 22px;
		font-size: 18px;
	}
	
</style>

<body>
	<div class="container-fluid">
		<h1 class="text-center" style="text-align: center; color:#003366; font-weight: bold; padding-top: 25px; padding-bottom:10px;">Donations Information</h1>
		<h3 class="text-center" style="text-align: center; color:#003366; font-weight: bold; padding-bottom: 25px;">Total Current Donation Amount - ${{ $totalDonate }}</h3>

		<div class="row">

			@foreach ($donorData as $donor)
			<div class="col-lg-4">
				<div class="text-center card-box animate-box">
					<div class="member-card pt-2 pb-2">
						<div class="thumb-lg member-thumb mx-auto"><img src="https://bootdey.com/img/Content/avatar/avatar6.png" class="rounded-circle img-thumbnail" alt="profile-image"></div>
						<div class="">
							<h4 style="text-transform: capitalize;">{{ $donor->donor_first_name	}} {{ $donor->donor_last_name }}</h4>
							<p class="text-muted">{{ $donor->donor_phone }} <span>| </span> <span class="text-pink">{{ $donor->donor_email }}</span></p>
							<p>Donation - ${{ DB::table('donor_fees')->where('id',$donor->id)->value('donor_fee')}}</p>
							<p>Address - {{ $donor->donor_address }}</p>
							<p>Date - {{ $donor->updated_at }}</p>
						</div>
					</div>
					
				</div>
			</div>
			@endforeach
		</div>
	</div>
</body>


@endsection