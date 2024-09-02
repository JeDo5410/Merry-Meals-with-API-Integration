@section('title')
    Welcome
@endsection

@extends('Users.Member.layouts.app')

@section('content')
		
		<div id="fh5co-services-section">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center heading-section animate-box">
						<h3>Member's Profile</h3>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="row display-flex justify-content">
					<div class="col-md-8 col-sm-8 col-md-offset-3">
						<div class=" animate-box">
							
							<div class="col-md-4 ">
								<h4 class="userManagement">Member's Name</h4>
								<h4 class="userManagement">Care Giver's Name</h4>
								<h4 class="userManagement">Email</h4>
								<h4 class="userManagement">Address</h4>
								<h4 class="userManagement">Due Date</h4>
							</div>
							<div class="col-md-8">
								<h4 class="userManagement">El Caputo</h4>
								<h4 class="userManagement">El Draken</h4>
								<h4 class="userManagement">test@mail.com</h4>
								<h4 class="userManagement">Empty Street</h4>
								<h4 class="userManagement">Null</h4>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- END What we do -->

@endsection