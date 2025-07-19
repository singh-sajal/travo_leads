@extends('admin.app.app')
@section('title', 'Vendor')
@section('page-title', 'Add New Vendor')
@section('css')

@endsection
@section('content')

    <form action="{{ route('admin.destination.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Type (Domestic / International) -->
        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <select class="form-select" id="type" name="type" required>
                <option value="domestic">Domestic</option>
                <option value="international">International</option>
            </select>
        </div>

        <!-- Title -->
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Enter Destination Title"
                required>
            @error('titile')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Image Upload -->
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
            @error('image')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Start Amount -->
        <div class="mb-3">
            <label for="start_amount" class="form-label">Start Amount (₹)</label>
            <input type="number" class="form-control" id="start_amount" name="start_amount"
                placeholder="Enter Starting Price" required>
        </div>



        <!-- Status (Active / Inactive) -->
        {{-- <div class="mb-3">
        <label class="form-label">Status</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" id="status_active" value="1" checked>
            <label class="form-check-label" for="status_active">Active</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" id="status_inactive" value="0">
            <label class="form-check-label" for="status_inactive">Inactive</label>
        </div>
    </div> --}}

        <!-- Is Featured -->
        {{-- <div class="mb-3 form-check">
        <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1">
        <label class="form-check-label" for="is_featured">Feature this Destination</label>
    </div> --}}

        <!-- Attributes (Optional) -->
        {{-- <div class="mb-3">
        <label for="attributes" class="form-label">Additional Attributes</label>
        <textarea class="form-control" id="attributes" name="attributes" rows="4" placeholder="Enter attributes (optional)"></textarea>
    </div> --}}

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Save Destination</button>
    </form>

@endsection
@section('javascripts')

@endsection
