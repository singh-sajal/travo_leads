<!doctype html>
<html lang="en">
@php
    use App\Models\Setting;

    $setting = Setting::where('key', 'logo')
                        ->orWhere('key', 'fevicon')
                        ->orWhere('common_key','social_link')
                        ->orWhere('common_key','contact')
                        ->get();

    $logo= $setting->where('key', 'logo')->first();
    $fevicon= $setting->where('key', 'fevicon')->first();
    // $whatsapp= $setting->where('key', 'whatsapp')->first();
    // $phone= $setting->where('key', 'phone')->first();
    // $email= $setting->where('key', 'email')->first();
    // $address= $setting->where('key', 'address')->first();
    $social= $setting->where('common_key', 'social_link')->all();
    // $instagram= $setting->where('key', 'instagram')->first();
    // $twitter= $setting->where('key', 'twitter')->first();
    // $linkedin= $setting->where('key', 'linkedin')->first();
    // $youtube= $setting->where('key', 'youtube')->first();
@endphp

<head>
    <title>Travel Leads - Tour and Travels Agency </title>
    <meta name="description"
        content="Travel Leads - Find World Travel Guide, Tour Packages, Hotels Directory, Online details of Travel Agents and Tour Operators, Complete Tour and Travel Solutions.">
    <meta name="keywords"
        content="tour travel world,travel guide,tour packages,travel agents directory,hotels directory,tour operators,hotel deals">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset($fevicon->value ?? '') }}" type="image/gif" sizes="20x20">

    <link rel="stylesheet" href="{{ asset('web/assets/css/select2.min.css') }}">

    <link rel="stylesheet" href="{{ asset('web/assets/css/jquery.fancybox.min.css') }}">

    <link href='{{ asset('web/assets/css/boxicons.min.css') }}' rel='stylesheet'>

    <link rel="stylesheet" href="{{ asset('web/assets/css/swiper-bundle.min.css') }}">

    <link rel="stylesheet" href="{{ asset('web/assets/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('web/assets/css/animate.min.css') }}">

    <link rel="stylesheet" href="{{ asset('web/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('web/assets/css/cta.css') }}">
    <link rel="stylesheet" href="{{ asset('web/assets/css/responsive.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />

    <meta name="facebook-domain-verification" content="xiy8pii3xshpvgfiiba9d8ozbvp2x9" />
    <!-- Meta Pixel Code -->
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            '../connect.facebook.net/en_US/fbevents.js');
        fbq('init', '601381278576225');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=601381278576225&amp;ev=PageView&amp;noscript=1" /></noscript>
    <!-- End Meta Pixel Code -->

    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                '../www.googletagmanager.com/gtm5445.html?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-MHMRML8F');
    </script>
    <!-- End Google Tag Manager -->

    @yield('css')
</head>


<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MHMRML8F" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    @yield('topBar')

    @include('web.app.includes.header')

    @yield('content')

    @include('web.app.includes.footer')

    <script>
        // Get the elements for toggling the menu
        var toggleMenuElements = document.querySelectorAll('.toggle-menu');

        // Loop through each toggle menu element and attach a click event listener
        toggleMenuElements.forEach(function(element) {
            element.addEventListener('click', function() {
                // Find the closest parent li element
                var parentLi = this.closest('.has-child-menu');
                // Toggle the class to show/hide the submenu
                parentLi.classList.toggle('active');
            });
        });
    </script>
    <script src="{{ asset('web/assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/chain_fade.js') }}"></script>
    <script src="{{ asset('web/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/jquery.fancybox.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/jquery-ui.js') }}"></script>

    <script src="{{ asset('web/assets/js/main.js') }}"></script>

    @yield('javascript')
</body>


<!-- Mirrored from www.travelleads.in/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 01 Feb 2025 08:38:13 GMT -->

</html>
