@extends('layouts.app')

@section('content')
<div class="container text-center" style="padding: 100px 0;">
    <h1 class="display-1 fw-bold text-danger">403</h1>
    <h2 class="mb-4">Access Denied</h2>
    <p class="lead mb-5">
        Sorry, you do not have the required permissions to view this page. 
        All unauthorized access attempts are logged for security purposes.
    </p>
    <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg">Return to Dashboard</a>
</div>
@endsection