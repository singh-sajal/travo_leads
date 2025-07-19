@extends('agent.app.app')
@section('title', 'Personal Details')

@section('css')
<style>
    .profile-container {
        max-width: 600px;
        margin: auto;
        text-align: center;
        padding: 20px;
    }

    .profile-pic {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #ddd;
    }

    .edit-icon {
        position: absolute;
        bottom: 10px;
        right: 225px;
        width: 25px;
        height: 25px;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        cursor: pointer;
        font-size: 14px;
        /* transform: translate(50%, 50%); */
    }

    .edit-icon:hover {
        background: rgba(0, 0, 0, 0.9);
    }

    input[type="file"] {
        display: none;
    }

    .btn-primary {
        background-color: #04386c;
        border: none;
        font-size: 1.2rem;
        padding: 12px;
    }

    .form-label {
        font-weight: bold;
        text-align: left;
        display: block;
    }

    .form-control[readonly] {
        background-color: #e9ecef;
    }
</style>

{{-- header --}}
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
<div class="profile-container">
    <div class="profile-container position-relative">
        <img id="preview" class="profile-pic" src="{{ asset('agent/assets/images/pfp.jpeg') }}" alt="Profile Picture">
        <label for="fileInput" class="edit-icon">✏</label>
        <input type="file" id="fileInput" accept="image/*">
    </div>

    <form>
        <div class="mb-3 text-start">
            <label class="form-label">Full Name</label>
            <input type="text" class="form-control" placeholder="Enter full name">
        </div>
        <div class="mb-3 text-start">
            <label class="form-label">Mobile Number</label>
            <input type="text" class="form-control" value="9368567722" readonly>
        </div>
        <div class="mb-3 text-start">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" placeholder="Enter email">
        </div>
        <button type="submit" class="btn btn-primary w-100 mt-3">UPDATE PROFILE</button>
    </form>
</div>
@endsection

@section('javascript')
<script>
    const fileInput = document.getElementById('fileInput');
    const preview = document.getElementById('preview');
    const defaultImage = "{{ asset('agent/assets/images/pfp.jpeg') }}";

    fileInput.addEventListener('change', function(event) {
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        } else {
            preview.src = defaultImage; // Reset to default if no file is chosen
        }
    });
</script>
@endsection
