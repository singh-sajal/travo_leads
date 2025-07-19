@extends('agent.app.app')
@section('title', 'Wallet')
@section('page-title', 'Wallet')
@section('css')
    <style>
        .credits-card {
            background: linear-gradient(to right, #002b6b, #006f5d);
            color: white;
            padding: 20px;
            border-radius: 12px;
            position: relative;
            overflow: hidden;
        }

        .credits-card .circle {
            position: absolute;
            top: -10px;
            right: -10px;
            width: 100px;
            height: 100px;
            background: #22c55e;
            border-radius: 50%;
        }

        .credits-card .refresh-btn {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            border-radius: 50%;
            padding: 8px 10px;
            margin-right: 5px;
        }

        .credits-card .refresh-btn i {
            color: white;
        }

        .btn-custom {
            background-color: #002b6b;
            color: white;
            border-radius: 12px;
            padding: 8px 16px;
            font-weight: bold;
        }

        /* Remove focus outline when clicking */
        .refresh-btn:focus,
        .btn-primary:focus,
        .btn-custom:focus {
            outline: none !important;
            box-shadow: none !important;
        }
    </style>
@endsection
@section('content')

    <div class="row">
        <div class="col-md">
            <div class="credits-card">
                <div class="circle"></div>
                <h5>My Credits</h5>
                <h2>0</h2>
                <button class="refresh-btn"><i class="fa fa-refresh"></i></button>
                <button class="btn btn-primary">Add Credits</button>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <h5>Transaction History</h5>
        <button class="btn btn-custom">All Payments</button>
    </div>
@endsection
@section('javascript')

@endsection
