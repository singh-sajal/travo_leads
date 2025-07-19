<div class="footer-area pt-50 ">
    <div class="footer-main-wrapper ">
        <div class="footer-vactor">
            <img src="web/assets/images/banner/footer-bg.png" alt="">
        </div>
        <div class="container">
            <div class="row justify-content-center g-4">
                <div class="col-lg-3">
                    <div class="footer-about text-lg-start text-center">
                        <p>We at Travel Leads understand that nowadays, travelling has become much more than just
                            visiting a new
                            destination. That is why each of our vacation packages offers you the respite that you
                            anticipate from a
                            holiday.</p>
                        <div class="footer-social-wrap">
                            <h5>Follow Us On:</h5>
                            <ul class="footer-social-links justify-content-lg-start justify-content-center">
                                @foreach ($social as $link)
                                    <li><a href="{{ $link->value ?? '' }}">
                                        <i class='bx bxl-{{ $link->key }}'></i>
                                    </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4">
                    <div class="footer-widget">
                        <h4 class="footer-widget-title">Quick Link</h4>
                        <ul class="footer-links">
                            <li><a href="{{ route('web.home') }}">Home</a></li>
                            <li><a href="{{ route('web.contact') }}">Contact Us</a></li>
                            <li><a href="{{ route('web.about') }}">About Us</a></li>
                            <li><a href="{{ route('web.privacy-policy') }}">Privacy Policy</a></li>
                            <li><a href="{{ route('web.terms-and-conditions') }}">Terms and Conditions</a></li>
                            <li><a href="{{ route('web.shipping') }}">Shipping and Delivery Policy</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4">
                    <div class="footer-widget">
                        <h4 class="footer-widget-title">Domestic</h4>
                        <ul class="footer-links">
                            @foreach ($domesticDestinations as $destination)
                                <li><a href="{{ route('web.package', $destination->uuid) }}">{{ $destination->title }}
                                        Packages</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4">
                    <div class="footer-widget">
                        <h4 class="footer-widget-title">International</h4>
                        <ul class="footer-links">
                            @foreach ($internationalDestinations as $destination)
                                <li><a href="{{ route('web.package', $destination->uuid) }}">{{ $destination->title }}
                                        Packages</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-8">
                    <div class="footer-widget">
                        <h4 class="footer-widget-title text-center">Gallery</h4>
                        <div class="footer-gallary-grid">
                            <div class="footer-gallary-item">
                                <a href="assets/images/package/p-alpha1.png" data-fancybox="footer"
                                    data-caption="Caption Here"><img
                                        src="{{ asset('web/assets/images/package/p-alpha1.png') }}" alt=""></a>
                            </div>
                            <div class="footer-gallary-item">
                                <a href="assets/images/package/p-alpha2.png" data-fancybox="footer"
                                    data-caption="Caption Here"><img
                                        src="{{ asset('web/assets/images/package/p-alpha2.png') }}" alt=""></a>
                            </div>
                            <div class="footer-gallary-item">
                                <a href="assets/images/package/p-alpha3.png" data-fancybox="footer"
                                    data-caption="Caption Here"><img
                                        src="{{ asset('web/assets/images/package/p-alpha3.png') }}" alt=""></a>
                            </div>
                            <div class="footer-gallary-item">
                                <a href="assets/images/package/p-alpha4.png" data-fancybox="footer"
                                    data-caption="Caption Here"><img
                                        src="{{ asset('web/assets/images/package/p-alpha4.png') }}" alt=""></a>
                            </div>
                            <div class="footer-gallary-item">
                                <a href="assets/images/package/p-alpha5.png" data-fancybox="footer"
                                    data-caption="Caption Here"><img
                                        src="{{ asset('web/assets/images/package/p-alpha5.png') }}" alt=""></a>
                            </div>
                            <div class="footer-gallary-item">
                                <a href="assets/images/package/p-alpha6.png" data-fancybox="footer"
                                    data-caption="Caption Here"><img
                                        src="{{ asset('web/assets/images/package/p-alpha6.png') }}" alt=""></a>
                            </div>
                            <div class="footer-gallary-item">
                                <a href="assets/images/package/singapore-1.png" data-fancybox="footer"
                                    data-caption="Caption Here"><img
                                        src="{{ asset('web/assets/images/package/singapore-1.png') }}"
                                        alt=""></a>
                            </div>
                            <div class="footer-gallary-item">
                                <a href="assets/images/package/kashmir-1.png" data-fancybox="footer"
                                    data-caption="Caption Here"><img
                                        src="{{ asset('web/assets/images/package/kashmir-1.png') }}"
                                        alt=""></a>
                            </div>
                            <div class="footer-gallary-item">
                                <a href="assets/images/package/dubai-1.png" data-fancybox="footer"
                                    data-caption="Caption Here"><img
                                        src="{{ asset('web/assets/images/package/dubai-1.png') }}" alt=""></a>
                            </div>
                            <div class="footer-gallary-item">
                                <a href="assets/images/package/bhutan-1.png" data-fancybox="footer"
                                    data-caption="Caption Here"><img
                                        src="{{ asset('web/assets/images/package/bhutan-1.png') }}" alt=""></a>
                            </div>
                            <div class="footer-gallary-item">
                                <a href="assets/images/package/thailand-1.png" data-fancybox="footer"
                                    data-caption="Caption Here"><img
                                        src="{{ asset('web/assets/images/package/thailand-1.png') }}"
                                        alt=""></a>
                            </div>
                            <div class="footer-gallary-item">
                                <a href="assets/images/package/uttarakhand-3.png" data-fancybox="footer"
                                    data-caption="Caption Here"><img
                                        src="{{ asset('web/assets/images/package/uttarakhand-3.png') }}"
                                        alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-contact-wrapper">
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-4 col-md-6 order-lg-1 order-3 ">
                    <div class="copyright-link text-lg-start text-center">
                        <p>Copyright 2023 Travel Leads </p>
                    </div>
                </div>
                <div class="col-lg-4  order-lg-2 order-1">
                    <div class="footer-logo text-center">
                        <a href="{{ route('web.home') }}"><img src="{{ asset($logo->value ?? '') }}" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <div class="nowcalling">
    <div class="callcol"><a href="tel:+917492845786"><i class="fas fa-phone"></i> Call Now</a></div>
    <div class="whatsappcol"><a
            href="https://api.whatsapp.com/send?phone=918062182339&amp;text=Hello,%20Travel%20Leads%20!%20I%20need%20more%20info"><i
                class="fab fa-whatsapp"></i> WhatsApp</a></div>
    <div class="mapcol1"><a href="{{ $instagram->value ?? '' }}"><i class="fab fa-instagram"></i> Instagram</a>
    </div>
</div> --}}
