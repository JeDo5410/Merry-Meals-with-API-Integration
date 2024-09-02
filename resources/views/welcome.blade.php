@section('title')
    Welcome
@endsection

@extends('layouts.app')

@section('content')

</head>
<style>
    /* Custom CSS for equal height columns and button alignment */
    #fh5co-features .row {
        display: flex;
        flex-wrap: wrap;
    }
    #fh5co-features .col-md-4 {
        display: flex;
        flex-direction: column;
        padding-bottom: 50px;
    }
    #fh5co-features .feature-left {
        display: flex;
        flex-direction: column;
        justify-content: center; /* Center vertically */
        height: 100%;
    }
    #fh5co-features .feature-left .icon {
        margin-right: 10px; /* Adjust icon spacing */
    }
    #fh5co-features .feature-copy {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    #fh5co-features .feature-copy h2,
    #fh5co-features .feature-copy p {
        margin-bottom: 15px;
    }
    #fh5co-features .feature-copy .btn {
        margin-top: auto; /* Pushes the button to the bottom */
    }
        .accordion {
        background-color: #eee;
        border: none;
        cursor: pointer;
        padding: 10px 20px;
        width: 100%;
        text-align: left;
        outline: none;
        font-size: 16px;
        transition: 0.4s;
    }

    .accordion:hover,
    .accordion.active {
        background-color: #ccc;
    }

    .panel {
        display: none;
        overflow: hidden;
        padding: 10px 10px;
        background-color: white;
        text-align: left;
    }

