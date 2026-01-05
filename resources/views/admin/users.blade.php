@extends('layouts.admin')

@section('content')

{{-- ================= PAGE HEADER ================= --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">User Management</h2>
        <p class="text-muted mb-0">
            Manage user roles and access permissions
        </p>
    </div>

    <span class="badge bg-danger px-3 py-2">
        ADMIN ONLY
    </span>
</div>

{{-- ================= FLASH MESSAGES ================= --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

{{-- ================= USER TABLE ================= --}}
<div class="card shadow-sm border-0">
    <div class="card-header bg-white fw-semibold">
        Registered Users
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Joined</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($users as $index => $user)
                        <tr>
                            <td>{{ $index + 1 }}</td>

                            <td class="fw-semibold">
                                {{ $user->name }}
                            </td>

                            <td>
                                {{ $user->email }}
                            </td>

                            <td>
                                <span class="badge 
                                    {{ $user->role === 'admin' ? 'bg-danger' : 'bg-secondary' }}">
                                    {{ strtoupper($user->role) }}
                                </span>
                            </td>

                            <td>
                                {{ $user->created_at->format('d M Y') }}
                            </td>

                            <td class="text-end">
                                {{-- Prevent admin from changing own role (SSD) --}}
                                @if($user->id !== auth()->id())
                                    <form action="{{ route('admin.users.toggle', $user->id) }}"
                                          method="POST"
                                          class="d-inline">
                                        @csrf
                                        @method('PUT')

                                        <button
                                            class="btn btn-sm
                                                {{ $user->role === 'admin'
                                                    ? 'btn-outline-secondary'
                                                    : 'btn-outline-danger' }}"
                                            onclick="return confirm(
                                                'Are you sure you want to change this user\'s role?'
                                            )">
                                            {{ $user->role === 'admin' ? 'Demote to User' : 'Promote to Admin' }}
                                        </button>
                                    </form>
                                @else
                                    <span class="text-muted small">
                                        (You)
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                No users found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
