@extends('agent.app.app')
@section('title', 'Home')
@section('css')
    <style>
        .card {
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .icon {
            font-size: 50px;
        }

        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background: #fff;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
            padding: 10px 0;
            display: flex;
            justify-content: space-around;
        }

        .bottom-nav .nav-item {
            text-align: center;
            flex-grow: 1;
            cursor: pointer;
        }

        .bottom-nav .nav-item.active {
            color: #d63384;
            font-weight: bold;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        #container {
            width: 400px !important;
            margin-top: 50px !important;
            text-align: left !important;
            padding-bottom: 80px;
        }

        .container {
            padding-bottom: 80px;
        }


        #card {
            border-radius: 10px;
            padding: 20px;
        }

        .btn-custom {
            background-color: #d95375;
            border: none;
            color: white;
            width: 100%;
        }

        .btn-custom:disabled {
            background-color: #d8a0a8;
        }
    </style>
@endsection
@section('content')


    <div id="home" class="tab-content active">
        <div class="row mt-4">
            <div class="col-6 mt-4">
                <div class="card">
                    <div class="icon">🛒</div>
                    <h5>Buy Leads</h5>
                    <p>Browser Fresh Leads</p>
                </div>
            </div>
            <div class="col-6 mt-4">
                <div class="card">
                    <div class="icon">👨s</div>
                    <h5>My Leads</h5>
                    <p>View / Connect Leads</p>
                </div>
            </div>
            <div class="col-6 mt-4">
                <div class="card">
                    <div class="icon">💵</div>
                    <h5>Billing & Payments</h5>
                    <p>Transactions & Invoice</p>
                </div>
            </div>
            <div class="col-6 mt-4">
                <div class="card">
                    <div class="icon">📊</div>
                    <h5>Analytics & Report</h5>
                    <p>Leads & Spents Report</p>
                </div>
            </div>
            <div class="col-6 mt-4">
                <div class="card">
                    <div class="icon">❓</div>
                    <h5>FAQs</h5>
                    <p>Question & Answer</p>
                </div>
            </div>

            <div class="col-6 mt-4">
                <div class="card">
                    <div class="icon">📞</div>
                    <h5>Help & Support</h5>
                    <p>Transactions & Invoice</p>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')

@endsection
