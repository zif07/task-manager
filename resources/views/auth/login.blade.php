@extends('layouts.app')

@section('content')
<div class="row justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="col-md-5 col-lg-4">

        <div class="card shadow-sm border-0">
            <div class="card-header bg-dark text-white text-center">
                <h4 class="mb-0">Login</h4>
            </div>

            <div class="card-body p-4">
                <form method="POST" action="{{ route('login') }}" novalidate>
                    @csrf

                    {{-- ERROR MESSAGE --}}
                    @if($errors->any())
                        <div class="alert alert-danger text-center">
                            Invalid email or password
                        </div>
                    @endif

                    {{-- EMAIL --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email Address</label>
                        <input 
                            type="email"
                            name="email"
                            class="form-control"
                            placeholder="example@email.com"
                            value="{{ old('email') }}"
                            required
                        >
                    </div>

                    {{-- PASSWORD --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Password</label>
                        <input 
                            type="password"
                            name="password"
                            class="form-control"
                            placeholder="••••••••"
                            required
                        >
                    </div>

                    {{-- LOGIN BUTTON --}}
                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary">
                            Login
                        </button>
                    </div>

                    {{-- REGISTER LINK --}}
                    <div class="text-center">
                        <small>
                            Don’t have an account?
                            <a href="{{ route('register') }}" class="fw-semibold">
                                Register here
                            </a>
                        </small>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
