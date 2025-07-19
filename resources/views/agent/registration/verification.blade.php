<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Verification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <script></script>
</head>

<body>
    <!-- Alerts -->
    <div class="d-flex align-items-center justify-content-end">
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
    </div>
    <div class="bg-light d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 bg-white p-4 rounded-3 shadow border">
                    <h4 class="text-center mb-4">Verify Your Details</h4>

                    <form action="{{ route('agent.verifyDetails') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Phone Verification Section -->
                        <div class="mb-3">
                            <label class="form-label">Mobile Number</label>
                            <div class="input-group" id="phoneVerification"> <!-- Added ID -->
                                <input type="text" class="form-control" name="phone" value="{{ $agent->phone }}" readonly>
                                @if ($agent->phone_verified == 1)
                                    <i class="fa-solid fa-check text-success fs-4 mt-2 ms-2"></i>
                                @else
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#otpModal" onclick="sendOTP('Whatsapp')">Send OTP</button>
                                @endif
                            </div>
                        </div>

                        <!-- Email Verification Section -->
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <div class="input-group" id="emailVerification"> <!-- Added ID -->
                                <input type="text" class="form-control" name="email" value="{{ $agent->email }}" readonly>
                                @if ($agent->email_verified == 1)
                                    <i class="fa-solid fa-check text-success fs-4 mt-2 ms-2"></i>
                                @else
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#otpModal" onclick="sendOTP('email')">Send OTP</button>
                                @endif
                            </div>
                        </div>


                        <!-- Aadhaar Front Image -->
                        <div class="mb-3">
                            <label class="form-label">Aadhaar Card (Front)</label>
                            <input type="file" class="form-control" name="aadhaar_front" accept="image/*" required>
                        </div>

                        <!-- Aadhaar Back Image -->
                        <div class="mb-3">
                            <label class="form-label">Aadhaar Card (Back)</label>
                            <input type="file" class="form-control" name="aadhaar_back" accept="image/*" required>
                        </div>

                        <!-- PAN Card Image -->
                        <div class="mb-3">
                            <label class="form-label">PAN Card</label>
                            <input type="file" class="form-control" name="pan_card" accept="image/*" required>
                        </div>

                        <button type="submit" class="btn btn-danger w-100" disabled>Submit Verification</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- OTP Modal -->
        <div class="modal fade" id="otpModal" tabindex="-1" aria-labelledby="otpModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="otpModalLabel">Enter OTP</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="otpForm" action="{{ route('agent.verifyOtp') }}" method="POST">
                            @csrf
                            <input type="hidden" name="otp_type" id="otpType">
                            <div class="mb-3">
                                <label class="form-label">Enter OTP</label>
                                <input type="text" class="form-control" name="otp" id="otp"
                                    placeholder="Enter OTP" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Verify OTP</button>
                        </form>
                        <hr>
                        <button id="resendOtpBtn" class="btn btn-secondary w-100" disabled onclick="resendOTP()">
                            Resend OTP (<span id="countdown">30</span> sec)
                        </button>
                    </div>
                </div>
            </div>
            {{-- JS for Modal handling --}}
            <script>
                document.getElementById("otpForm").addEventListener("submit", function(event) {
                    event.preventDefault(); // Prevent default form submission

                    let formData = new FormData(this);
                    let submitButton = this.querySelector("button[type='submit']");
                    submitButton.disabled = true; // Disable button while processing

                    fetch(this.action, {
                            method: "POST",
                            headers: {
                                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: formData
                        })
                        .then(response => response.json()) // Parse JSON response
                        .then(data => {
                            if (data.status === "success") {
                                alert(data.message); // Show success message
                                closeModal(); // Close the modal
                            } else {
                                alert(data.message); // Show error message
                            }
                        })
                        .catch(error => {
                            console.error("Error:", error);
                            alert("Something went wrong!");
                        })
                        .finally(() => {
                            submitButton.disabled = false; // Re-enable button after request
                        });
                });

                // Function to close the Bootstrap modal properly
                function closeModal() {
                    let modal = document.getElementById("otpModal");
                    let modalInstance = bootstrap.Modal.getInstance(modal);
                    modalInstance.hide(); // Close the modal
                }
            </script>
        </div>
    </div>
    {{-- JS for OTP handlng --}}
    <script>
        let countdown;

        function sendOTP(type) {
            document.getElementById('otpType').value = type;

            // Get email and phone number from input fields
            let email = "{{ $agent->email }}"; // Or document.querySelector("#emailInput").value
            let phone = "{{ $agent->phone }}"; // Or document.querySelector("#phoneInput").value

            // Prepare data based on OTP type
            let data = {
                otp_type: type
            };
            if (type === 'email') {
                data.email = email;
            } else {
                data.phone = phone;
            }

            fetch("{{ route('agent.sendOtp') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify(data) // Send email/phone with type
                })
                .then(response => response.json())
                .then(data => {
                    if (data.message === 'OTP Sent') {
                        alert("OTP has been sent to your " + type);
                        startResendTimer();
                    } else {
                        alert("Failed to send OTP. Please try again.");
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    alert("Something went wrong!");
                });
        }


        function startResendTimer() {
            let timer = 30;
            let resendButton = document.getElementById("resendOtpBtn");
            let countdownDisplay = document.getElementById("countdown");

            resendButton.disabled = true;
            countdownDisplay.innerText = timer;

            countdown = setInterval(() => {
                timer--;
                countdownDisplay.innerText = timer;

                if (timer <= 0) {
                    clearInterval(countdown);
                    resendButton.disabled = false;
                    resendButton.innerText = "Resend OTP";
                }
            }, 1000);
        }


        function resendOTP() {
            let otpType = document.getElementById("otpType").value;
            sendOTP(otpType);
        }
    </script>

    {{-- jS for check status --}}
    <script>
        function checkVerificationStatus() {
            fetch("{{ route('agent.checkVerificationStatus') }}", {
                    method: "GET",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                        "Content-Type": "application/json"
                    }
                })
                .then(response => response.json())
                .then(data => {
                    let phoneHTML = `
                                <input type="text" class="form-control" name="phone" value="{{ $agent->phone }}" readonly>
                    `;

                    if (data.phone_verified) {
                        phoneHTML += '<i class="fa-solid fa-check text-success fs-4 mt-2"></i>';
                    } else {
                        phoneHTML +=
                            `<button type="button" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#otpModal" onclick="sendOTP('Whatsapp')">Send OTP</button>`;
                    }
                    document.getElementById("phoneVerification").innerHTML = phoneHTML;

                    let emailHTML = `
                            <input type="text" class="form-control" name="email" value="{{ $agent->email }}" readonly>

                    `;

                    if (data.email_verified) {
                        emailHTML += '<i class="fa-solid fa-check text-success fs-4 mt-2 ms-2"></i>';
                    } else {
                        emailHTML += `
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#otpModal" onclick="sendOTP('email')">Send OTP</button>
                        `;
                    }
                    document.getElementById("emailVerification").innerHTML = emailHTML;
                })
                .catch(error => console.error("Error checking verification status:", error));
        }

        // Check verification status every 5 seconds
        setInterval(checkVerificationStatus, 5000);
    </script>

    <script>
        function checkVerificationCompletion() {
            let phoneVerified = document.querySelector("#phoneVerification i.fa-check") !== null;
            let emailVerified = document.querySelector("#emailVerification i.fa-check") !== null;

            let submitButton = document.querySelector("button[type='submit']");

            if (phoneVerified && emailVerified) {
                submitButton.disabled = false; // Enable button
            } else {
                submitButton.disabled = true; // Disable button
            }
        }

        // Run the function initially to check the status on page load
        checkVerificationCompletion();

        // Re-run the function whenever verification status changes
        setInterval(checkVerificationCompletion, 2000);
    </script>



</body>

</html>
