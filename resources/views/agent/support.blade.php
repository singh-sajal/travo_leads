@extends('agent.app.app')

@section('title', 'Support')
@section('page-title', 'Support')

@section('css')
    <style>
        .support-container {
            text-align: center;
            padding: 20px;
        }

        .support-icon {
            font-size: 60px;
            color: #002b6b;
            margin-bottom: 20px;
        }

        .support-btn {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: black;
            color: white;
            font-weight: bold;
            border: none;
            padding: 12px 20px;
            border-radius: 8px;
            width: 100%;
            max-width: 400px;
            margin: 10px auto;
            text-decoration: none;
        }

        .whatsapp-btn {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border: 2px solid #25D366;
            color: #25D366;
            font-weight: bold;
            padding: 12px 20px;
            border-radius: 8px;
            width: 100%;
            max-width: 400px;
            margin: 10px auto;
            text-decoration: none;
        }

        .whatsapp-btn .left-content {
            display: flex;
            align-items: center;
        }

        .whatsapp-btn .left-icon {
            font-size: 20px;
            margin-right: 10px;
        }

        .whatsapp-btn i {
            font-size: 18px;
        }
    </style>
@endsection

@section('content')
    <div class="support-container">
        <i class="fa fa-headset support-icon"></i>

        <a href="tel:+918062182339" class="support-btn">
            Call Support : +91 7060176049
            <i class="fa fa-angle-right"></i>
        </a>

        <a href="mailto:support@travelleads.in" class="support-btn">
            Email Support : support@tripleads.in
            <i class="fa fa-angle-right"></i>
        </a>

        <a href="https://wa.me/918062182339" class="whatsapp-btn">
            <span class="left-content">
                <i class="fa-brands fa-whatsapp left-icon"></i> Chat With Us On WhatsApp
            </span>
            <i class="fa fa-angle-right"></i>
        </a>
    </div>
@endsection
