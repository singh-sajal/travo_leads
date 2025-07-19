<header>
    <div class="header-area header-style-one w-100">
        <div class="container-fluid">
            <div class="row">
                <div
                    class="col-xxl-2 col-xl-2 col-lg-12 col-md-12 col-sm-12 col-xs-12 align-items-center d-xl-flex d-lg-block">
                    <div class="nav-logo d-flex justify-content-between align-items-center">
                        <a href="{{ route('web.home') }}"><img src="{{ asset($logo->value ?? '') }}" alt="logo"></a>
                        <div class="mobile-menu d-flex ">
                            <div class="d-flex align-items-center">
                                <div class="nav-right-icons d-xl-none d-flex align-items-center ">


                                </div>
                                <a href="javascript:void(0)" class="hamburger d-block d-xl-none">
                                    <span class="h-top"></span>
                                    <span class="h-middle"></span>
                                    <span class="h-bottom"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-7 col-xl-8 col-lg-9 col-md-8 col-sm-6 col-xs-6">
                    <nav class="main-nav">
                        <div class="inner-logo d-xl-none text-center">
                            <a href="{{ route('web.home') }}"><img src="{{ asset($logo->value ?? '') }}"
                                    alt=""></a>
                        </div>
                        <ul>

                            <li><a href="{{ route('web.home') }}">Home</a></li>
                            <li><a href="{{ route('web.about') }}">About Us</a></li>

                            <li class="has-child-menu">
                                <a href="javascript:void(0)" class="toggle-menu">Domestic Tours</a>
                                <i class="fl flaticon-plus toggle-menu">+</i>
                                <ul class="sub-menu">
                                    @foreach ($domesticDestinations as $destination)
                                        <li><a href="{{ route('web.package', $destination->uuid) }}">{{ $destination->title }}
                                                Packages</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="has-child-menu">
                                <a href="javascript:void(0)" class="toggle-menu">International Tours</a>
                                <i class="fl flaticon-plus toggle-menu">+</i>
                                <ul class="sub-menu">
                                    @foreach ($internationalDestinations as $destination)
                                        <li><a href="{{ route('web.package', $destination->uuid) }}">{{ $destination->title }}
                                                Packages</a></li>
                                    @endforeach
                                </ul>
                            </li>

                            <li><a href="{{ route('agent.login') }}" target="_blank">Register As Travel Agent</a>
                            </li>
                            <li><a href="{{ route('web.contact') }}">Contact Us</a></li>
                        </ul>
                    </nav>
                </div>
                {{-- <div class="col-xxl-3 col-xl-2 col-lg-1">
                    <div class="nav-right d-xl-flex d-none">
                        <div class="nav-right-hotline d-xxl-flex d-none">
                            <div style="margin: 10px 10px 10px 5px;">
                                <img src="{{ asset('web/assets/images/icons/header-phone.png') }}" alt="">
                            </div>
                            <div class="hotline-info">
                                <span>Hot Line Number</span>
                                <h6><a href="tel:+9184574443">+91-8457843758</a></h6>
                            </div>
                        </div>

                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</header>
