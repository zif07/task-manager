@extends('layouts.app')

@section('content')

{{-- PAGE HEADER --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">Admin Dashboard</h2>
        <p class="text-muted mb-0">
            System overview & administrative controls
        </p>
    </div>

    <span class="badge bg-danger px-3 py-2">
        ADMIN ACCESS
    </span>
</div>

{{-- STATS CARDS --}}
<div class="row g-4 mb-4">

    {{-- USERS --}}
    <div class="col-md-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Total Users</p>
                        <h3 class="fw-bold mb-0">{{ $totalUsers ?? '—' }}</h3>
                    </div>
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-people fs-4 text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- TASKS --}}
    <div class="col-md-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Total Tasks</p>
                        <h3 class="fw-bold mb-0">{{ $totalTasks ?? '—' }}</h3>
                    </div>
                    <div class="bg-success bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-list-check fs-4 text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- COMPLETED TASKS --}}
    <div class="col-md-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Completed Tasks</p>
                        <h3 class="fw-bold mb-0">{{ $completedTasks ?? '—' }}</h3>
                    </div>
                    <div class="bg-info bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-check-circle fs-4 text-info"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- ADMIN ACTIONS --}}
<div class="row g-4">

    {{-- USER MANAGEMENT --}}
    <div class="col-lg-6">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-white fw-semibold">
                User Management
            </div>

            <div class="card-body">
                <p class="text-muted">
                    Manage user accounts, roles, and access permissions.
                </p>

                <a href="{{ route('admin.users') }}"
                   class="btn btn-outline-primary">
                    Manage Users
                </a>
            </div>
        </div>
    </div>

    {{-- TASK MANAGEMENT --}}
    <div class="col-lg-6">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-white fw-semibold">
                Task Monitoring
            </div>

            <div class="card-body">
                <p class="text-muted">
                    Monitor all tasks created by users in the system.
                </p>

                <a href="{{ route('admin.tasks') }}"
                   class="btn btn-outline-success">
                    View All Tasks
                </a>
            </div>
        </div>
    </div>

</div>

@endsection
