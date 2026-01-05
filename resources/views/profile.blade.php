@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-xl-5 col-lg-6 col-md-8">

        <div class="card shadow-sm border-0 rounded-4">
            
            {{-- Header --}}
            <div class="card-header bg-white border-0 pb-0">
                <h4 class="fw-semibold mb-0">My Profile</h4>
                <small class="text-muted">
                    View and update your personal information
                </small>
            </div>

            <div class="card-body pt-4">

                {{-- Success Message --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                {{-- Profile Summary --}}
                <div class="mb-4">
                    <div class="mb-2">
                        <div class="text-muted small">Full Name</div>
                        <div class="fw-semibold">
                            {{ Auth::user()->name }}
                        </div>
                    </div>

                    <div class="mb-2">
                        <div class="text-muted small">Email Address</div>
                        <div class="fw-semibold">
                            {{ Auth::user()->email }}
                        </div>
                    </div>

                    <div>
                        <div class="text-muted small">Role</div>
                        <span class="badge bg-secondary text-uppercase px-3 py-1">
                            {{ Auth::user()->role }}
                        </span>
                    </div>
                </div>

                <hr class="my-4">

                {{-- Update Profile --}}
                <h5 class="fw-semibold mb-3">Update Profile</h5>

                <form method="POST" action="{{ route('profile.update') }}" novalidate>
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-medium">
                            Full Name
                        </label>
                        <input
                            type="text"
                            name="name"
                            value="{{ old('name', Auth::user()->name) }}"
                            class="form-control @error('name') is-invalid @enderror"
                            required
                            minlength="3"
                            placeholder="Enter your full name"
                        >

                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-primary px-4">
                            Save Changes
                        </button>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>
@endsection

