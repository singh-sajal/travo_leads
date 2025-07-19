@extends('web.app.app')
@section('css')
@endsection

@section('content')
    <div class="hero-area hero-style-three">
        <img src="{{ asset('web/assets/images/banner/banner-plane.svg') }}" class="img-fluid banner-plane">
        <div class="hero-main-wrapper position-relative">
            <div class="hero-social">
                <ul class="social-list d-flex justify-content-center align-items-center gap-4">
                    <li><a href="https://www.instagram.com/travelleads.in/profilecard/?igsh=dWZlY3R2ZHFtOTlj">instagram</a>
                    </li>
                </ul>
            </div>
            <div class="swiper hero-slider-three ">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="slider-bg-1">
                            <div class="container">
                                <div class="row d-flex justify-content-center align-items-center">
                                    <div class="col-lg-8">
                                        <div class="hero3-content">
                                            <span class="title-top">Welcome To Travel Leads</span>
                                            <h1>Journey to Explore World</h1>
                                            <p>Travel Leads is a one-stop enterprise that offers the complete range of
                                                travel related
                                                services. Superior knowledge, efficient planning and the ability to
                                                anticipate and resolve
                                                potential problems along the way are the reasons behind our growth.</p>
                                            <a href="#" class="button-fill-primary banner3-btn">Book Your Travel</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="slider-bg-3">
                            <div class="container">
                                <div class="row d-flex justify-content-center align-items-center">
                                    <div class="col-lg-8">
                                        <div class="hero3-content">
                                            <span class="title-top">Welcome To Travel Leads</span>
                                            <h1>Enjoy Your New Adventure</h1>
                                            <p>Hope you have an amazing journey with us.TRAVELLING EXPERIENCE REDEFINED.We
                                                believe in helping
                                                you to De-stress. Personalized packages and dedicated tour team to provide
                                                you the best
                                                Experience in your Hard-earned vacations.</p>
                                            <a href="#" class="button-fill-primary banner3-btn">Book Your Travel</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="slider-arrows text-center d-lg-flex flex-column d-none gap-5">
                <div class="hero-prev3" tabindex="0" role="button" aria-label="Previous slide"> <i
                        class="bi bi-arrow-left"></i>
                </div>
                <div class="hero-next3" tabindex="0" role="button" aria-label="Next slide"><i
                        class="bi bi-arrow-right"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Start of Domestic Destinations --}}
    <div class="package-area package-style-one pt-110 ">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="section-head-alpha">
                        <h2>Popular Domestic Package</h2>
                        <p>Best offers for the most amazing tours across India</p>
                    </div>
                </div>

            </div>
            <div class="row g-4">
                @foreach ($domesticDestinations as $destination)
                    <div class="col-lg-4 col-md-6">
                        <div class="package-card-alpha">
                            <div class="package-thumb">
                                <a href="{{ route('web.package', $destination->uuid) }}"><img
                                        src="{{ asset($destination->image) }}" alt=""></a>
                                <p class="card-lavel">
                                    <i class="bi bi-clock"></i> <span>2 Nights & 3 Days</span>
                                </p>
                            </div>

                            <div class="package-card-body">
                                <h3 class="p-card-title"><a href="{{ route('web.package', $destination->uuid) }}">{{ $destination->title }} Tour
                                        Package</a></h3>
                                <div class="icon-part row">
                                    <div class="icon-txt col-lg-3"><i class="fa-solid fa-car"></i><span>Drive</span></div>
                                    <div class="icon-txt col-lg-3"><i class="fa-solid fa-hotel"></i><span>Hotel</span></div>
                                    <div class="icon-txt col-lg-3"><i class="fa-solid fa-bus"></i><span>Tour</span></div>
                                    <div class="icon-txt col-lg-3"><i class="fa-solid fa-utensils"></i><span>Meal</span>
                                    </div>
                                </div>
                                <div class="p-card-bottom">
                                    <div class="book-btn">
                                        <a href="{{ route('web.package', $destination->uuid) }}">View More <i class='bx bxs-right-arrow-alt'></i></a>
                                    </div>

                                    <div class="p-card-info">
                                        <span>Starting From</span>
                                        <h6>₹{{ $destination->start_amount }} <span>Per Person</span></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </div>
    {{-- end of Domestic Destinations --}}


    {{-- Start of  Top Domestic Destinations --}}
    <div class="destination-area destination-style-one pt-110 ">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="section-head-alpha">
                        <h2>Explore Top Destination</h2>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="slider-arrows text-center d-lg-flex d-none justify-content-end mb-3">
                        <div class="testi-prev custom-swiper-prev" tabindex="0" role="button"
                            aria-label="Previous slide"> <i class="bi bi-chevron-left"></i> </div>
                        <div class="testi-next custom-swiper-next" tabindex="0" role="button" aria-label="Next slide"><i
                                class="bi bi-chevron-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid p-0 overflow-hidden">
            <div class="swiper destination-slider-one">
                <div class="swiper-wrapper">
                    @foreach ($domesticDestinations as $destination)
                        <div class="swiper-slide">
                            <div class="destination-card-style-one">
                                <div class="d-card-thumb">
                                    <a href="shimla-packages.html"><img src="{{ asset($destination->image) }}"
                                            alt=""></a>
                                </div>
                                <div class="d-card-overlay">
                                    <div class="d-card-content">
                                        <h3 class="d-card-title"><a href="shimla-packages.html">{{ $destination->title }}</a></h3>
                                        <div class="d-card-info">
                                            <div class="place-count"><span>20</span> Place</div>
                                            <div class="hotel-count"><span>25</span> Hotel</div>
                                        </div>
                                        <ul class="d-rating">
                                            <li><i class="bi bi-star-fill"></i></li>
                                            <li><i class="bi bi-star-fill"></i></li>
                                            <li><i class="bi bi-star-fill"></i></li>
                                            <li><i class="bi bi-star-fill"></i></li>
                                            <li><i class="bi bi-star-fill"></i></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    {{-- end of  Top Domestic Destinations --}}
    {{-- Start of International Destinations --}}
    <div class="package-area package-style-one pt-110 ">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="section-head-alpha">
                        <h2>Popular International Packages</h2>
                        <p>Best offers for the most amazing tours across the World</p>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                @foreach ($internationalDestinations as $destination)
                    <div class="col-lg-4 col-md-6">
                        <div class="package-card-alpha">
                            <div class="package-thumb">
                                <a href="{{ route('web.package', $destination->uuid) }}"><img
                                        src="{{ asset($destination->image) }}" alt=""></a>
                                <p class="card-lavel">
                                    <i class="bi bi-clock"></i> <span>3 Nights & 4 Days</span>
                                </p>
                            </div>
                            <div class="package-card-body">
                                <h3 class="p-card-title"><a href="thailand-packages.html">{{ $destination->title }} Tour
                                        Package</a></h3>
                                <div class="icon-part row">
                                    <div class="icon-txt col-lg-3"><i class="fa-solid fa-car"></i><span>Drive</span></div>
                                    <div class="icon-txt col-lg-3"><i class="fa-solid fa-hotel"></i><span>Hotel</span>
                                    </div>
                                    <div class="icon-txt col-lg-3"><i class="fa-solid fa-bus"></i><span>Tour</span></div>
                                    <div class="icon-txt col-lg-3"><i class="fa-solid fa-utensils"></i><span>Meal</span>
                                    </div>
                                </div>
                                <div class="p-card-bottom">
                                    <div class="book-btn">
                                        <a href="{{ route('web.package', $destination->uuid) }}">View More <i
                                                class='bx bxs-right-arrow-alt'></i></a>
                                    </div>
                                    <div class="p-card-info">
                                        <span>Starting From</span>
                                        <h6>₹{{ $destination->start_amount }} <span>Per Person</span></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    {{-- end of International Destinations --}}


    <div class="testimonial-area testimonial-style-one mt-120" id="testimonials">
        <div class="testimonial-shape-group"></div>
        <div class="container position-relative">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="section-head-alpha">
                        <h2>What Our Client Say About Us</h2>
                        <p>Our happy clients reviews for us.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="slider-arrows text-center d-lg-flex d-none justify-content-end mb-3">
                        <div class="testi-prev custom-swiper-prev" tabindex="0" role="button"
                            aria-label="Previous slide"> <i class="bi bi-chevron-left"></i> </div>
                        <div class="testi-next custom-swiper-next" tabindex="0" role="button"
                            aria-label="Next slide"><i class="bi bi-chevron-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="swiper testimonial-slider-one position-relative">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="testimonial-card testimonial-card-alpha">

                            <div class="testimonial-card-top">
                                <div class="qoute-icon"><i class='bx bxs-quote-left'></i></div>
                                <h3 class="testimonial-count">01</h3>
                            </div>
                            <div class="testimonial-body">
                                <p>Cheers team Travel Leads. We just loved your great service. Our trip to Kerala became
                                    memorable only
                                    because of team Travel Leads. Friendly driver. Well planned itinerary.
                                    Ease of booking ( the really appreciable part) & everything was worth for the money. It
                                    was a super
                                    great experience. We would like to plan other unseen places too.</p>
                                <div class="testimonial-bottom">
                                    <div class="reviewer-info">
                                        <h4 class="reviewer-name">Anju Rajan</h4>
                                        <h6>Traveller</h6>
                                    </div>
                                    <ul class="testimonial-rating">
                                        <li><i class="bi bi-star-fill"></i></li>
                                        <li><i class="bi bi-star-fill"></i></li>
                                        <li><i class="bi bi-star-fill"></i></li>
                                        <li><i class="bi bi-star-fill"></i></li>
                                        <li><i class="bi bi-star-fill"></i></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial-card testimonial-card-alpha">

                            <div class="testimonial-card-top">
                                <div class="qoute-icon"><i class='bx bxs-quote-left'></i></div>
                                <h3 class="testimonial-count">02</h3>
                            </div>
                            <div class="testimonial-body">
                                <p>I felt the experience was great and amazing not only because of the beautiful place that
                                    I visited
                                    but due to the awesome response by Travel Leads. They made sure the leisure day was fun
                                    filled by
                                    sharing the details of the area where we stayed. They let us customize the package and
                                    beautifully
                                    arranged and executed the plans. The overall experience was awesome.</p>
                                <div class="testimonial-bottom">
                                    <div class="reviewer-info">
                                        <h4 class="reviewer-name">Kinjal Jain</h4>
                                        <h6>Traveller</h6>
                                    </div>
                                    <ul class="testimonial-rating">
                                        <li><i class="bi bi-star-fill"></i></li>
                                        <li><i class="bi bi-star-fill"></i></li>
                                        <li><i class="bi bi-star-fill"></i></li>
                                        <li><i class="bi bi-star-fill"></i></li>
                                        <li><i class="bi bi-star-fill"></i></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial-card testimonial-card-alpha">

                            <div class="testimonial-card-top">
                                <div class="qoute-icon"><i class='bx bxs-quote-left'></i></div>
                                <h3 class="testimonial-count">03</h3>
                            </div>
                            <div class="testimonial-body">
                                <p>The planning of the tour was super superb, I had a great time and appreciate the
                                    professional and
                                    flexible with my trip schedule. The sightseeing-spots we covered were very beautiful and
                                    it catches
                                    the eyes of everyone... We had a lovely stay, great food, and we explored the place like
                                    anything.
                                    These 7 days and 6 nights' time spends was too good... The experience was really were
                                    words are less
                                    to describe... We'll definitely use Travel Leads again for future bookings.</p>
                                <div class="testimonial-bottom">
                                    <div class="reviewer-info">
                                        <h4 class="reviewer-name">Sunil Singh</h4>
                                        <h6>Traveller</h6>
                                    </div>
                                    <ul class="testimonial-rating">
                                        <li><i class="bi bi-star-fill"></i></li>
                                        <li><i class="bi bi-star-fill"></i></li>
                                        <li><i class="bi bi-star-fill"></i></li>
                                        <li><i class="bi bi-star-fill"></i></li>
                                        <li><i class="bi bi-star-fill"></i></li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="testimonial-card testimonial-card-alpha">

                            <div class="testimonial-card-top">
                                <div class="qoute-icon"><i class='bx bxs-quote-left'></i></div>
                                <h3 class="testimonial-count">04</h3>
                            </div>
                            <div class="testimonial-body">
                                <p>My first trip to Goa was remarkable. All Thanks to Travel Leads. The team organized
                                    everythings so
                                    perfectly. At an affordable price we had an amazing trip. The hotels were nice with
                                    great hospitality.
                                    My friends and I had a great time there. The view was breathtaking. The food service was
                                    really good
                                    and tasty. Overall experience was so good that I would definitely do it again in the
                                    future, if given
                                    the chance.</p>
                                <div class="testimonial-bottom">
                                    <div class="reviewer-info">
                                        <h4 class="reviewer-name">Aanchal Malhotra</h4>
                                        <h6>Traveller</h6>
                                    </div>
                                    <ul class="testimonial-rating">
                                        <li><i class="bi bi-star-fill"></i></li>
                                        <li><i class="bi bi-star-fill"></i></li>
                                        <li><i class="bi bi-star-fill"></i></li>
                                        <li><i class="bi bi-star-fill"></i></li>
                                        <li><i class="bi bi-star-fill"></i></li>

                                    </ul>
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
