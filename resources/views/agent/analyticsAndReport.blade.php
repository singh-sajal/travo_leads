@extends('agent.app.app')
@section('title', 'Analytics & Report')
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
    }

    .header {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .back-btn {
        background: #f3f3f3;
        border: none;
        padding: 8px 12px;
        border-radius: 50%;
        cursor: pointer;
    }

    .credits {
        background: #d9534f;
        color: white;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 14px;
    }

    .lead-card {
        padding: 15px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        margin-top: 10px;
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

    .lead-info p {
        margin: 5px 0;
        font-size: 14px;
    }

    .lead-info p strong {
        color: #d9534f;
    }

    .buy-button {
        display: flex;
        align-items: center;
        justify-content: center;
        background: white;
        color: #d9534f;
        border: 2px solid #d9534f;
        padding: 10px;
        border-radius: 8px;
        cursor: pointer;
        margin-top: 10px;
        text-align: center;
    }

    .buy-button:hover {
        background: #d9534f;
        color: white;
    }

    .row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 20px 0;
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

    .bottom-sheet {
        position: fixed;
        bottom: -100%;
        left: 0;
        width: 100%;
        background: white;
        box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
        transition: bottom 0.3s ease-in-out;
        padding: 20px;
    }

    .bottom-sheet.active {
        bottom: 0;
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

    .accordion.active+.accordion-content {
        display: block;
    }

    .info-card {
        display: flex;
        align-items: center;
        padding: 10px;
        border-bottom: 1px solid #ddd;
        cursor: pointer;
    }

    .info-card:hover {
        background: #f9f9f9;
    }

    .info-icon {
        background: #d9534f;
        color: white;
        padding: 10px;
        border-radius: 50%;
        margin-right: 10px;
    }
</style>
@endsection
@section('content')
@section('page-title','Analytics and Report')
    <div class="card mt-3">
        <div class="card-body">
            <div class="row text-center">
                <div class="col-6 border-end">
                    <h4 class="fw-bold">0</h4>
                    <p class="mb-0">Total Purchased Leads</p>
                </div>
                <div class="col-6">
                    <h4 class="fw-bold">0</h4>
                    <p class="mb-0">Tour Leads</p>
                </div>
            </div>
            <hr>
            <div class="row text-center">
                <div class="col-6 border-end">
                    <h4 class="fw-bold">0</h4>
                    <p class="mb-0">Cab Leads</p>
                </div>
                <div class="col-6">
                    <h4 class="fw-bold">0</h4>
                    <p class="mb-0">Total Spend</p>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')

@endsection
