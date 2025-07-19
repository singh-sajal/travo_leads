@extends('admin.app.app')
@section('title', 'Destination')
@section('css')
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h4>Edit {{ $destination->title }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.destination.update', $destination->uuid) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control"
                                value="{{ old('title', $destination->title) }}" required>
                        </div>

                        <div class="mb-3">
                            <label>Current Image</label>
                            <img src="{{ asset($destination->image) }}" class="img-fluid d-block" style="max-height: 200px">
                        </div>

                        <div class="mb-3">
                            <label>New Image (optional)</label>
                            <input type="file" name="image" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Starting Amount</label>
                            <input type="number" step="0.01" name="start_amount" class="form-control"
                                value="{{ old('start_amount', $destination->start_amount) }}" required>
                        </div>

                        <div class="mb-3">
                            <label>Type</label>
                            <select name="type" class="form-select" required>
                                <option value="domestic" {{ $destination->type === 'domestic' ? 'selected' : '' }}>Domestic
                                </option>
                                <option value="international"
                                    {{ $destination->type === 'international' ? 'selected' : '' }}>International</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Update Destination</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascripts')
    {{-- the below code is for the required validation for category dropdown --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categorySelect = document.getElementById('category');
            const categoryError = document.getElementById('category-error');

            categorySelect.addEventListener('change', function() {
                if (categorySelect.value) {
                    categoryError.textContent = ''; // Clear error if valid option is selected
                }
            });

            document.querySelector('form').addEventListener('submit', function(event) {
                if (!categorySelect.value) {
                    event.preventDefault(); // Prevent form submission
                    categoryError.textContent = 'Please select a category.';
                }
            });
        });
    </script>

@endsection
