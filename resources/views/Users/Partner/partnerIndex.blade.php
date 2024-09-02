@extends('Users.Partner.layouts.app')

@section('title')
    Menu Management
@endsection

@section('content')

<style>
    /* Updated CSS from the member page */
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

    .card {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-bottom: 20px;
    }

    .card-img-top {
        object-fit: cover;
        height: 150px; /* Reduced height */
    }

    .card-body {
        padding: 20px;
    }

    .card-title {
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .card-text {
        margin-bottom: 15px;
    }

    .note {
        margin-top: 50px;
        color: #003366;
        font-weight: bold;
        text-transform: capitalize;
    }

    .alert {
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 20px;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
    }

    .container-fluid {
        padding: 0;
    }

    .add_btn {
        background-color: #2F4B26;
        color: white;
        padding: 10px 25px;
        border-radius: 10px;
        text-decoration: none;
    }

    .add_btn:hover {
        opacity: 0.8;
        cursor: pointer;
    }

    .view_btn {
        background-color: #2F4B26;
        color: white;
        padding: 10px 25px;
        border-radius: 10px;
        text-decoration: none;
    }

    .view_btn:hover {
        opacity: 0.8;
        cursor: pointer;
    }

    .main_btn {
        background-color: #2F4B26; /* Default for buttons */
        color: white;
        padding: 10px 25px;
        border-radius: 10px;
        text-decoration: none;
    }

    .main_btn:hover {
        opacity: 0.8;
        cursor: pointer;
    }

    .update_btn {
        background-color: #90EE90; /* Light Green */
        color: white;
    }

    .delete_btn {
        background-color: #FF6347; /* Red */
        color: white;
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
</style>

<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.css' rel='stylesheet' />

<body>
    <div id="fh5co-page">
        <div class="fh5co-hero">
            <div class="fh5co-overlay"></div>
            <div class="fh5co-cover text-center" style="background-image: url('{{ asset('images/partner_cover_img.webp') }}'); background-repeat: no-repeat; width:100%;">
                <div class="desc animate-box">
                    <h2><strong>Welcome to your Dashboard, {{ Auth()->user()->name }}</strong></h2>
                    <span><a class="btn btn-primary btn-lg" style="margin-right: 0;" href="">View Menu</a></span>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-8 animate-box">
                <div class="card feature-center">
                    <div class="feature-copy">
                        <h2>Today's Menu</h2>
                        <span><a class="btn btn-primary btn-lg" href="{{ route('partner#createMenu') }}">Add New Menu</a></span>
                        <div class="menu-container">
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

                            @foreach ($menuData as $menu)
                                <div class="menu-item">
                                    <div class="card shadow-lg p-3 bg-white rounded">
                                        <img src="{{ asset('uploads/meal/' . $menu->menu_image) }}" class="card-img-top" alt="menu image">

                                        <div class="card-body">
                                            <h5 class="card-title">{{ $menu->menu_title }}</h5>
                                            <p class="card-text">{{ $menu->menu_description }}</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <a href="{{ route('partner#viewMenu', $menu->id) }}" class="main_btn view_btn">View Menu</a>
                                                    <a href="{{ route('partner#updateMenu', $menu->id) }}" class="main_btn update_btn">Update Menu</a>
                                                    <a href="{{ route('partner#deleteMenu', $menu->id) }}" class="main_btn delete_btn">Delete Menu</a>
                                                </div>
                                            </div>
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

    <!-- Scripts -->
    <script src="{{ asset('js/jquery.min.js') }}" defer></script>
    <script src="{{ asset('js/jquery.easing.1.3.js') }}" defer></script>
    <script src="{{ asset('js/bootstrap.min.js') }}" defer></script>
    <script src="{{ asset('js/jquery.waypoints.min.js') }}" defer></script>
    <script src="{{ asset('js/sticky.js') }}"></script>
    <script src="{{ asset('js/jquery.stellar.min.js') }}" defer></script>
    <script src="{{ asset('js/hoverIntent.js') }}" defer></script>
    <script src="{{ asset('js/superfish.js') }}" defer></script>
    <script src="{{ asset('js/main.js') }}" defer></script>
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
