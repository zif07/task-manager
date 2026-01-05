@extends('layouts.admin')

@section('content')

{{-- ================= PAGE HEADER ================= --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">Task Monitoring</h2>
        <p class="text-muted mb-0">
            View and monitor all tasks created by users
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

{{-- ================= TASK TABLE ================= --}}
<div class="card shadow-sm border-0">
    <div class="card-header bg-white fw-semibold">
        All User Tasks
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Title</th>
                        <th class="d-none d-md-table-cell">Description</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Due Date</th>
                        <th>Created</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($tasks as $index => $task)
                        <tr>
                            <td>{{ $index + 1 }}</td>

                            {{-- USER INFO --}}
                            <td>
                                <div class="fw-semibold">
                                    {{ $task->user->name ?? 'Unknown User' }}
                                </div>
                                <small class="text-muted">
                                    {{ $task->user->email ?? '-' }}
                                </small>
                            </td>

                            {{-- TASK TITLE --}}
                            <td class="fw-semibold">
                                {{ $task->title }}
                            </td>

                            {{-- DESCRIPTION (HIDDEN ON MOBILE) --}}
                            <td class="d-none d-md-table-cell text-muted">
                                {{ $task->description ?? '-' }}
                            </td>

                            {{-- PRIORITY --}}
                            <td>
                                <span class="badge
                                    {{ $task->priority === 'high' ? 'bg-danger' :
                                       ($task->priority === 'medium' ? 'bg-warning' : 'bg-secondary') }}">
                                    {{ strtoupper($task->priority) }}
                                </span>
                            </td>

                            {{-- STATUS --}}
                            <td>
                                <span class="badge
                                    {{ $task->status === 'completed' ? 'bg-success' : 'bg-info' }}">
                                    {{ strtoupper($task->status) }}
                                </span>
                            </td>

                            {{-- DUE DATE --}}
                            <td>
                                {{ \Carbon\Carbon::parse($task->due_date)->format('d M Y') }}
                            </td>

                            {{-- CREATED DATE --}}
                            <td>
                                {{ $task->created_at->format('d M Y') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">
                                No tasks found in the system.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
