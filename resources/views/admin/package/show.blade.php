@extends('admin.app.app')
@section('title', 'Vendor')
{{-- @section('page-title', 'Vendor Details') --}}
@section('css')

@endsection
@section('content')
    {{-- <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h3>Package Details</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Name</th>
                        <td>{{ $package->name }}</td>
                    </tr>
                    <tr>
                        <th>Destination</th>
                        <td>{{ $package->destination->title }}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>{{ $package->description }}</td>
                    </tr>
                    <tr>
                        <th>Price</th>
                        <td>&#8377;{{ number_format($package->price, 2) }}</td>
                    </tr>
                    <tr>
                        <th>Duration</th>
                        <td>{{ $package->duration_days }} Days / {{ $package->duration_nights }} Nights</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>{!! $package->status ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>' !!}</td>
                    </tr>
                </table>

                <h5 class="mt-4">Package Images</h5>
                <div class="row">
                    @foreach($package->images as $image)
                        <div class="col-md-3 mb-3">
                            <img src="{{ asset($image->url) }}" class="img-fluid rounded" alt="Package Image">
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between">
                <a href="{{ route('admin.package.index') }}" class="btn btn-secondary me-1">Back</a>
                <a href="{{ route('admin.package.edit', $package->uuid) }}" class="btn btn-primary">Edit</a>
            </div>
        </div>
    </div> --}}


    <div class="container">
        <h1 class="mb-4">Package Details</h1>
        <div class="card">
            <img src="{{ asset($package->image) }}" class="card-img-top" alt="{{ $package->name }}">
            <div class="card-body">
                <h3 class="card-title">{{ $package->name }}</h3>
                <p class="card-text"><strong>Destination:</strong> {{ $package->destination->title }}</p>
                <p class="card-text"><strong>Description:</strong> {{ $package->description }}</p>
                <p class="card-text"><strong>Price:</strong> ₹{{ number_format($package->price, 2) }}</p>
                <p class="card-text"><strong>Duration:</strong> {{ $package->duration_days }} Days / {{ $package->duration_nights }} Nights</p>
                <a href="{{ route('admin.package.index') }}" class="btn btn-primary">Back to Packages</a>
            </div>
        </div>
    </div>
@endsection
@section('javascripts')
    <script src="{{ asset('admin/assets/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('admin/assets/js/saarni.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const datatable = new SaarniJs('DataTable', "{{ route('admin.package.index') }}", 'User List');
            // const datatable = new SaarniJs();
            document.getElementById('reloadDatatable').addEventListener('click', (e) => {
                // datatable.render(datatable.rootUrl);
                datatable.ajaxReload();
            })
        });
    </script>
@endsection
