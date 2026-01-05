@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-sm border-0">
            
            <div class="card-header bg-dark text-white text-center">
                <h4 class="mb-0 fw-semibold">Create Account</h4>
            </div>

            <div class="card-body p-4">
                <form id="registerForm" method="POST" action="{{ route('register') }}" novalidate>
                    @csrf

                    {{-- GLOBAL ERROR --}}
                    @if ($errors->any())
                        <div class="alert alert-danger small">
                            Please fix the errors below.
                        </div>
                    @endif

                    {{-- FULL NAME --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Full Name</label>
                        <input
                            type="text"
                            name="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') }}"
                            required
                            minlength="3"
                            placeholder="John Doe"
                        >
                        <div class="invalid-feedback">
                            Please enter your full name (minimum 3 characters).
                        </div>
                    </div>

                    {{-- EMAIL --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email Address</label>
                        <input
                            type="email"
                            name="email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') }}"
                            required
                            placeholder="example@email.com"
                        >
                        <div class="invalid-feedback">
                            Please enter a valid email address.
                        </div>
                    </div>

                    {{-- PASSWORD --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Password</label>
                        <input
                            type="password"
                            name="password"
                            class="form-control @error('password') is-invalid @enderror"
                            required
                            minlength="8"
                            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{8,}"
                        >
                        <div class="form-text small">
                            Minimum 8 characters, 1 uppercase, 1 lowercase, 1 number, 1 special character.
                        </div>
                        <div class="invalid-feedback">
                            Password does not meet security requirements.
                        </div>
                    </div>

                    {{-- CONFIRM PASSWORD --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Confirm Password</label>
                        <input
                            type="password"
                            name="password_confirmation"
                            class="form-control"
                            required
                        >
                        <div class="invalid-feedback">
                            Passwords do not match.
                        </div>
                    </div>

                    {{-- SUBMIT --}}
                    <button type="submit" class="btn btn-primary w-100">
                        Register
                    </button>

                    {{-- LOGIN LINK --}}
                    <div class="text-center mt-3">
                        <small>
                            Already have an account?
                            <a href="{{ route('login') }}">Login here</a>
                        </small>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
