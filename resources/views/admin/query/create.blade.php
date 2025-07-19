@extends('admin.app.app')

@section('title', 'Queries')

@section('css')
    <style>
        .form-container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="form-container">
            <h2 class="mb-4 text-center">Submit Query</h2>
            <form action="{{ route('admin.query.store') }}" method="POST">
                @csrf
                <div class="row d-flex align-item-center">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name"
                            value="{{ old('name') ?? ($query->name ?? '') }}">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email"
                            value="{{ old('email') ?? ($query->email ?? '') }}">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row d-flex align-item-center">
                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" name="phone" id="phone" maxlength="10"
                            value="{{ old('phone') ?? ($query->phone ?? '') }}">
                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control" name="city" id="city"
                            value="{{ old('city') ?? ($query->city ?? '') }}">
                        @error('city')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- NEW FIELDS START HERE --}}
                <div class="row d-flex align-item-center">
                    <div class="col-md-6 mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select class="form-control" name="type" id="type" onchange="filterDestinations()">
                            <option value="">Select Type</option>
                            <option value="domestic">Domestic</option>
                            <option value="international">International</option>
                        </select>
                        @error('type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="destination_id" class="form-label">Destination</label>
                        <select class="form-control" name="destination_id" id="destination_id" onchange="loadPackages()">
                            <option value="">Select Destination</option>
                            @foreach ($destinations as $destination)
                                <option value="{{ $destination->id }}" data-type="{{ $destination->type }}">
                                    {{ $destination->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('destination_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row d-flex align-item-center">
                    <div class="col-md-6 mb-3">
                        <label for="package_id" class="form-label">Package</label>
                        <select class="form-control" name="package_id" id="package_id">
                            <option value="">Select Package</option>
                            {{-- Populated dynamically via JS --}}
                        </select>
                        @error('package_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="number_of_tourists" class="form-label">Number of Tourists</label>
                        <input type="number" class="form-control" name="number_of_tourists" id="number_of_tourists"
                            min="1">
                        @error('number_of_tourists')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="expected_date" class="form-label">Expected Date</label>
                        <input type="date" class="form-control" name="expected_date" id="expected_date">
                        @error('expected_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </form>


        </div>
    </div>
@endsection

@section('javascripts')
    <script>
        function loadPackages() {
            const destinationId = document.getElementById('destination_id').value;
            const packageSelect = document.getElementById('package_id');

            if (!destinationId) {
                packageSelect.innerHTML = '<option value="">Select Package</option>';
                return;
            }

            fetch(`/api/packages/by-destination/${destinationId}`)
                .then(response => response.json())
                .then(packages => {
                    let options = '<option value="">Select Package</option>';
                    packages.forEach(pkg => {
                        options += `<option value="${pkg.id}">
                        ${pkg.name} - ₹${pkg.price} (${pkg.days}D/${pkg.nights}N)
                    </option>`;
                    });
                    packageSelect.innerHTML = options;
                })
                .catch(error => {
                    console.error('Error loading packages:', error);
                    packageSelect.innerHTML = '<option value="">Error loading packages</option>';
                });
        }
    </script>


@endsection
