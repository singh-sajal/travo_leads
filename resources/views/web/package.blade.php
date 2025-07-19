@extends('web.app.app')
@section('css')
    <style>
        .package-thumb {
            position: relative;
            overflow: hidden;
        }

        .card-lavel {
            position: absolute;
            bottom: 0;
            /* Attach to the bottom */
            left: 0;
            /* Align to the left */
            background: #d60000;
            color: #fff;
            padding: 5px 12px;
            font-size: 14px;
            font-weight: bold;
            z-index: 20 !important;
            /* Ensure it stays on top */
            clip-path: polygon(0 0, 100% 0, 85% 100%, 0% 100%);
            /* Ribbon shape */
        }

        .share-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(0, 0, 0, 0.6);
            color: #fff;
            padding: 8px;
            border-radius: 50%;
            font-size: 18px;
            cursor: pointer;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
            z-index: 25;
            /* Higher than card-lavel */
        }

        .package-thumb:hover .share-btn {
            opacity: 1;
        }
    </style>
    <style>
        @keyframes highlight {
            0% {
                border-color: #d60000;
            }

            50% {
                border-color: #d60000;
            }

            100% {
                border-color: transparent;
            }
        }

        .highlight-package {
            animation: highlight 3s ease;
            border: 2px solid transparent;
        }
    </style>

    <style>
        /* Remove blue outline on focus */
        #dateInput:focus,
        #captcha:focus {
            outline: none !important;
            box-shadow: none !important;
            border-color: #dc3545 !important;
            /* You can adjust the border color if needed */
        }
    </style>
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
                            href="https://api.whatsapp.com/send?phone=918062182339&amp;text=Hello,%20Travel%20Leads%20!%20Please%20share%20exclusive%20Kashmir%20tour%20packages%20deals">Deals
                            & Offers</a>
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
                <h2 class="breadcrumb-title">{{ $destination->title }} Tour Packages</h2>
                <ul class="d-flex justify-content-center breadcrumb-items">
                </ul>
            </div>
        </div>
    </div>

    <div class="package-area package-style-one pt-110 " id="packages">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="section-head-alpha">
                        <h2>Popular Tour Package</h2>
                        <p>Best offers for the most amazing tours to {{ $destination->title }}</p>
                    </div>
                </div>
            </div>
            <div class="row g-4">
                @php
                    $id = 0;
                @endphp
                @foreach ($destination->package as $package)
                    <div class="col-lg-4 col-md-6">
                        <!-- Added data-package-id attribute -->
                        <div class="package-card-alpha" data-package-id="{{ $package->id }}">
                            <div class="package-thumb">
                                <a href="#contact"><img src="{{ asset($package->image) }}" alt=""></a>
                                <p class="card-lavel">
                                    <i class="bi bi-clock"></i>
                                    <span>{{ $package->duration_nights }} Night & {{ $package->duration_days }} Days</span>
                                </p>
                                <!-- Share Button -->
                                <div class="share-btn" data-bs-toggle="modal" data-bs-target="#shareModal"
                                    data-url="{{ url()->current() . '?id=' . $id }}">
                                    @php
                                        ++$id;
                                    @endphp
                                    <i class="fa-solid fa-share-nodes"></i>
                                </div>
                            </div>
                            <div class="package-card-body">
                                <h3 class="p-card-title"><a href="#contact">{{ $package->name }}
                                        {{ $package->duration_nights }} Night {{ $package->duration_days }} Days</a></h3>
                                <div class="icon-part row">
                                    <div class="icon-txt col-lg-3"><i class="fa-solid fa-car"></i><span>Drive</span></div>
                                    <div class="icon-txt col-lg-3"><i class="fa-solid fa-hotel"></i><span>Hotel</span></div>
                                    <div class="icon-txt col-lg-3"><i class="fa-solid fa-bus"></i><span>Tour</span></div>
                                    <div class="icon-txt col-lg-3"><i class="fa-solid fa-utensils"></i><span>Meal</span>
                                    </div>
                                </div>
                                <div class="p-card-bottom">
                                    <div class="book-btn">
                                        <a href="#contact">Get Quotes <i class='bx bxs-right-arrow-alt'></i></a>
                                    </div>
                                    <div class="p-card-info">
                                        <span>Starting From</span>
                                        <h6>₹{{ $package->price }} <span>Per Person</span></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Share Modal remains unchanged -->
            <div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="shareModalLabel">Share This Package</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <p>Share this package with your friends:</p>
                            <div class="d-flex justify-content-center gap-3">
                                <a id="whatsappShare" class="btn btn-success" target="_blank">
                                    <i class="fa-brands fa-whatsapp"></i> WhatsApp
                                </a>
                                <a id="facebookShare" class="btn btn-primary" target="_blank">
                                    <i class="fa-brands fa-facebook"></i> Facebook
                                </a>
                            </div>
                            <div class="d-flex justify-content-center gap-3 mt-2">
                                <a id="twitterShare" class="btn btn-info" target="_blank">
                                    <i class="fa-brands fa-twitter"></i> Twitter
                                </a>
                                <a id="instagramShare" class="btn btn-danger" target="_blank">
                                    <i class="fa-brands fa-instagram"></i> Instagram
                                </a>
                            </div>
                            <div class="mt-3">
                                <input type="text" id="shareLink" class="form-control" readonly>
                                <button class="btn btn-secondary mt-2" onclick="copyLink()">
                                    <i class="fa-solid fa-copy"></i> Copy Link
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                // Existing share modal script
                document.addEventListener("DOMContentLoaded", function() {
                    var shareModal = document.getElementById('shareModal');
                    shareModal.addEventListener('show.bs.modal', function(event) {
                        var button = event.relatedTarget;
                        var shareUrl = button.getAttribute('data-url'); // Get the package URL

                        document.getElementById("whatsappShare").href = "https://api.whatsapp.com/send?text=" +
                            encodeURIComponent(shareUrl);
                        document.getElementById("facebookShare").href =
                            "https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(shareUrl);
                        document.getElementById("twitterShare").href = "https://twitter.com/intent/tweet?url=" +
                            encodeURIComponent(shareUrl);
                        document.getElementById("instagramShare").href = "https://www.instagram.com/?url=" +
                            encodeURIComponent(shareUrl);
                        document.getElementById("shareLink").value = shareUrl;
                    });
                });

                // Copy Link Function
                function copyLink() {
                    var copyText = document.getElementById("shareLink");
                    copyText.select();
                    copyText.setSelectionRange(0, 99999); // For mobile devices
                    document.execCommand("copy");
                    alert("Link copied: " + copyText.value);
                }

                // New: Automatically select the package in the form when a package card is clicked
                document.addEventListener("DOMContentLoaded", function() {
                    // Loop through each package card
                    document.querySelectorAll('.package-card-alpha').forEach(function(card) {
                        card.addEventListener('click', function(event) {
                            // Avoid conflict if clicking the share button or its icon
                            if (event.target.closest('.share-btn')) {
                                return;
                            }
                            // Get the package id from the card's data attribute
                            var packageId = this.getAttribute('data-package-id');
                            // Set the value in the package dropdown (using the id "packageSelector")
                            var packageSelector = document.getElementById('packageSelector');
                            if (packageSelector) {
                                packageSelector.value = packageId;
                            }
                        });
                    });
                });
            </script>
        </div>
    </div>

    <!-- Rest of your sections remain unchanged -->
    <div class="testimonial-area testimonial-style-one mt-120" id="testimonials">
        <!-- Testimonial content -->
    </div>

    <div class="about-main-wrappper pt-100" id="about">
        <!-- About content -->
    </div>

    <div class="contact-wrapper" id="contact">
        <div class="container mt-120">
            <form action="{{ route('web.query') }}" method="POST">
                @csrf
                <div class="contact-form-wrap">
                    <h4>Get a free quote now</h4>
                    <p>Please fill your details and send it. We will get back to you shortly</p>
                    <div class="row">
                        <input type="hidden" id="priceInput" name="price">
                        <div class="col-lg-6">
                            <div class="custom-input-group">
                                <input type="text" name="name" placeholder="Your name" value="{{ old('name')}}" required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="custom-input-group">
                                <input type="text" name="email" placeholder="Your Email" value="{{ old('email')}}" required>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="custom-input-group">
                                <input type="text" name="phone" placeholder="Your Phone" value="{{ old('phone')}}" required>
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="custom-input-group">
                                <input type="text" name="person" placeholder="Total number of tourist" value="{{ old('person')}}" required>
                                @error('person')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="custom-input-group">
                                <input type="text" name="city" placeholder="Your City" value="{{ old('city') }}" required>
                                @error('city')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Package Selector Dropdown with an ID for easy reference -->
                        <div class="col-lg-6">
                            <div class="custom-input-group">
                                <select id="packageSelector" name="package" class="form-control" required>
                                    <option value="{{ old('package')}}">Select Package</option>
                                    @foreach ($destination->package as $package)
                                        <option value="{{ $package->id }}">
                                            {{ $package->name }} ({{ $package->duration_nights }} Night &amp;
                                            {{ $package->duration_days }} Days) - ₹{{ $package->price }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('package')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!-- End Package Selector Dropdown -->
                        <div class="col-lg-6">
                            <div class="custom-input-group">
                                <input type="text" id="datePlaceholder" class="form-control"
                                    placeholder="Expected date" onfocus="showDateInput()">
                                <input type="date" id="dateInput" name="date" class="form-control" value="{{ old('date')}}"
                                    style="display: none;" min="">
                                @error('date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="custom-input-group d-flex align-items-center">
                                <input id="captcha" required name="captcha" minlength="6" maxlength="6"
                                    class="form-control me-2 mt-0" type="text" placeholder="Enter Captcha Code"
                                    required>
                                <img id="captchaImage" class="border" src="{{ route('web.captcha') }}" alt="CAPTCHA"
                                    style="height: 45px; width: 120px; object-fit: cover;">
                                <a class="btn btn-danger d-flex align-items-center justify-content-center ms-2"
                                    onclick="refreshCaptcha(event)" style="width: 45px; height: 45px; display: flex;">
                                    <i class="fa fa-refresh"></i>
                                </a>
                            </div>
                            @if (session('failure'))
                                <div id="failure-alert" class="alert alert-danger alert-dismissible fade show mt-2"
                                    role="alert">
                                    <strong>Error!</strong> {{ session('failure') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            @error('captcha')
                                <span class="text-danger fw-bold"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 text-end mt-3">
                            <button type="submit" class="btn btn-primary">Send Message</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('javascript')
    <script>
        function refreshCaptcha(event) {
            event.preventDefault();
            var captchaImage = document.getElementById('captchaImage');
            captchaImage.src = "{{ route('web.captcha') }}";
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var shareModal = document.getElementById('shareModal');

            shareModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var shareUrl = button.getAttribute('data-url'); // Get the package URL

                document.getElementById("whatsappShare").href = "https://api.whatsapp.com/send?text=" +
                    encodeURIComponent(shareUrl);
                document.getElementById("facebookShare").href =
                    "https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(shareUrl);
                document.getElementById("twitterShare").href = "https://twitter.com/intent/tweet?url=" +
                    encodeURIComponent(shareUrl);
                document.getElementById("instagramShare").href = "https://www.instagram.com/?url=" +
                    encodeURIComponent(shareUrl);
                document.getElementById("shareLink").value = shareUrl;
            });
        });

        // Copy Link Function
        function copyLink() {
            var copyText = document.getElementById("shareLink");
            copyText.select();
            copyText.setSelectionRange(0, 99999); // For mobile devices
            document.execCommand("copy");
            alert("Link copied: " + copyText.value);
        }
    </script>

    <script>
        function refreshCaptcha(event) {
            event.preventDefault();
            var captchaImage = document.getElementById('captchaImage');
            captchaImage.src = "{{ route('web.captcha') }}";
        }

        // Existing share modal script here...

        // New code for scrolling to package
        document.addEventListener("DOMContentLoaded", function() {
            // Check for 'id' parameter in URL
            const urlParams = new URLSearchParams(window.location.search);
            const packageId = urlParams.get('id');

            if (packageId !== null) {
                const packages = document.querySelectorAll('.col-lg-4.col-md-6');
                const id = parseInt(packageId, 10);

                if (!isNaN(id) && id >= 0 && id < packages.length) {
                    const targetPackage = packages[id];

                    // Add highlight class
                    targetPackage.classList.add('highlight-package');

                    // Scroll to the package smoothly
                    targetPackage.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });

                    // Remove highlight after animation
                    setTimeout(() => {
                        targetPackage.classList.remove('highlight-package');
                    }, 3000);
                }
            }
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let today = new Date();
            let formattedDate = today.getFullYear() + '-' +
                String(today.getMonth() + 1).padStart(2, '0') + '-' +
                String(today.getDate()).padStart(2, '0');

            let dateInput = document.getElementById("dateInput");
            dateInput.setAttribute("min", formattedDate);

            // Prevent users from manually entering past dates
            dateInput.addEventListener("input", function() {
                if (this.value < formattedDate) {
                    alert("Past dates are not allowed!");
                    this.value = formattedDate;
                }
            });
        });
    </script>

    {{-- to replace dd-mm-yyyy with Exected Date --}}
    <script>
        function showDateInput() {
            let placeholder = document.getElementById("datePlaceholder");
            let dateInput = document.getElementById("dateInput");

            placeholder.style.display = "none";
            dateInput.style.display = "block";
            dateInput.focus();
        }

        document.getElementById("dateInput").addEventListener("blur", function() {
            if (!this.value) {
                this.style.display = "none";
                document.getElementById("datePlaceholder").style.display = "block";
            }
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Loop through each package card
            document.querySelectorAll('.package-card-alpha').forEach(function(card) {
                card.addEventListener('click', function(event) {
                    // Avoid conflict if clicking the share button or its icon
                    if (event.target.closest('.share-btn')) {
                        return;
                    }

                    // Get the package id from the card's data attribute
                    var packageId = this.getAttribute('data-package-id');

                    // Set the value in the package dropdown
                    var packageSelector = document.getElementById('packageSelector');
                    if (packageSelector) {
                        packageSelector.value = packageId;
                    }

                    // Get the price from the card and set it in the price input
                    var priceElement = this.querySelector('.p-card-info h6');
                    if (priceElement) {
                        var priceText = priceElement.textContent.split(' ')[
                        0]; // Get just the price part (₹XXXX)
                        var priceInput = document.getElementById('priceInput');
                        if (priceInput) {
                            priceInput.value = priceText.replace('₹',
                            ''); // Remove ₹ symbol and set the value
                        }
                    }

                    // Optional: Scroll to the contact form
                    document.getElementById('contact').scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });
        });
    </script>
@endsection
