@extends('Users.Member.layouts.app')

@section('title')
    Confirm Your Order
@endsection

@section('content')

    <?php $partner_id = DB::table('menus')->where('id',$partnerData->id)->value('partner_id');
											//echo $partner_id;
											$partner_id = DB::table('menus')->where('id', $partnerData->id)->value('partner_id');
                    $partner_user_id = DB::table('partners')->where('id', $partner_id)->value('user_id');
                    $partner_geolocation = DB::table('users')->where('id', $partner_user_id)->value('geolocation');
                    $user_geolocation = DB::table('users')->where('id', Auth::id())->value('geolocation');

                    // Split geolocation into latitude and longitude
                    $user_arr = preg_split("/\,/", $user_geolocation);
                    $partner_arr = preg_split("/\,/", $partner_geolocation);

                    // Validate that the arrays have at least two elements
                    if (count($user_arr) < 2 || count($partner_arr) < 2) {
                        $distanceKM = 'N/A';
                        $meal_type = 'N/A';
                        $message = 'Geolocation data is incomplete.';
                    } else {
                        $Lat1 = $user_arr[0];
                        $Long1 = $user_arr[1];
                        $Lat2 = $partner_arr[0];
                        $Long2 = $partner_arr[1];

                        // Calculate distance
                        $R = 6371;
                        $Lat = $Lat2 - $Lat1;
                        $Long = $Long2 - $Long1;
                        $dLat1 = deg2rad($Lat);
                        $dlong1 = deg2rad($Long);
                        $a = sin($dLat1 / 2) * sin($dLat1 / 2) + cos(deg2rad($Lat1)) * cos(deg2rad($Lat2)) * sin($dlong1 / 2) * sin($dlong1 / 2);
                        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
                        $DistanceKM = $R * $c;
                        $DistanceMeter = $DistanceKM * 1000;
                        $DistanceKM = round($DistanceKM, 3);

                        // Determine meal type based on distance and day of the week
                        $weekday = date("w");
                        if ($weekday == 0 || $weekday == 6) {
                            if ($DistanceKM > 10) {
                                $meal_type = "Cold";
                                $message = "This Meal is available today";
                            } else {
                                $meal_type = "Hot";
                                $message = "This Meal available only from Monday through Friday";
                            }
                        } else {
                            if ($DistanceKM > 10) {
                                $meal_type = "Cold";
                                $message = "Support over weekend only";
                            } else {
                                $meal_type = "Hot";
                                $message = "This Meal is available today";
                            }
                        }
                    }
										
	?>

<div style="margin: 60px;">
	<a href="javascript:history.go(-1)" style="text-decoration: underline; color:blue;" >Click here to cancel order and go back to menu</a>
	
	<div class="grid-container">
		<div class="item1"><h1 style="margin: 10px auto;">Confirm Your Order</h1></div>
		
		<div class="item3">
			<div class="container" style="background-color: #f2f2f2;
			padding: 5px 20px 15px 20px;
			border: 1px solid lightgrey;
			border-radius: 3px;">
			<form action="{{ route('order#saveOrder' ) }}" method="POST" enctype="multipart/form-data">
				@csrf
        <div class="row">
          <div class="col-50">
            <h3>Your Details</h3>
            <label class="checkout-label"  for="fname"><i class="fa fa-user"></i> Full Name</label>
            <input class="checkout-input" type="text" id="fname" name="member_name" value="{{ $userData-> name }}" readonly>

            <label class="checkout-label" for="email"><i class="fa fa-envelope"></i> Email</label>
            <input class="checkout-input" type="text" id="email" name="email" value="{{ $userData-> email }}" readonly>

            <label class="checkout-label" for="adr"><i class="fa fa-address-card-o"></i> Address</label>
            <input class="checkout-input" type="text" id="adr" name="member_address" value="{{ $userData-> address }}" readonly>

            <label class="checkout-label" for="phone"><i class="fa fa-institution"></i> Phone</label>
            <input class="checkout-input" type="text" id="phone" name="member_phone" value="{{ $userData-> phone }}" readonly>

            <div class="row">
              <div class="col-50">
                <label class="checkout-label" for="caregiver">Caregiver Name</label>
                <input class="checkout-input" type="text" id="caregiver" name="caregiver" value="{{ $memberData-> member_caregiver_name }}" readonly>
              </div>
              <div class="col-50">
                <label class="checkout-label" for="relation">CareGiver Relation</label>
                <input class="checkout-input" type="text" id="relation" name="relation" value="{{ $memberData-> member_caregiver_relation }}" readonly>
              </div>
            </div>
          </div>

          <div class="col-50">
            <h3>Menu To Order</h3>
						<div class="form-floating mb-3" style="padding-bottom: 50px">
							@if ($menuData->menu_image)
								<img src="{{ asset('uploads/meal/'. $menuData->menu_image) }}" class="img-thumbnail" alt="category image ">
								<br>
							@endif

							<input type="hidden" name="order_menu_image" value="{{ $menuData->menu_image}}" />
								<input type="hidden" name="menu_id" value="{{  $menuData->id}}" />
								<input type="hidden" name="partner_id" value="{{  $partnerData->id}}" />
								<input type="hidden" name="member_id" value="{{  $memberData->id}}" />
                <input type="hidden" name="user_id" value="{{  Auth()->user()->id}}" />
								<input type="hidden" name="partner_address" value="{{  $partnerData->partnership_address }}" />
						</div>
            <label class="checkout-label" for="cname">Menu Name</label>
            <input class="checkout-input" type="text" id="cname" name="order_menu_name" value="{{ $menuData-> menu_title }}" readonly>

            <label class="checkout-label" for="ccnum">Menu Type</label>
            <input class="checkout-input" type="text" id="ccnum" name="order_menu_type" value="<?php echo $meal_type ?>" readonly>

            <label class="checkout-label" for="expmonth">Menu Prepared By</label>
            <input class="checkout-input" type="text" id="expmonth" name="order_menu_restaurant" value="{{ $partnerData-> partnership_restaurant }}" readonly>
            <div class="row">
              <div class="col-50">
                <label class="checkout-label" for="expyear">Delivered By (A volunteer will be assigned as your rider)</label>
                <input class="checkout-input" type="text" id="expyear" name="volunteer_name" value="Volunteer to be assigned" readonly>
              </div>
              <div class="col-50">
                <label class="checkout-label" for="cvv">Meal Plan (1 day will be deducted from your 30 days plan)</label>
								
                <input class="checkout-input" type="text" id="cvv" name="menu_plan" value="<?php
								 echo ($memberData -> member_meal_duration ) - 1; ?>" readonly>
              </div>
            </div>
          </div>
          
        </div>
      
        <input type="submit" value="Confirm Order" class="checkout-btn">
      </form>
			</div>

		
		</div>  
		
	</div>
	</div>
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.min.js') }}" defer></script>
    <script src="{{ asset('js/jquery.easing.1.3.js') }}" defer></script>
    <script src="{{ asset('js/bootstrap.min.js') }}" defer></script>
    <script src="{{ asset('js/jquery.waypoints.min.js') }}" defer></script>
    <script src="{{ asset('js/sticky.js') }}"></script>
    <script src="{{ asset('js/jquery.stellar.min.js') }}" defer></script>
    <script src="{{ asset('js/hoverIntent.js') }}" defer></script>
    <script src="{{ asset('js/superfish.js') }}" defer></script>
    <script src="{{ asset('js/main.js') }}" defer></script>
@endsection
