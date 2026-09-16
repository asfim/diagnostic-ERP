<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Clinic ERP') }} - @yield('title')</title>

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; }
        .sidebar { min-height: 100vh; background: #2c3e50; color: white; padding-top: 1rem; width: 250px; position: fixed; }
        .sidebar a { color: #ecf0f1; text-decoration: none; padding: 10px 20px; display: block; transition: 0.3s; }
        .sidebar a:hover { background: #34495e; padding-left: 25px; }
        .sidebar .active { background: #3498db; }
        .main-content { margin-left: 250px; padding: 20px; }
        .navbar-custom { background: white; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h4 class="text-center mb-4"><i class="fa-solid fa-hospital"></i> {{ config('app.name') }}</h4>
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"><i class="fa-solid fa-chart-pie me-2"></i> Dashboard</a>
        <a href="{{ route('patients.index') }}" class="{{ request()->routeIs('patients.*') ? 'active' : '' }}"><i class="fa-solid fa-users me-2"></i> Patient Management</a>
        <a href="{{ route('doctors.index') }}" class="{{ request()->routeIs('doctors.*') ? 'active' : '' }}"><i class="fa-solid fa-user-doctor me-2"></i> Doctor Management</a>
        <a href="{{ route('appointments.index') }}" class="{{ request()->routeIs('appointments.*') ? 'active' : '' }}"><i class="fa-solid fa-calendar-check me-2"></i> Appointments</a>
        <a href="{{ route('tests.index') }}" class="{{ request()->routeIs('tests.*') ? 'active' : '' }}"><i class="fa-solid fa-vial-circle-check me-2"></i> Diagnostic Tests</a>
        <a href="#"><i class="fa-solid fa-file-invoice-dollar me-2"></i> Billing</a>
        <a href="#"><i class="fa-solid fa-gear me-2"></i> Settings</a>
        
        <form method="POST" action="{{ route('logout') }}" class="mt-5">
            @csrf
            <button type="submit" class="btn btn-link text-white text-decoration-none w-100 text-start ps-4"><i class="fa-solid fa-right-from-bracket me-2"></i> Logout</button>
        </form>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Navbar -->
        <nav class="navbar navbar-expand-lg navbar-custom mb-4 rounded">
            <div class="container-fluid">
                <span class="navbar-brand mb-0 h1">@yield('title')</span>
                <div class="d-flex">
                    <span class="navbar-text me-3">
                        <i class="fa-solid fa-user-circle"></i> {{ Auth::user()->name ?? 'Admin' }}
                    </span>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        @yield('content')
    </div>

    <!-- Bootstrap 5.3 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
