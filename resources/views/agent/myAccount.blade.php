@extends('agent.app.app')
@section('title', 'Profile')
@section('page-title', 'Profile')
@section('css')
    <style>
        .info-icon {
            border-radius: 25% !important;
        }

        .info-icon i {
            font-size: 20px
        }
    </style>
@endsection
@section('content')

    <a href="{{ route('agent.companyInfo') }}" class="text-dark text-decoration-none">
        <div class="info-card d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <div class="info-icon"><i class="fa-solid fa-circle-info"></i></div>
                <span>Company Info</span>
            </div>
            <i class="fa-solid fa-angle-right"></i>
        </div>
    </a>

    <a href="{{ route('agent.personalDetails') }}" class="text-dark text-decoration-none">
        <div class="info-card d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <div class="info-icon"><i class="fa-solid fa-person"></i></div>
                <span>Personal Details</span>
            </div>
            <i class="fa-solid fa-angle-right"></i>
        </div>
    </a>

    <a href="#" class="text-dark text-decoration-none">
        <div class="info-card d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <div class="info-icon"><i class="fa-solid fa-file-lines"></i></div>
                <span>KYC Status</span>
                <span class="badge bg-danger ms-2">Pending</span>
            </div>
            <i class="fa-solid fa-angle-right"></i>
        </div>
    </a>

    <a href="{{ route('agent.changePassword') }}" class="text-dark text-decoration-none">
        <div class="info-card d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <div class="info-icon"><i class="fa-solid fa-lock"></i></div>
                <span>Change Password</span>
            </div>
            <i class="fa-solid fa-angle-right"></i>
        </div>
    </a>

    <a href="{{ route('agent.wallet') }}" class="text-dark text-decoration-none">
        <div class="info-card d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <div class="info-icon"><i class="fa-solid fa-wallet"></i></div>
                <span>My Wallet</span>
            </div>
            <i class="fa-solid fa-angle-right"></i>
        </div>
    </a>

    <a href="#" class="text-dark text-decoration-none">
        <div class="info-card d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <div class="info-icon"><i class="fa-solid fa-file-invoice"></i></div>
                <span>Payments & Invoices</span>
            </div>
            <i class="fa-solid fa-angle-right"></i>
        </div>
    </a>

    <a href="{{ route('agent.analyticsAndReport') }}" class="text-dark text-decoration-none">
        <div class="info-card d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <div class="info-icon"><i class="fa-solid fa-chart-pie"></i></div>
                <span>Analytics & Report</span>
            </div>
            <i class="fa-solid fa-angle-right"></i>
        </div>
    </a>

    <a href="{{ route('agent.logout') }}" class="text-dark text-decoration-none">
        <div class="info-card d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <div class="info-icon"><i class="fa-solid fa-arrow-right-from-bracket"></i></div>
                <span style="color: #d9534f" class="fw-bold">Logout</span>
            </div>
            <i class="fa-solid fa-angle-right"></i>
        </div>
    </a>

    <a href="{{ route('agent.support') }}" class="text-dark text-decoration-none">
        <div class="info-card d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <div class="info-icon"><i class="fa-solid fa-headset"></i></div>
                <span>Support</span>
            </div>
            <i class="fa-solid fa-angle-right"></i>
        </div>
    </a>


@endsection
@section('javascript')

@endsection
