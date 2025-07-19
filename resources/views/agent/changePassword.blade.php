@extends('agent.app.app')
@section('title', 'Change Password')
@section('page-title', 'Change Password')
@section('css')

@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-md">
            <div class="">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('agent.updatePassword') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="password" class="form-label">
                                Password <span class="text-danger">( Required )</span>
                            </label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password" required>
                                <button type="button" class="btn btn-secondary toggle-password">
                                    <i class="fa fa-eye-slash"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">
                                Confirm Password <span class="text-danger">( Required )</span>
                            </label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" required>
                                <button type="button" class="btn btn-secondary toggle-password">
                                    <i class="fa fa-eye-slash"></i>
                                </button>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                CHANGE PASSWORD
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script>
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function() {
                let input = this.previousElementSibling;
                if (input.type === "password") {
                    input.type = "text";
                    this.innerHTML = '<i class="fa fa-eye"></i>';
                } else {
                    input.type = "password";
                    this.innerHTML = '<i class="fa fa-eye-slash"></i>';
                }
            });
        });
    </script>
@endsection
