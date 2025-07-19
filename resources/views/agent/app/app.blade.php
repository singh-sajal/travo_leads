<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


    <style>
        .icon {
            font-size: 50px;
        }

        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background: #fff;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
            padding: 10px 0;
            display: flex;
            justify-content: space-around;
        }

        .bottom-nav .nav-item {
            text-align: center;
            flex-grow: 1;
            cursor: pointer;
        }

        .bottom-nav .nav-item a {
            color: black;
            text-decoration: none;
        }

        .bottom-nav .nav-item.active a {
            color: #d63384;
            font-weight: bold;
        }

        input:focus,
        textarea:focus,
        select:focus,
        button:focus {
            outline: none !important;
            box-shadow: none !important;
            border: 1px solid #cccccc !important;
        }
    </style>

    @if (request()->routeIs('agent.home'))
    @else
        <style>
            body {
                font-family: 'Poppins', sans-serif;
                background-color: #f9f9f9;
                margin: 0;
                padding: 20px;
            }

            .container {
                max-width: 600px;
                margin: auto;
                background: white;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            }

            .header {
                display: flex;
                align-items: center;
                justify-content: space-between;
            }

            .back-btn {
                background: #f3f3f3;
                border: none;
                padding: 8px 12px;
                border-radius: 50%;
                cursor: pointer;
            }

            .credits {
                background: #d9534f;
                color: white;
                padding: 5px 10px;
                border-radius: 20px;
                font-size: 14px;
            }

            .lead-card {
                padding: 15px;
                background: white;
                border-radius: 8px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                margin-top: 10px;
                position: relative;
            }

            .lead-card .badge {
                position: absolute;
                top: -10px;
                left: 10px;
                background: black;
                color: white;
                padding: 5px 8px;
                border-radius: 4px;
                font-size: 12px;
            }

            .lead-info p {
                margin: 5px 0;
                font-size: 14px;
            }

            .lead-info p strong {
                color: #d9534f;
            }

            .buy-button {
                display: flex;
                align-items: center;
                justify-content: center;
                background: white;
                color: #d9534f;
                border: 2px solid #d9534f;
                padding: 10px;
                border-radius: 8px;
                cursor: pointer;
                margin-top: 10px;
                text-align: center;
            }

            .buy-button:hover {
                background: #d9534f;
                color: white;
            }

            .row {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin: 20px 0;
            }

            .filter-btn {
                background: #d9534f;
                color: white;
                border: none;
                padding: 8px 15px;
                border-radius: 20px;
                cursor: pointer;
                font-size: 14px;
                display: flex;
                align-items: center;
            }

            .bottom-sheet {
                position: fixed;
                bottom: -100%;
                left: 0;
                width: 100%;
                background: white;
                box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
                transition: bottom 0.3s ease-in-out;
                padding: 20px;
            }

            .bottom-sheet.active {
                bottom: 0;
            }

            .accordion {
                background: #f1f1f1;
                cursor: pointer;
                padding: 10px;
                width: 100%;
                border: none;
                text-align: left;
                outline: none;
                font-size: 16px;
                transition: 0.4s;
                margin-bottom: 5px;
            }

            .accordion-content {
                display: none;
                padding: 10px;
                background: white;
                border: 1px solid #ccc;
                margin-bottom: 5px;
            }

            .accordion.active+.accordion-content {
                display: block;
            }

            .info-card {
                display: flex;
                align-items: center;
                padding: 10px;
                border-bottom: 1px solid #ddd;
                cursor: pointer;
            }

            .info-card:hover {
                background: #f9f9f9;
            }

            .info-icon {
                background: #d9534f;
                color: white;
                padding: 10px;
                border-radius: 50%;
                margin-right: 10px;
            }
        </style>
    @endif

    {{-- for session alerts --}}
    <style>
        .session-alert {
            position: absolute;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0, 0, 0, 0.7);
            /* Semi-transparent black */
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            z-index: 1000;
            opacity: 1;
            transition: opacity 1s ease-in-out;
        }
    </style>
    @yield('css')
</head>

<body>
    @php
        use Illuminate\Support\Facades\Auth;
        $agent = Auth::guard('agent')->user();
        $balance = $agent->getFinalBalance();
    @endphp
    <div class="container my-3">
        {{-- Dynamic Header --}}
        @if (request()->routeIs('agent.home'))
            <div class="d-flex justify-content-between align-items-center ">
                <div class="d-flex align-items-center">
                    <!-- <img src="logo.png" alt="Logo" width="50" height="50"> -->
                    <h4 class="ms-2">TRAVO Leads</h4>
                </div>
                <a href="{{ route('agent.wallet') }}"
                    class="text-light fw-bold d-flex align-items-center text-decoration-none btn btn-success">
                    <i class="fa fa-wallet me-1"></i><span id="balance-display"> {{ $balance}}</span>
                </a>
            </div>
        @else
            <div class="header">

                <button class="back-btn" style="color: black;" onclick="window.history.back()"><i
                        class="fa-solid fa-arrow-left"></i></button>
                @if (session('success'))
                    <div id="session-message" class="session-alert">
                        {{ session('message') }}
                    </div>
                @endif
                @if (session('error'))
                    <div id="session-message" class="session-alert">
                        {{ session('message') }}
                    </div>
                @endif
                @if (session('failure'))
                    <div id="session-message" class="session-alert">
                        {{ session('message') }}
                    </div>
                @endif


                <h2>@yield('page-title')</h2>
                <a href="{{ route('agent.wallet') }}"
                    class="text-light fw-bold d-flex align-items-center text-decoration-none btn btn-success">
                    <i class="fa fa-wallet me-1"></i><span id="balance-display">{{ $balance }}</span>

                </a>
            </div>
        @endif
 
        @yield('content')
    </div>



    @include('agent.app.includes.footer')


    {{-- alerts --}}
    <script>
        // Hide session message after 4 seconds
        setTimeout(function() {
            let messageBox = document.getElementById("session-message");
            if (messageBox) {
                messageBox.style.opacity = "0"; // Fade out
                setTimeout(() => messageBox.remove(), 1000); // Remove after transition
            }
        }, 4000);
    </script>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <!-- Bootstrap JS Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @yield('javascript')

</body>

</html>
