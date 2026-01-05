<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Task Manager - IKB21503 Project</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    {{-- Professional Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500;600;700&display=swap" rel="stylesheet">

    <style>
        html, body {
            height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
            background-color: #f8f9fa;
            font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }

        header {
            position: sticky;
            top: 0;
            z-index: 1030;
        }

        .navbar {
            min-height: 64px;
        }

        main {
            flex: 1;
            padding: 30px 0;
        }

        footer {
            background-color: #212529;
            color: #ffffff;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

{{-- ================= HEADER / NAVBAR ================= --}}
<header>
    <nav class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container-fluid px-4">

            <div class="d-flex align-items-center justify-content-between w-100">

                {{-- LEFT (Admin shortcut placeholder for centering) --}}
                <div class="d-flex align-items-center" style="min-width: 220px;">
                    @auth
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}"
                               class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-shield-lock"></i> Admin
                            </a>
                        @endif
                    @endauth
                </div>

                {{-- CENTER TITLE --}}
                <div class="text-center flex-grow-1">
                    <a href="{{ route('dashboard') }}"
                       class="navbar-brand fw-bold text-white m-0">
                        Task Manager
                    </a>
                </div>

                {{-- RIGHT USER MENU --}}
                @auth
                <div class="d-flex align-items-center gap-3 text-end" style="min-width: 220px; justify-content: flex-end;">

                    <div class="d-none d-md-block">
                        <div class="fw-semibold text-white small">
                            {{ Auth::user()->name }}
                        </div>
                        <a href="{{ route('profile') }}"
                           class="text-decoration-none small text-secondary">
                            Profile
                        </a>
                    </div>

                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-outline-light btn-sm">
                            Logout
                        </button>
                    </form>

                </div>
                @endauth

            </div>
        </div>
    </nav>
</header>

{{-- ================= MAIN CONTENT ================= --}}
<main>
    <div class="container">

        {{-- Flash Messages --}}
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

        @yield('content')

    </div>
</main>

{{-- ================= FOOTER ================= --}}
<footer class="py-3 text-center mt-auto">
    <div class="container">
        <small>
            Secure Task Manager – IKB21503 Secure Software Development Project<br>
            UniKL MIT | {{ date('Y') }}
        </small>
    </div>
</footer>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

{{-- CSRF Helper --}}
<script>
    function getCsrfToken() {
        return document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute('content');
    }
</script>

@stack('scripts')
</body>
</html>