</style>
    <body class="antialiased">
           <div id="fh5co-wrapper">
                <div id="fh5co-page">
        
                    <div class="fh5co-hero">
                        <div class="fh5co-overlay"></div>
                        <div class="fh5co-cover text-center" data-stellar-background-ratio="0.5" style="background-image: url(images/welcomebg.jpg);">
                            <div class="desc animate-box">
                                <h2><strong>Donate</strong> to give meals to <strong> Those In Need</strong></h2>
                                {{-- <span>HandCrafted by <a href="http://frehtml5.co/" target="_blank" class="fh5co-site-name">FreeHTML5.co</a></span> --}}
                                <span><a class="btn btn-primary btn-lg" href="/donationFee">Donate Now</a></span>
                            </div>
                        </div>
                    </div>

                    <!-- end:header-top -->
                    <div class="container" id="fh5co-features">
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3 text-center heading-section animate-box">
                                        <h3>Ways to Support</h3>
                                        <p>Discover various opportunities to contribute and make a positive impact with us.</p>
                                    </div>
                                <div class="col-md-4 text-center animate-box" >
                                    <div class="feature-left">
                                        <span class="icon">
                                            <i class="icon-profile-male"></i>
                                        </span>
                                        <div class="feature-copy">
                                            <h2>Become a Volunteer</h2>
                                            <p>Join us in supporting our mission to nourish seniors in need. Your commitment makes a lasting impact.</p>
                                            <a href="{{ route('register.form') }}?interest=volunteer" class="btn btn-primary">Sign Up Now</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 text-center animate-box">
                                    <div class="feature-left">
                                        <span class="icon">
                                            <i class="icon-hand"></i>
                                        </span>
                                        <div class="feature-copy">
                                            <h2>Partnership Opportunities</h2>
                                            <p>Partner with us to make a difference in the lives of seniors. Together, we can provide essential support and care.</p>
                                            <a href="{{ route('register.form') }}?interest=partner" class="btn btn-primary">Partner With Us</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 text-center animate-box">
                                    <div class="feature-left">
                                        <span class="icon">
                                            <i class="icon-wallet"></i>
                                        </span>
                                        <div class="feature-copy">
                                            <h2>Donation</h2>
                                            <p>Support our cause with your generosity. Every donation helps us make a difference.</p>
                                            <a href="/donationFee" class="btn btn-primary">Donate</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="fh5co-portfolio">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2 text-center heading-section animate-box">
                                    <h3>Our Impact</h3>
                                    <p>Hear heartfelt testimonials from our seniors and caregivers about their experiences with MerryMeal on Wheels.</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 text-center animate-box">
                                    <!-- Video iframe -->
                                    <iframe width="100%" height="315" src="video/testimony.mp4" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                </div>
                                <div class="col-md-6 text-center animate-box">
                                    <!-- Text content -->
                                    <p>"MerryMeal on Wheels provides nutritious, delicious meals with care and compassion, making a significant difference in the lives of seniors and their families. Their service offers not only food but also comfort and peace of mind for those who can no longer cook for themselves."</p>
                                    <p><strong>— Testimonials from grateful seniors and caregivers</strong></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container" style="margin-bottom: 25px;">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2 text-center heading-section animate-box">
                                <h3>Frequently Asked Questions</h3>
                                <p>Find answers to common questions about our services, volunteering, and donations.</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center animate-box">
                                <div class="faq-item">
                                    <button class="accordion">What services does MerryMeal on Wheels provide?</button>
                                    <div class="panel">
                                        <p>We offer nutritious meal delivery tailored to seniors who can't cook for themselves. Our services include personalized meal planning, emergency meal kits, comfort packages, and community engagement activities.</p>
                                    </div>
                                </div>
                                <div class="faq-item">
                                    <button class="accordion">How can I request meal delivery?</button>
                                    <div class="panel">
                                        <p>To request meal delivery, you need to be a registered member or caregiver. Please fill out the <a href="{{ route('register.form') }}?interest=member">registration form</a> on our website to get started.</p>
                                    </div>
                                </div>
                                <div class="faq-item">
                                    <button class="accordion">Are there any special dietary options available?</button>
                                    <div class="panel">
                                        <p>Yes, we offer meals that accommodate various dietary needs such as low-sodium, diabetic-friendly, and gluten-free options. Please let us know your dietary requirements when you request meals.</p>
                                    </div>
                                </div>
                                <div class="faq-item">
                                    <button class="accordion">How can I volunteer with MerryMeal on Wheels?</button>
                                    <div class="panel">
                                        <p>We welcome volunteers to help with meal preparation and delivery. If you're interested in volunteering, please visit our <a href="{{ route('register.form') }}?interest=volunteer">volunteer registration form</a> for more information and to sign up.</p>
                                    </div>
                                </div>
                                <div class="faq-item">
                                    <button class="accordion">How can I make a donation?</button>
                                    <div class="panel">
                                        <p>To make a donation, visit our <a href="/donationFee">donation page</a>. We accept one-time and recurring donations, as well as in-kind contributions. Your support helps us continue providing essential services to seniors in need.</p>
                                    </div>
                                </div>
                                <div class="faq-item">
                                    <button class="accordion">Can I customize my meal plan?</button>
                                    <div class="panel">
                                        <p>Yes, we offer personalized meal plans based on your dietary needs and preferences. Please contact us to discuss your requirements and preferences so we can create a meal plan that suits you.</p>
                                    </div>
                                </div>
                                <div class="faq-item">
                                    <button class="accordion">What should I do if I have a complaint or feedback?</button>
                                    <div class="panel">
                                        <p>We value your feedback and strive to improve our services. Please reach out to us via our <a href="/contact">contact form</a>, or email us at MealsOnWheels@gmail.com. We will address your concerns as promptly as possible.</p>
                                    </div>
                                </div>
                                <div class="faq-item">
                                    <button class="accordion">How do I get in touch with MerryMeal on Wheels?</button>
                                    <div class="panel">
                                        <p>You can contact us via phone at +9986554677, email at MealsOnWheels@gmail.com, or through our <a href="/contact">contact form</a> on our website. We’re here to help with any questions or concerns you may have.</p>
                                    </div>
                                </div>
                                <div class="faq-item">
                                    <button class="accordion">How can I become a food provider partner?</button>
                                    <div class="panel">
                                        <p>If you're interested in becoming a food provider partner, please register through our <a href="{{ route('register.form') }}?interest=partner">partner registration form</a> for more information.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
            


        <script>

            document.addEventListener('DOMContentLoaded', function () {
                var accordions = document.getElementsByClassName('accordion');

                for (var i = 0; i < accordions.length; i++) {
                    accordions[i].addEventListener('click', function () {
                        this.classList.toggle('active');
                        var panel = this.nextElementSibling;

                        if (panel.style.display === 'block') {
                            panel.style.display = 'none';
                        } else {
                            panel.style.display = 'block';
                        }
                    });
                }
            });

        </script>
    </body>
@endsection
