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
                            <li><i class="bi bi-telephone-fill"></i> <a href="tel:+918062182339">+91-8062182339</a></li>
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
                        <li><a href="https://www.instagram.com/travelleads.in/profilecard/?igsh=dWZlY3R2ZHFtOTlj"><i
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
                <h2 class="breadcrumb-title">Contact Us</h2>
                <ul class="d-flex justify-content-center breadcrumb-items">
                    <li class="breadcrumb-item"><a href="{{ route('web.home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Contact Us</li>
                </ul>
            </div>
        </div>
    </div>


    <div class="contact-wrapper pt-100">
        <div class="container">
            <div class="row align-items-center justify-content-lg-center gy-5">
                <div class="col-lg-6">
                    <div class="contatc-intro-figure">
                        <img src="{{ asset('web/assets/images/banner/contact-bg.png') }}" alt="" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="contact-info">
                        <h3>Contact Info.</h3>
                        <ul>
                            <li>
                                <h6>Let’s Talk</h6>
                                <a href="tel:+918062182339">+91-{{ $contact['phone'] ?? '' }}</a>
                            </li>
                            <li>
                                <h6>Visit Us.</h6>
                                <a href="index-2.html">Website: {{ $contact['social_links']['website'] }}</a>
                            </li>
                            <li>
                                <h6>Address</h6>
                                <a href="#">{{ $contact['address'] ?? '' }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="container mt-120">
            <form action="https://www.travelleads.in/contactform.php" method="post">
                <div class="contact-form-wrap">
                    <h4>Get a free quote now</h4>
                    <p>Please fill your details and send it. We will get back to you shortly</p>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="custom-input-group">
                                <input type="text" name="fname" placeholder="Your name" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="custom-input-group">
                                <input type="text" name="sender" placeholder="Your Email" required>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="custom-input-group">
                                <input type="text" name="phone" placeholder="Your Phone" required>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="custom-input-group">
                                <input type="text" name="city" placeholder="Tour Destination" required>
                            </div>
                        </div>


                    </div>

                    <div class="custom-input-group">
                        <div class="submite-btn">
                            <button type="submit">Send Message</button>
                        </div>
                    </div>
                </div>
            </form>
        </div> --}}
        <div class="contact-wrapper" id="contact">

            <div class="container mt-120">
                <form action="{{ route('web.query') }}" method="POST">
                    @csrf
                    <div class="contact-form-wrap">
                        <h4>Get a free quote now</h4>
                        <p>Please fill your details and send it. We will get back to you shortly</p>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="custom-input-group">
                                    <input type="text" name="name" placeholder="Your name" required>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="custom-input-group">
                                    <input type="text" name="email" placeholder="Your Email" required>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="custom-input-group">
                                    <input type="text" name="phone" placeholder="Your Phone" required>
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="custom-input-group">
                                    <input type="text" name="city" placeholder="Your City" required>
                                    @error('city')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group  mb-3">
                                <div class="flex-grow-1 me-1 custom-input-group mb-2">
                                    <input id="name" required name="captcha" minlength="6" maxlength="6"
                                        class="form-control custom-input-group" type="text"
                                        placeholder="Enter Captcha Code here">
                                </div>
                                @if (session('failure'))
                                    <div id="failure-alert" class="alert alert-danger alert-dismissible fade show mb-2"
                                        style="min-width: 300px;" role="alert">
                                        <strong>Error!</strong> {{ session('failure') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                                <div class="d-flex align-items-center">
                                    <img id="captchaImage" class="border" src="{{ route('web.captcha') }}" alt="CAPTCHA">
                                    <a class="btn btn-danger" onclick="refreshCaptcha(event)">
                                        <i class="fa fa-refresh"></i>
                                    </a>
                                </div>
                            </div>
                            @error('captcha')
                                <span class="text-danger fw-bold"> <strong>{{ $message }}</strong> </span>
                            @enderror
                            <div id="submitting-message" style="display: none;">
                                <p style="color:black">Submitting Your Details...</p>
                            </div>
                        </div>
                        <div class="custom-input-group">
                            <div class="submite-btn">
                                <button type="submit">Send Message</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
@section('javascript')
@endsection
