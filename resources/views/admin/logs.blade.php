@extends('layouts.admin')

@section('title', 'Audit Logs')

@section('content')

{{-- PAGE HEADER --}}
<div class="mb-4">
    <h3 class="fw-bold mb-1">Security Audit Logs</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Audit Logs</li>
        </ol>
    </nav>
</div>

<div class="card shadow-sm border-danger">
    <div class="card-header bg-danger text-white fw-semibold">
        <i class="bi bi-shield-lock me-2"></i>
        Security Audit Trail
    </div>

    <div class="card-body">

        <div class="alert alert-info small">
            <i class="bi bi-info-circle me-1"></i>
            This audit trail records sensitive security-related events such as
            authentication attempts, role changes, and task operations.
            Logs are read-only to ensure integrity and non-repudiation.
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Timestamp (UTC)</th>
                        <th>User</th>
                        <th>Action</th>
                        <th>Description</th>
                        <th>IP Address</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                        <tr>
                            <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>

                            <td>
                                <strong>{{ $log->user->name ?? 'System' }}</strong><br>
                                <small class="text-muted">
                                    {{ $log->user->email ?? 'N/A' }}
                                </small>
                            </td>

                            <td>
                                <span class="badge 
                                    {{ $log->action === 'login_failed' ? 'bg-danger' : 'bg-primary' }}">
                                    {{ strtoupper($log->action) }}
                                </span>
                            </td>

                            <td>{{ $log->description }}</td>

                            <td>
                                <code>{{ $log->ip_address }}</code>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">
                                No security events recorded.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-footer bg-light text-end">
        <small class="text-muted">
            Confidentiality Level: <strong>High</strong>
        </small>
    </div>
</div>

@endsection
