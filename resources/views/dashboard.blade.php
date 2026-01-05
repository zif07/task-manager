@extends('layouts.app')

@section('content')

{{-- ================= PAGE HEADER ================= --}}
<div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
    <h2 class="fw-bold mb-0">Task Dashboard</h2>

    <button class="btn btn-primary" onclick="openCreateModal()">
        + Add New Task
    </button>
</div>

{{-- ================= DASHBOARD GRID ================= --}}
<div class="row g-4">

    {{-- TASK LIST --}}
    <div class="col-lg-8">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-white fw-semibold">
                My Tasks
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="taskTable">
                        <thead class="table-light">
                            <tr>
                                <th>Title</th>
                                <th class="d-none d-md-table-cell">Description</th>
                                <th>Due</th>
                                <th>Priority</th>
                                <th>Status</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    Loading tasks...
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- USER INFO --}}
    <div class="col-lg-4">
        <div class="card shadow-sm">
            <div class="card-header bg-white fw-semibold">
                User Info
            </div>

            <div class="card-body small">
                <p><strong>Name</strong><br>{{ Auth::user()->name }}</p>
                <p><strong>Email</strong><br>{{ Auth::user()->email }}</p>
                <p>
                    <strong>Role</strong><br>
                    <span class="badge bg-secondary">
                        {{ strtoupper(Auth::user()->role ?? 'USER') }}
                    </span>
                </p>
            </div>
        </div>
    </div>

</div>

{{-- ================= CREATE / EDIT TASK MODAL ================= --}}
<div class="modal fade" id="taskModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title fw-semibold" id="taskModalTitle">Create Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="taskForm">
                @csrf
                <input type="hidden" id="task_id">

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" id="title" name="title"
                               class="form-control" required minlength="3">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea id="description" name="description"
                                  class="form-control" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Due Date</label>
                        <input type="date" id="due_date" name="due_date"
                               class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Priority</label>
                        <select id="priority" name="priority"
                                class="form-select" required>
                            <option value="">Choose priority</option>
                            <option value="low">Low</option>
                            <option value="medium">Medium</option>
                            <option value="high">High</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select id="status" name="status" class="form-select">
                            <option value="pending">Pending</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
let modal = new bootstrap.Modal(document.getElementById('taskModal'));

document.addEventListener('DOMContentLoaded', loadTasks);

/* ================= LOAD TASKS ================= */
function loadTasks() {
    fetch("{{ route('tasks.index') }}")
        .then(res => res.json())
        .then(tasks => {
            const tbody = document.querySelector('#taskTable tbody');
            tbody.innerHTML = '';

            if (tasks.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            No tasks yet.
                        </td>
                    </tr>`;
                return;
            }

            tasks.forEach(task => {
                tbody.innerHTML += `
                    <tr>
                        <td>${task.title}</td>
                        <td class="d-none d-md-table-cell">${task.description ?? '-'}</td>
                        <td>${task.due_date}</td>
                        <td>
                            <span class="badge bg-${priorityColor(task.priority)}">
                                ${task.priority.toUpperCase()}
                            </span>
                        </td>
                        <td>
                            <span class="badge ${task.status === 'completed' ? 'bg-success' : 'bg-info'}">
                                ${task.status.toUpperCase()}
                            </span>
                        </td>
                        <td class="text-end">
                            <button class="btn btn-sm btn-outline-primary me-1"
                                onclick='editTask(${JSON.stringify(task)})'>
                                Edit
                            </button>
                            <button class="btn btn-sm btn-outline-danger"
                                onclick="deleteTask(${task.id})">
                                Delete
                            </button>
                        </td>
                    </tr>`;
            });
        });
}

/* ================= OPEN CREATE MODAL ================= */
function openCreateModal() {
    document.getElementById('taskModalTitle').innerText = 'Create Task';
    document.getElementById('taskForm').reset();
    document.getElementById('task_id').value = '';
    modal.show();
}

/* ================= EDIT TASK ================= */
function editTask(task) {
    document.getElementById('taskModalTitle').innerText = 'Edit Task';
    task_id.value = task.id;
    title.value = task.title;
    description.value = task.description ?? '';
    due_date.value = task.due_date;
    priority.value = task.priority;
    status.value = task.status;
    modal.show();
}

/* ================= SAVE TASK ================= */
document.getElementById('taskForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const id = task_id.value;
    const payload = {
        title: title.value,
        description: description.value,
        due_date: due_date.value,
        priority: priority.value,
        status: status.value
    };

    const url = id ? `/tasks/${id}` : "{{ route('tasks.store') }}";
    const method = id ? 'PUT' : 'POST';

    fetch(url, {
        method,
        headers: {
            'X-CSRF-TOKEN': getCsrfToken(),
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(payload)
    })
    .then(res => {
        if (!res.ok) throw new Error();
        modal.hide();
        loadTasks();
    })
    .catch(() => alert('Failed to save task'));
});

/* ================= DELETE TASK ================= */
function deleteTask(id) {
    if (!confirm('Delete this task?')) return;

    fetch(`/tasks/${id}`, {
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': getCsrfToken() }
    }).then(loadTasks);
}

/* ================= PRIORITY COLOR ================= */
function priorityColor(p) {
    if (p === 'high') return 'danger';
    if (p === 'medium') return 'warning';
    return 'secondary';
}
</script>
@endpush
