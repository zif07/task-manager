@extends('layouts.app')

@section('content')
<div class="container text-center py-5">
    <h1 class="display-1 fw-bold text-secondary">404</h1>
    <h2 class="mb-3">Page Not Found</h2>
    <p class="lead text-muted mb-4">
        The page you are looking for might have been removed, renamed, or is temporarily unavailable.
    </p>

    <a href="{{ url('/') }}" class="btn btn-primary px-4">
        Go Home
    </a>
</div>
@endsection
