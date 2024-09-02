@section('title')
    Dashboard | MerryMeals - Meals on Wheels
@endsection

@extends('Users.Member.layouts.app')

@section('content')

<style>
    .fh5co-page {
        width: 100%;
        height: auto;
    }

    .fh5co-hero {
        position: relative;
        height: 100vh;
    }

    .fh5co-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
    }

    .fh5co-cover {
        display: flex;
        align-items: center;
        justify-content: center;
        background-size: cover;
        background-position: center;
        color: white;
        text-align: center;
        height: 100%;
    }

    .fh5co-cover .desc {
        padding: 20px;
        border-radius: 10px;
    }

    .fh5co-cover h2 {
        font-size: 2em;
        margin-bottom: 15px;
    }

    .fh5co-cover .btn {
        background-color: #2F4B26;
        color: white;
        padding: 10px 25px;
        border-radius: 5px;
        text-decoration: none;
    }

    .fh5co-cover .btn:hover {
        background-color: #2c3e50;
    }
    .feature-left {
        display: flex;
        flex-direction: column;
        justify-content: center;
        height: 100%;
        text-align: center;
        margin-bottom: 20px;
    }

    .feature-left .icon {
        margin-bottom: 10px;
    }

    .feature-left .feature-copy {
        flex: 1;
    }

    .feature-left .feature-copy h2 {
        margin-bottom: 15px;
    }

    .feature-left .feature-copy p {
        margin-bottom: 15px;
    }

    .feature-left .btn {
        margin-top: auto;
    }

    .card {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-bottom: 20px;
    }

    .card-header {
        font-weight: bold;
        font-size: 1.5em;
        margin-bottom: 10px;
    }

    .calendar {
        margin-bottom: 20px;
    }

    .quote {
        border: 1px solid #ccc;
        padding: 15px;
        border-radius: 5px;
        background-color: #f9f9f9;
    }

    .quote-header {
        font-size: 1.5em;
        font-weight: bold;
        text-align: center;
        margin-bottom: 10px;
    }

    .quote-body {
        text-align: center;
        font-style: italic;
    }

    .menu-container {
        display: flex;
        flex-direction: column;
    }

    .menu-item {
        margin-bottom: 20px;
    }

    .menu-item img {
        width: 100%;
        height: 300px;
        object-fit: cover;
    }

    .menu-item .card-body {
        padding: 15px;
    }

    .menu-item .card-footer {
        border-top: 1px solid #ccc;
        padding: 10px;
        background-color: #f8f9fa;
    }

    .card-columns {
        column-count: 1;
    }
</style>

<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.css' rel='stylesheet' />

<body>
    <div class="m4">
        @if (Session::has('orderCreated'))
            <div class="alert alert-warning animate-box" role="alert">
                {{ Session::get('orderCreated') }}<a href="{{ route('order#showOrderDelivery', Auth()->user()->id) }}"> Click here to view your order delivery status</a>
            </div>
        @endif
    
        @if(($memberData->member_meal_duration ?? 0)== 0)
            <div class="alert alert-warning animate-box" role="alert">
                Please undergo reassessment to continue with your 30 days meal plan<a href="{{ route('member#reassesment', Auth()->user()->id) }}"> Click here to apply for reassessment</a>
            </div>
        @endif 

        <div id="fh5co-page">
            <div class="fh5co-hero">
                <div class="fh5co-overlay"></div>
                <div class="fh5co-cover text-center" style="background-image: url(images/logan-weaver-lgnwvr-lK0l9pzxLps-unsplash.jpg); background-repeat: no-repeat; width:100%;">
                    <div class="desc animate-box">
                        <h2><strong>Start</strong> Getting Meals <strong> Today, {{ Auth()->user()->name }}</strong></h2>
                        <span><a class="btn btn-primary btn-lg" href="{{ route('member#viewAllMenu') }}">View Menu</a></span>
                    </div>
                </div>
            </div>
        </div>

        <br>

        <h1 class="text-center mb-4">Dashboard</h1>

        <div class="container">
            <div class="row">
                <div class="col-md-8 animate-box">
                    <div class="card feature-center">
                        <div class="feature-copy">
                            <h2>Available Menus</h2>
                            <div class="menu-container">
                                @foreach ($menuData as $menu)
                                    <div class="menu-item">
                                        <div class="card shadow-lg p-3 bg-white rounded">
                                            <img src="{{ asset('uploads/meal/' . $menu->menu_image) }}" class="card-img-top" alt="menu image">
    
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
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 animate-box">
                    <div class="card calendar">
                        <div class="card-header">Calendar</div>
                        <div id="calendar"></div>
                    </div>
                    <div class="quote">
                        <div class="quote-header">Quote of the Day</div>
                        <div class="quote-body">"I love food deliveries because it's like having a personal chef, except I never have to see their judgmental eyes when I order my third pizza of the week." - Admin</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth'
            });
            calendar.render();
        });
    </script>
</body>

@endsection