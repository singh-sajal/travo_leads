@extends('admin.app.app')
@section('page-title')
    {{-- 'Welcome back, {{ Auth::user()->name }} 👋 --}}
@endsection

@section('content')
<div class="container">
    <h2 class=" mb-4">Admin Dashboard</h2>

    <div class="row">
        <!-- Banner Count -->
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Banners</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $bannerCount }}</h5>
                    <p class="card-text">Total Banners</p>
                </div>
            </div>
        </div>

        <!-- Destination Count -->
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Destinations</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $destinationCount }}</h5>
                    <p class="card-text">Total Destinations</p>
                </div>
            </div>
        </div>

        <!-- Package Count -->
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">Packages</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $packageCount }}</h5>
                    <p class="card-text">Total Packages</p>
                </div>
            </div>
        </div>

        <!-- Query (Leads) Count -->
        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-header">Queries</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $queryCount }}</h5>
                    <p class="card-text">Total Leads</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

