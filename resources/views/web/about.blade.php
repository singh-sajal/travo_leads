@extends('web.app.app')
@section('css')
@endsection
@section('topBar')
    <div class="topbar-area topbar-style-one">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 align-items-center d-xl-flex d-none">
                    <div class="topbar-contact-left">
                        <ul class="contact-list">
                            <li><i class="bi bi-telephone-fill"></i> <a href="tel:+91806218233339">+91-806213382339</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-6 col-md-6 text-xl-center text-md-start text-center">
                    <div class="topbar-ad">
                        <a
                            href="https://api.whatsapp.com/send?phone=918062182339&amp;text=Hello,%20Travel%20Leads%20!%20I%20need%20more%20info">Big
                            Offers</a>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 d-md-flex  d-none align-items-center justify-content-end">
                    <ul class="topbar-social-links">
                        <li><a href="{{ $instagram->value ?? ''}}"><i
                                    class='bx bxl-instagram-alt'></i></a></li>
                        <li><a
                                href="https://api.whatsapp.com/send?phone=918062182339&amp;text=Hello,%20Travel%20Leads%20!%20Please%20share%20exclusive%20Goa%20tour%20packages%20deals"><i
                                    class="bx bxl-whatsapp-square"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="breadcrumb breadcrumb-style-one">
        <div class="container">
            <div class="col-lg-12 text-center">
                <h2 class="breadcrumb-title">About Us</h2>
                <ul class="d-flex justify-content-center breadcrumb-items">
                    <li class="breadcrumb-item"><a href="{{ route('web.home') }}">Home</a></li>
                    <li class="breadcrumb-item active">About Us</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="about-main-wrappper pt-100" id="about">
        <div class="container">
            <div class="about-tab-wrapper">
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-6">
                        <div class="about-tab-image-grid text-center">
                            <div class="about-video d-inline-block">
                                <img src="{{ asset('web/assets/images/about/about-g2.png') }}" alt="">

                            </div>
                            <div class="row float-images g-4">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="about-image">
                                        <img src="{{ asset('web/assets/images/about/about-g1.png') }}" alt="">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="about-image">
                                        <img src="{{ asset('web/assets/images/about/about-g3.png') }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mt-5 mt-lg-0">
                        <div class="about-tab-wrap">
                            <h2 class="about-wrap-title">
                                About <span>TravelinTrip</span>
                            </h2>

                            <div class="about-tab-switcher">
                                <ul class="nav nav-pills mb-3 justify-content-md-between justify-content-center"
                                    id="about-tab-pills" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <div class="nav-link active" id="pills-about1" data-bs-toggle="pill"
                                            data-bs-target="#about-pills1" role="tab" aria-controls="about-pills1"
                                            aria-selected="true">
                                            <h3>10+</h3>
                                            <h6>Years Experience</h6>
                                        </div>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <div class="nav-link" id="pills-about2" data-bs-toggle="pill"
                                            data-bs-target="#about-pills2" role="tab" aria-controls="about-pills2"
                                            aria-selected="false">
                                            <h3>100+</h3>
                                            <h6>Tour Packages</h6>
                                        </div>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <div class="nav-link" id="pills-about3" data-bs-toggle="pill"
                                            data-bs-target="#about-pills3" role="tab" aria-controls="about-pills3"
                                            aria-selected="false">
                                            <h3>5000+</h3>
                                            <h6>Satisfied Customers</h6>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content about-tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="about-pills1" role="tabpanel"
                                    aria-labelledby="pills-about1">
                                    <p>Travel Leads is a one-stop enterprise that offers the complete range of travel
                                        related services.
                                        Superior knowledge, efficient planning and the ability to anticipate and resolve
                                        potential problems
                                        along the way are the reasons behind our growth. We vow to provide best possible
                                        services at best
                                        possible prices to all our clients. Hope you have an amazing journey with
                                        us.TRAVELLING EXPERIENCE
                                        REDEFINED.We believe in helping you to De-stress. Personalized packages and
                                        dedicated tour team to
                                        provide you the best Experience in your Hard-earned vacations.</p>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('javascript')
@endsection
