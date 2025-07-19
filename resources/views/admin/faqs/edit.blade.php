@extends('admin.app.app')

@section('title', 'Edit FAQ')

@section('css')
<style>
    .faq-container {
        max-width: 1200px;
        margin: auto;
        padding: 30px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    .required::after {
        content: " *";
        color: red;
    }
</style>
@endsection

@section('content')
<div class="container mt-4">
    <div class="faq-container">
        <h2 class="text-center mb-4">Edit FAQ</h2>

        <form action="{{ route('admin.faqs.update', $faq->uuid) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Question --}}
            <div class="mb-3">
                <label for="question" class="form-label required">Question</label>
                <input type="text" class="form-control" id="question" name="question" required
                    value="{{ old('question', $faq->question) }}">
                @error('question')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            {{-- Answer --}}
            <div class="mb-3">
                <label for="answer" class="form-label required">Answer</label>
                <textarea class="form-control" id="answer" name="answer" rows="5" required>{{ old('answer', $faq->answer) }}</textarea>
                @error('answer')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            {{-- Status (Uncomment if needed) --}}
            {{-- <div class="mb-3">
                <label for="status" class="form-label required">Status</label>
                <select class="form-control" id="status" name="status">
                    <option value="1" {{ old('status', $faq->status) ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ !old('status', $faq->status) ? 'selected' : '' }}>Inactive</option>
                </select>
            </div> --}}

            <div class="col-12 d-flex justify-content-end mb-3">
                <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Faq</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('javascripts')
@endsection
