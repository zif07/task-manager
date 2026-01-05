<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Panel') | Task Manager</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    {{-- Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background-color: #f4f6f9;
        }

        /* ================= SIDEBAR ================= */
        .admin-sidebar {
            width: 250px;
            min-height: 100vh;
            background: #212529;
            color: #fff;
        }

        .admin-sidebar a {
            color: #adb5bd;
            text-decoration: none;
            transition: all .2s ease;
        }

        .admin-sidebar a:hover,
        .admin-sidebar a.active {
            color: #fff;
            background: #343a40;
            border-radius: 6px;
        }

        /* ================= CONTENT ================= */
        .admin-content {
            padding: 30px;
            flex-grow: 1;
        }

        /* ================= TOPBAR ================= */
        .admin-topbar {
            background: #ffffff;
            border-bottom: 1px solid #dee2e6;
        }
    </style>
</head>
<body>

<div class="d-flex">

    {{-- ================= SIDEBAR ================= --}}
    <aside class="admin-sidebar p-4">

        <h5 class="fw-bold mb-4 text-center">
            🛡 Admin Panel
        </h5>

        {{-- ADMIN INFO --}}
        <div class="mb-4 text-center small text-muted">
            {{ Auth::user()->name }}<br>
            <span class="badge bg-danger mt-1">ADMIN</span>
        </div>

        {{-- NAVIGATION --}}
        <nav class="nav flex-column gap-1">

            <a href="{{ route('admin.dashboard') }}"
               class="nav-link px-3 py-2 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2 me-2"></i>
                Dashboard
            </a>

            <a href="{{ route('admin.users') }}"
               class="nav-link px-3 py-2 {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                <i class="bi bi-people me-2"></i>
                Users
            </a>

            <a href="{{ route('admin.tasks') }}"
               class="nav-link px-3 py-2 {{ request()->routeIs('admin.tasks') ? 'active' : '' }}">
                <i class="bi bi-list-check me-2"></i>
                Tasks
            </a>

            <hr class="border-secondary">

            <a href="{{ route('dashboard') }}" class="nav-link px-3 py-2">
                <i class="bi bi-arrow-left me-2"></i>
                Back to User
            </a>

            <form action="{{ route('logout') }}" method="POST" class="mt-3">
                @csrf
                <button class="btn btn-outline-light btn-sm w-100">
                    <i class="bi bi-box-arrow-right me-1"></i>
                    Logout
                </button>
            </form>

        </nav>
    </aside>

    {{-- ================= MAIN ================= --}}
    <div class="d-flex flex-column w-100">

        {{-- TOPBAR --}}
        <header class="admin-topbar px-4 py-3 d-flex justify-content-between align-items-center">
            <h6 class="mb-0 fw-semibold">
                @yield('title', 'Admin Dashboard')
            </h6>

            <span class="small text-muted">
                {{ now()->format('l, d M Y') }}
            </span>
        </header>

        {{-- CONTENT --}}
        <main class="admin-content">

            {{-- FLASH MESSAGES --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    {{ session('error') }}
                    <button class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </main>

    </div>
</div>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts')
</body>
</html>
