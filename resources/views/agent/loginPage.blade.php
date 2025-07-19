@php
    use App\Models\Setting;

    $setting = Setting::where('key', 'logo')->orWhere('key', 'fevicon')->get();

    $logo = $setting->where('key', 'logo')->first();
    $fevicon = $setting->where('key', 'fevicon')->first();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        input:focus, textarea:focus, select:focus, button:focus {
            outline: none !important;
            box-shadow: none !important;
            border: 1px solid #cccccc !important; /*Change border color to red */
        }
    </style>

</head>

<body class="bg-light d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 bg-white p-4 rounded-3 shadow border">
                <div class="text-center mb-4">
                    <img src="{{ asset($logo->value) }}" alt="Logo" class="mb-3" style="max-width: 100px;">
                    <h4 id="login-heading" class="mt-3">Login with Phone Number</h4>
                </div>

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('agent.login') }}" method="POST" id="login-form" autocomplete="off">
                    @csrf

                    <div class="mb-3" id="input-group">
                        <label for="phone" class="form-label" id="input-label">Mobile Number</label>
                        <div class="input-group" id="phone-group">
                            <span class="input-group-text bg-danger text-white">+91</span>
                            <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                name="phone" id="phone" value="{{ old('phone') }}"
                                placeholder="Enter mobile number">
                        </div>
                        <input type="email" class="form-control d-none @error('email') is-invalid @enderror"
                            name="email" id="email" value="{{ old('email') }}" placeholder="Enter email">
                        @error('phone')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        @error('login')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" id="password" placeholder="Enter your password">
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- <div class="text-end mt-3">
                        <button id="toggle-login" class="btn btn-link text-danger">Login with Email</button>
                    </div> --}}

                    <button class="btn btn-danger w-100" type="submit">Login</button>
                </form>

                <div class="text-end mt-3">
                    <button id="toggle-login" class="btn btn-link text-danger">Login with Email</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Used to switch the input to email address and back to phone number --}}
    <script>
        document.getElementById("toggle-login").addEventListener("click", function() {
            let isPhone = document.getElementById("phone").classList.contains("d-none");

            if (isPhone) {
                // Switch back to Phone Login
                document.getElementById("login-heading").innerText = "Login with Phone Number";
                document.getElementById("input-label").innerText = "Mobile Number";
                document.getElementById("phone-group").classList.remove("d-none");
                document.getElementById("phone").classList.remove("d-none");
                document.getElementById("phone").setAttribute("name", "phone");
                document.getElementById("email").setAttribute("name", "");
                document.getElementById("email").classList.add("d-none");
                document.getElementById("toggle-login").innerText = "Login with Email";
                label.setAttribute("for", "email");
            } else {
                // Switch to Email Login
                document.getElementById("login-heading").innerText = "Login with Email";
                document.getElementById("input-label").innerText = "Email Address";
                document.getElementById("phone-group").classList.add("d-none");
                document.getElementById("phone").classList.add("d-none");
                document.getElementById("phone").setAttribute("name", "");
                document.getElementById("email").setAttribute("name", "email");
                document.getElementById("email").classList.remove("d-none");
                document.getElementById("toggle-login").innerText = "Login with Phone Number";
            }
        });
    </script>


</body>

</html>
