@php
    use Illuminate\Support\Facades\Auth;
    $agent = Auth::guard('agent')->user();
    $balance = $agent->getFinalBalance();
@endphp
@extends('agent.app.app')
@section('title', 'Buy Leads')
@section('page_title', 'Buy Leads')

@section('css')

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
            height: auto;
        }

        .inner-container {
            /* height: 100%; */
            /* overflow-y: auto; */
            /* padding-bottom: 200px; adjust based on filter sheet height */

        }

        .lead-card {
            background: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin: 10px 0;
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

        /* Bottom Sheet */
        .bottom-sheet {
            position: fixed;
            bottom: -100%;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            max-width: 600px;
            background: white;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            transition: bottom 0.3s ease-in-out;
            padding: 20px;
            border-radius: 10px 10px 0 0;
            /* z-index: 9999; Add this line */

        }

        .bottom-sheet.active {
            bottom: 0;
        }

        .bottom-sheet .close-btn {
            position: absolute;
            top: 10px;
            right: 15px;
            background: #d9534f;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 16px;
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

        /* Style Search Input */
        .filter-input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            margin-top: 5px;
        }

        .filter-input:focus {
            border-color: #d9534f;
            outline: none;
            box-shadow: 0 0 5px rgba(217, 83, 79, 0.5);
        }
    </style>

    <style>
        .custom-checkbox {
            width: 20px;
            height: 20px;
            cursor: pointer;
        }
    </style>
@endsection

@section('content')

    <div class="inner-container">
        <div class="d-flex align-items-center justify-content-between my-3">
            <h3 class="m-0">All Leads</h3>
            <!-- Filter Button -->
            <button class="btn btn-danger p-2 rounded-circle" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">
                <i class="bi bi-funnel text-white"></i>
            </button>
        </div>

        @foreach ($leads as $lead)
            <div class="lead-card my-5">
                <span class="badge">{{ $lead->package->destination->type ?? 'NA' }}</span>

                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3>{{ $lead->name }}</h3>
                    </div>
                    <div>
                        <h5 class="btn btn-danger ms-3">{{ $lead->lead_value ?? '0' }}</h5>
                    </div>
                </div>
                <p><small>Lead Added on
                        {{ \Carbon\Carbon::parse($lead->created_at)->format('F j, Y \a\t g:i:s A') }}</small></p>
                <div class="lead-info">
                    <p><strong>Lead ID:</strong> #{{ $lead->id }}</p>
                    <p><strong>No. of Travellers:</strong> {{ $lead->no_of_persons }} adult(s)</p>
                    <p><strong>Customer Location:</strong> {{ $lead->pickup_location }}</p>
                    <p><strong>Destination:</strong> {{ $lead->package->destination->title ?? 'NA' }}</p>
                    <p><strong>Price:</strong> ₹{{ number_format($lead->package->price, 2) }}</p>
                    <p><strong>Travel Date / Time:</strong>
                        {{ \Carbon\Carbon::parse($lead->expected_date)->format('F j, Y') }}
                        ({{ $lead->package->duration_nights }}N {{ $lead->package->duration_days }}D trip)
                    </p>
                </div>


                @if ($balance >= 10)
                    <!-- Checkbox to enable the button -->
                    <div class="form-check my-3 d-flex align-items-center">
                        <input class="form-check-input custom-checkbox" type="checkbox"
                            id="leadCheckbox{{ $lead->id }}" onchange="toggleButton({{ $lead->id }})">
                        <label class="form-check-label ms-3" for="leadCheckbox{{ $lead->id }}">
                            Tick the box to buy this lead
                        </label>
                    </div>

                    <!-- Buy Lead Button -->
                    <div class="text-center">
                        <button type="button" class="btn btn-primary btn-lg px-4 py-2 rounded-pill shadow-sm"
                            id="buyButton{{ $lead->id }}" disabled
                            onclick="buyLead({{ $lead->id }}, '{{ $lead->lead_value ?? '0' }}')">
                            Buy Lead
                        </button>
                    </div>
                @else
                    <a href="{{ route('agent.wallet') }}">
                        <div class="text-center mt-3">
                            <div class="btn btn-danger">
                                Please recharge your wallet.. 😢
                            </div>
                        </div>
                    </a>
                @endif


            </div>
        @endforeach

        <!-- Offcanvas Bottom -->
        <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel"
            style="max-width: 550px; margin: auto; height:65vh; border-top-left-radius: 20px; border-top-right-radius: 20px; box-shadow: 0 -4px 15px rgba(0,0,0,0.1);">

            <div class="offcanvas-header border-bottom">
                <h5 class="mb-0" id="offcanvasBottomLabel">Filter Leads</h5>
                <button class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <div class="offcanvas-body small" style="overflow-y: auto;">
                <form method="GET" action="{{ route('agent.filterLeads') }}">

                    <div class="d-flex justify-content-between mb-3">
                        <a href="{{ route('agent.filterLeads') }}" class="btn btn-outline-secondary w-48">Clear Filters</a>
                        <button type="submit" class="btn btn-danger w-48">Apply Filters</button>
                    </div>

                    <!-- Filter By City -->
                    <div class="mb-3">
                        <button type="button" class="accordion">Filter By City</button>
                        <div class="accordion-content mt-2">
                            <input type="text" class="form-control" name="city" placeholder="Enter city">
                        </div>
                    </div>

                    <!-- Sort By -->
                    <div class="mb-3">
                        <button type="button" class="accordion">Sort By</button>
                        <div class="accordion-content mt-2">
                            <select class="form-select" name="sort">
                                <option value="latest">Latest</option>
                                <option value="oldest">Oldest</option>
                                <option value="high">Highest Lead Cost</option>
                                <option value="low">Lowest Lead Cost</option>
                            </select>
                        </div>
                    </div>

                    <!-- Filter By Type -->
                    <div class="mb-3">
                        <button type="button" class="accordion">Filter By Type</button>
                        <div class="accordion-content mt-2">
                            <select class="form-select" name="type">
                                <option value="">Select Type</option>
                                <option value="domestic">Domestic</option>
                                <option value="international">International</option>
                            </select>
                        </div>
                    </div>

                    <!-- Filter By Date -->
                    <div class="mb-3">
                        <button type="button" class="accordion">Filter By Date</button>
                        <div class="accordion-content mt-2">
                            <div class="d-flex justify-content-between">
                                <div class="me-2 w-50">
                                    <label class="form-label" for="start_date">From</label>
                                    <input type="date" class="form-control" name="start_date" id="start_date">
                                </div>
                                <div class="w-50">
                                    <label class="form-label" for="end_date">To</label>
                                    <input type="date" class="form-control" name="end_date" id="end_date">
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>




    </div>






@endsection

@section('javascript')

    {{-- Buying a new lead --}}
    <script>
        function toggleButton(leadId) {
            const checkbox = document.getElementById(`leadCheckbox${leadId}`);
            const button = document.getElementById(`buyButton${leadId}`);
            button.disabled = !checkbox.checked;
        }

        function buyLead(leadId, leadValue) {
            // if (!confirm("Are you sure you want to buy this lead?")) return;

            fetch("{{ route('agent.boughtLead') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        lead_id: leadId,
                        lead_value: leadValue
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Lead bought successfully!");
                        // Remove the lead card
                        const card = document.querySelector(`#buyButton${leadId}`).closest('.lead-card');
                        card.remove();
                    } else {
                        alert(data.message || "Something went wrong!");
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    alert("An error occurred while buying the lead.");
                });
        }
    </script>

    <script>
        document.querySelectorAll('.accordion').forEach(button => {
            button.addEventListener('click', () => {
                const content = button.nextElementSibling;
                content.style.display = content.style.display === 'block' ? 'none' : 'block';
            });
        });
    </script>



@endsection
