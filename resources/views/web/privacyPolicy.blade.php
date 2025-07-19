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
                <h2 class="breadcrumb-title">Privacy Policy</h2>
                <ul class="d-flex justify-content-center breadcrumb-items">
                    <li class="breadcrumb-item"><a href="{{ route('web.home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Privacy Policy</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="about-main-wrappper pt-100" id="about">
        <div class="container">
            <div class="about-tab-wrapper">
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-12 mt-5 mt-lg-0">
                        <div class="about-tab-wrap">
                            {{-- <h2>Privacy Policy</h2>

                            <div class="about-tab-switcher">
                            </div>
                            <div class="tab-content about-tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="about-pills1" role="tabpanel"
                                    aria-labelledby="pills-about1">
                                    <p>At Travel Leads, protecting your privacy is of the utmost importance to us. This
                                        Privacy Policy
                                        outlines how we collect, use, and safeguard your information when you interact with
                                        our website and
                                        services. By using Travel Leads, you agree to the terms described in this Privacy
                                        Policy. We
                                        encourage you to review it periodically as it may be updated to reflect changes in
                                        our practices or
                                        legal requirements.</p>
                                    <h4>Information We Collect</h4>
                                    <p><strong>Personal Information:</strong> When you use our services, we may collect
                                        personal
                                        information that you provide directly, including your name, contact details (email,
                                        phone number),
                                        travel preferences, and payment information.</p>
                                    <p><strong>Usage Information:</strong> We collect data on how you interact with our
                                        website, such as
                                        pages viewed, time spent on the site, and browsing behavior. This helps us
                                        understand how we can
                                        improve our services.</p>
                                    <p><strong>Device Information:</strong> We may automatically collect information about
                                        the device you
                                        use to access our site, including IP address, browser type, and device identifiers.
                                    </p>
                                    <p><strong>Cookies and Tracking Technologies:</strong> Travel Leads may use cookies and
                                        similar
                                        technologies to enhance your experience on our site, personalize content, and
                                        analyze site traffic.
                                    </p>
                                    <h4>How We Use Your Information</h4>
                                    <p>The information we collect is used to:</p>
                                    <li>Provide and personalize our services to meet your travel needs</li>
                                    <li>Process bookings, reservations, and payments securely</li>
                                    <li>Communicate with you regarding updates, promotions, or support for our services</li>
                                    <li>Improve our website’s functionality, performance, and usability</li>
                                    <li>Conduct analytics and improve our marketing strategies</li>
                                    <li>Comply with legal obligations and ensure secure transactions</li>
                                    <p>&nbsp</p>
                                    <h4>Sharing and Disclosure of Information</h4>
                                    <p>We do not sell, rent, or lease your personal information to third parties. However,
                                        in the
                                        following cases, we may share your data:</p>
                                    <li><strong>With Service Providers:</strong> Travel Leads works with trusted partners,
                                        such as travel
                                        agencies, payment processors, and hosting services, who assist in delivering our
                                        services to you.
                                    </li>
                                    <li><strong>Legal Compliance:</strong> We may disclose your information if required by
                                        law or to
                                        protect our rights, safety, or property, including enforcing our Terms of Service.
                                    </li>
                                    <li><strong>Business Transfers:</strong> If Travel Leads is involved in a merger,
                                        acquisition, or sale
                                        of assets, your information may be transferred to the relevant third party as part
                                        of the business
                                        transaction.</li>
                                    <p>&nbsp;</p>
                                    <h4>Security of Your Information</h4>
                                    <p>We implement robust security measures to protect your personal information against
                                        unauthorized
                                        access, alteration, or destruction. This includes using industry-standard encryption
                                        technologies to
                                        secure sensitive information, particularly during payment processing. However,
                                        please note that no
                                        method of transmission or electronic storage is completely secure, and we cannot
                                        guarantee absolute
                                        security.</p>
                                    <h4>Your Choices and Rights</h4>
                                    <li><strong>Access and Update Information:</strong> You may contact us to request access
                                        to, update,
                                        or correct inaccuracies in your personal information.</li>
                                    <li><strong>Opt-Out of Communications:</strong> If you no longer wish to receive
                                        promotional
                                        communications from us, you can opt out by following the instructions in each
                                        communication or
                                        contacting us directly at support@travelleads.in</li>
                                    <li><strong>Cookie Preferences:</strong>You can manage cookies and tracking technologies
                                        through your
                                        browser settings.</li>
                                    <p>&nbsp;</p>
                                    <h4>Third-Party Links</h4>
                                    <p>Our website may contain links to third-party sites or services that are not governed
                                        by this
                                        Privacy Policy. We are not responsible for the privacy practices or content of these
                                        external sites.
                                        We encourage you to review the privacy policies of any external websites before
                                        providing personal
                                        information.</p>
                                    <h4>Children’s Privacy</h4>
                                    <p>Travel Leads does not knowingly collect personal information from children under the
                                        age of 16. If
                                        we learn that we have collected information from a child without verified parental
                                        consent, we will
                                        delete that information promptly.</p>
                                    <h4>International Data Transfers</h4>
                                    <p>As a global travel platform, your information may be transferred to, processed, and
                                        stored outside
                                        your home country. We ensure that adequate safeguards are in place to protect your
                                        data during such
                                        transfers and comply with relevant data protection laws.</p>
                                    <h4>Changes to This Privacy Policy</h4>
                                    <p>Travel Leads reserves the right to update this Privacy Policy at any time. When
                                        changes are made,
                                        we will post the updated policy on our website, and the revised date will be
                                        displayed at the top.
                                        Please review it periodically to stay informed of any updates.</p>
                                    <h4>Contact Us</h4>
                                    <p>For any questions, concerns, or requests regarding this Privacy Policy or your
                                        personal data,
                                        please reach out to us:</p>
                                    <li><strong>By email:</strong> {{ $contact['social_links']['website'] }}</li>
                                    <li><strong>By phone:</strong> +91-{{ $contact['phone'] }}</li>
                                </div>
                            </div> --}}


                            {!! $policy->description !!}
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('javascript')
@endsection
