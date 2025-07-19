@extends('admin.app.app')
@section('title', 'Package')
{{-- @section('page-title', 'Add New Package') --}}
@section('css')
@endsection
@section('content')

    <div class="container mt-4">
        <div class="card shadow-lg p-4">
            <h2 class="mb-4 text-center">Create Package</h2>
            <form action="{{ route('admin.package.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="destination_id" class="form-label text-secondary required">Destination</label>
                        <select name="destination_id" id="destination_id" class="form-select">
                            <option value="">Select Destination</option>
                            @foreach ($destinations as $destination)
                                <option value="{{ $destination->id }}">{{ $destination->title }}</option>
                            @endforeach
                        </select>
                        @error('destination_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </div>
                    <div class="col-md-6">
                        <label for="name" class="form-label text-secondary required">Package Name</label>
                        <input type="text" name="name" id="name" class="form-control required"
                            placeholder="Enter package name" value="{{ old('name') ?? ($listing->name ?? '') }}">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <!-- Image Upload -->
                    <div class="col-md-6">
                        <label for="image" class="form-label text-secondary required">Image</label>
                        <input type="file" class="form-control required" id="image" name="image" accept="image/*"
                            required>
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="col-md-6">
                        <label for="price" class="form-label text-secondary required">Price</label>
                        <input type="text" name="price" id="price" class="form-control required"
                            placeholder="Enter package price" value="{{ old('price') ?? ($listing->price ?? '') }}">
                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="duration_days" class="form-label text-secondary required">Duration (Days)</label>
                        <input type="text" name="duration_days" id="duration_days" class="form-control  required"
                            placeholder="Enter duration in days"
                            value="{{ old('duration_days') ?? ($listing->duration_days ?? '') }}">
                        @error('duration_days')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="duration_nights" class="form-label text-secondary required">Duration (Nights)</label>
                        <input type="text" name="duration_nights" id="duration_nights" class="form-control required"
                            placeholder="Enter duration in nights"
                            value="{{ old('duration_nights') ?? ($listing->duration_nights ?? '') }}">
                        @error('duration_nights')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label text-secondary required">Description</label>
                    <textarea name="description" id="description" class="form-control required" placeholder="Enter package description">{{ old('description') ?? ($listing->description ?? '') }}</textarea>
                    @error('description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>


                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('javascripts')
@endsection
