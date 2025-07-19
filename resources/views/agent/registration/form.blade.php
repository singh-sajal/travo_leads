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
    <title>Signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-light d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 bg-white p-4 rounded-3 shadow border">
                <div class="text-center mb-4">
                    <img src="{{ asset($logo->value) }}" alt="Logo" class="mb-3" style="max-width: 100px;">
                    <h4 class="mt-3">Register</h4>
                </div>

                @if (session('success'))
                    <div class="alert alert-{{ session('success') }} alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <!-- Alerts -->
                {{-- <div class="d-flex align-items-center">
                    <!-- Success Alert -->
                    @if (session('success'))
                        <div id="success-alert" class="alert alert-success alert-dismissible fade show me-3 mb-0"
                            style="min-width: 300px;" role="alert">
                            <strong>Success!</strong> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Failure Alert -->
                    @if (session('failure'))
                        <div id="failure-alert" class="alert alert-danger alert-dismissible fade show mb-0"
                            style="min-width: 300px;" role="alert">
                            <strong>Error!</strong> {{ session('failure') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                </div> --}}

                <form action="{{ route('agent.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            id="name" value="{{ old('name') }}" placeholder="Enter your full name">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                            id="email" value="{{ old('email') }}" placeholder="Enter your email">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Mobile Number</label>
                        <div class="input-group">
                            <span class="input-group-text bg-danger text-white">+91</span>
                            <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                name="phone" id="phone" value="{{ old('phone') }}" placeholder="Mobile Number*">
                        </div>
                        @error('phone')
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

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation"
                            id="password_confirmation" placeholder="Re-enter your password">
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="termsCheck" name="check">
                        <label class="form-check-label" for="termsCheck">
                            I agree to the <a href="#" class="text-success">Terms of Use</a> &
                            <a href="#" class="text-success">Privacy Policy</a>
                        </label>
                    </div>

                    <button id="continueBtn" class="btn btn-danger w-100" type="submit" disabled>Continue</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.getElementById("termsCheck").addEventListener("change", function() {
            document.getElementById("continueBtn").disabled = !this.checked;
        });

        document.getElementById("password_confirmation").addEventListener("input", function() {
            const password = document.getElementById("password").value;
            const confirmPassword = this.value;
            if (password !== confirmPassword) {
                this.setCustomValidity("Passwords do not match!");
            } else {
                this.setCustomValidity("");
            }
        });
    </script>
</body>
</html>
