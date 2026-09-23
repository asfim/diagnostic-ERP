<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - {{ config('app.name', 'Diagnostic ERP') }}</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #4e73df;
            --primary-dark: #2e59d9;
            --secondary: #858796;
            --success: #1cc88a;
            --info: #36b9cc;
            --warning: #f6c23e;
            --danger: #e74a3b;
            --dark: #1a2035;
            --light: #f8f9fc;
            --sidebar-bg: #1e293b;
            --sidebar-hover: #334155;
            --sidebar-text: #e2e8f0;
            --card-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f1f5f9;
            color: #334155;
            overflow-x: hidden;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: var(--sidebar-bg);
            color: var(--sidebar-text);
            padding-top: 20px;
            z-index: 1000;
            box-shadow: 4px 0 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
            overflow-y: auto;
            scrollbar-gutter: stable;
        }

        .sidebar .collapsing {
            transition: none !important;
        }

        .sidebar::-webkit-scrollbar {
            width: 5px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: var(--sidebar-bg);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: var(--sidebar-hover);
            border-radius: 10px;
        }

        .sidebar .brand {
            padding: 15px 20px 25px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            margin-bottom: 15px;
        }

        .sidebar .brand h4 {
            font-weight: 700;
            color: #fff;
            letter-spacing: 1px;
            margin: 0;
        }

        .sidebar a {
            padding: 12px 25px;
            display: flex;
            align-items: center;
            color: var(--sidebar-text);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            margin: 2px 15px;
            border-radius: 8px;
        }

        .sidebar a i {
            width: 24px;
            font-size: 1.1rem;
            opacity: 0.8;
            margin-right: 10px;
        }

        .sidebar a:hover {
            background: var(--sidebar-hover);
            color: #fff;
        }

        .sidebar a.active {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: #fff;
            box-shadow: 0 4px 10px rgba(78, 115, 223, 0.4);
        }

        .sidebar a.active i {
            opacity: 1;
        }

        /* Sidebar Dropdown */
        .sidebar .collapse {
            background: rgba(0, 0, 0, 0.15);
            margin: 0 15px;
            border-radius: 8px;
        }

        .sidebar .collapse a {
            padding: 10px 15px 10px 45px;
            margin: 2px 0;
            font-size: 0.85rem;
            font-weight: 400;
            border-radius: 0;
        }

        .sidebar .collapse a:hover {
            background: rgba(255, 255, 255, 0.05);
        }

        .sidebar .collapse a.text-info {
            color: var(--info) !important;
            background: rgba(255, 255, 255, 0.05);
        }

        .dropdown-toggle::after {
            margin-left: auto;
        }

        /* Main Content */
        .main-content {
            margin-left: 260px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: all 0.3s;
        }

        /* Top Navbar */
        .top-navbar {
            background: #fff;
            padding: 15px 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .top-navbar .page-title {
            margin: 0;
            font-weight: 600;
            color: var(--dark);
            font-size: 1.25rem;
        }

        .top-navbar .user-profile {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .top-navbar .user-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--primary);
            padding: 2px;
        }

        .content-body {
            padding: 30px;
            flex-grow: 1;
        }

        /* Global UI Overrides */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            margin-bottom: 25px;
        }

        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #e3e6f0;
            padding: 1.25rem 1.5rem;
            border-radius: 12px 12px 0 0 !important;
            font-weight: 600;
            color: var(--primary);
        }

        .btn {
            border-radius: 8px;
            font-weight: 500;
            padding: 0.5rem 1.25rem;
            transition: all 0.2s;
        }

        .btn-sm {
            padding: 0.35rem 0.75rem;
            border-radius: 6px;
        }

        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
            box-shadow: 0 3px 8px rgba(78, 115, 223, 0.3);
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(78, 115, 223, 0.4);
        }

        /* Table Styling */
        .table {
            color: #475569;
        }

        .table> :not(caption)>*>* {
            padding: 1rem 1.25rem;
            border-bottom-color: #e2e8f0;
        }

        .table-dark {
            background-color: var(--primary);
            color: #fff;
            border-bottom: 2px solid var(--primary-dark);
        }

        .table-dark th {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
            color: #ffffff;
        }

        .table-hover tbody tr:hover {
            background-color: #f1f5f9;
        }

        .table-bordered {
            border: 1px solid #e2e8f0;
        }

        /* Badges */
        .badge {
            padding: 0.4em 0.8em;
            border-radius: 6px;
            font-weight: 500;
        }

        /* Form Inputs */
        .form-control,
        .form-select {
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            padding: 0.6rem 1rem;
            font-size: 0.95rem;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.15);
        }

        .form-label {
            font-weight: 500;
            color: #475569;
            margin-bottom: 0.4rem;
        }

        /* --- Premium UI Classes --- */
        .page-header-premium {
            background: linear-gradient(135deg, #1e3a5f 0%, #2563eb 100%);
            border-radius: 16px;
            padding: 28px 32px;
            margin-bottom: 28px;
            color: white;
            position: relative;
            overflow: hidden;
        }
        .page-header-premium::before {
            content: '';
            position: absolute;
            top: -40px; right: -40px;
            width: 180px; height: 180px;
            border-radius: 50%;
            background: rgba(255,255,255,0.07);
        }
        .page-header-premium::after {
            content: '';
            position: absolute;
            bottom: -60px; left: 30%;
            width: 280px; height: 180px;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
        }
        .page-header-premium h4 { font-weight: 700; font-size: 1.5rem; margin-bottom: 4px; }
        .page-header-premium p { opacity: 0.75; margin: 0; font-size: 0.9rem; }

        .btn-premium-new {
            background: rgba(255,255,255,0.15);
            border: 1.5px solid rgba(255,255,255,0.35);
            color: #fff;
            backdrop-filter: blur(6px);
            border-radius: 10px;
            padding: 10px 22px;
            font-weight: 600;
            transition: all 0.2s ease;
            position: relative;
            z-index: 1;
        }
        .btn-premium-new:hover {
            background: #fff;
            color: #2563eb;
            border-color: #fff;
        }

        .card-premium {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.07);
            overflow: hidden;
        }

        .table-premium thead th {
            background: #f8fafd;
            color: #64748b;
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.7px;
            border-bottom: 2px solid #e9eef6;
            padding: 14px 16px;
            white-space: nowrap;
        }
        .table-premium tbody tr {
            transition: background 0.15s ease;
            border-bottom: 1px solid #f1f5f9;
        }
        .table-premium tbody tr:last-child { border-bottom: none; }
        .table-premium tbody tr:hover { background: #f8fafd; }
        .table-premium tbody td {
            padding: 13px 16px;
            vertical-align: middle;
            font-size: 0.875rem;
            color: #334155;
        }

        .id-badge {
            font-family: 'Courier New', monospace;
            font-weight: 700;
            background: #eef2ff;
            color: #4f46e5;
            border-radius: 6px;
            padding: 3px 10px;
            font-size: 0.78rem;
            letter-spacing: 0.3px;
        }
        
        .status-pill {
            border-radius: 9px;
            padding: 4px 12px;
            font-size: 0.74rem;
            font-weight: 700;
            letter-spacing: 0.3px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        .status-dropdown {
            border-radius: 9px !important;
            padding: 4px 30px 4px 12px !important;
            font-size: 0.78rem !important;
            font-weight: 700 !important;
            height: auto !important;
            width: auto !important;
            min-width: 100px;
        }
        .pill-success  { background: #dcfce7; color: #15803d; }
        .pill-warning  { background: #fef9c3; color: #92400e; }
        .pill-danger   { background: #fee2e2; color: #b91c1c; }
        .pill-primary  { background: #dbeafe; color: #1d4ed8; }
        .pill-secondary{ background: #f1f5f9; color: #475569; }

        .action-btn {
            width: 32px; height: 32px;
            border-radius: 8px;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            transition: all 0.18s ease;
            cursor: pointer;
        }
        .action-btn:hover { transform: translateY(-1px); }
        .action-btn-view  { background: #eff6ff; color: #2563eb; }
        .action-btn-view:hover  { background: #2563eb; color: #fff; }
        .action-btn-edit  { background: #fffbeb; color: #d97706; }
        .action-btn-edit:hover  { background: #f59e0b; color: #fff; }
        .action-btn-del   { background: #fff1f2; color: #e11d48; }
        .action-btn-del:hover   { background: #e11d48; color: #fff; }

        .empty-state {
            padding: 60px 20px;
            text-align: center;
            color: #94a3b8;
        }
        .empty-state i { font-size: 3rem; margin-bottom: 16px; opacity: 0.4; display: block; }
    </style>
    @stack('styles')
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="brand">
            <h4><i class="fa-solid fa-hospital text-info me-2"></i> {{ config('app.name') }}</h4>
        </div>

        <div class="px-3 mb-2 text-uppercase text-secondary small fw-bold"
            style="font-size: 0.7rem; letter-spacing: 1px;">Core</div>

        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="fa-solid fa-chart-pie"></i> Dashboard
        </a>

        <div class="px-3 mt-4 mb-2 text-uppercase text-secondary small fw-bold"
            style="font-size: 0.7rem; letter-spacing: 1px;">Modules</div>

        @can('view patients')
            <a href="{{ route('patients.index') }}" class="{{ request()->routeIs('patients.*') ? 'active' : '' }}">
                <i class="fa-solid fa-users"></i> Patients
            </a>
        @endcan

        @can('view doctors')
            <a href="{{ route('doctors.index') }}" class="{{ request()->routeIs('doctors.*') ? 'active' : '' }}">
                <i class="fa-solid fa-user-doctor"></i> Doctors
            </a>
        @endcan

        @can('view appointments')
            <a href="{{ route('appointments.index') }}" class="{{ request()->routeIs('appointments.*') ? 'active' : '' }}">
                <i class="fa-solid fa-calendar-check"></i> Appointments
            </a>
        @endcan

        @can('view consultations')
            <a href="{{ route('consultations.index') }}"
                class="{{ request()->routeIs('consultations.*') ? 'active' : '' }}">
                <i class="fa-solid fa-stethoscope"></i> OPD Consultations
            </a>
        @endcan

        <div class="px-3 mt-4 mb-2 text-uppercase text-secondary small fw-bold"
            style="font-size: 0.7rem; letter-spacing: 1px;">Laboratory</div>

        @can('view tests')
            <a href="{{ route('tests.index') }}" class="{{ request()->routeIs('tests.*') ? 'active' : '' }}">
                <i class="fa-solid fa-microscope"></i> Master Tests
            </a>
        @endcan

        @can('view lab orders')
            <a href="{{ route('diagnostic-orders.index') }}"
                class="{{ request()->routeIs('diagnostic-orders.*') ? 'active' : '' }}">
                <i class="fa-solid fa-vial-circle-check"></i> Lab Orders
            </a>
        @endcan

        @can('view lab results')
            <a href="{{ route('test-results.index') }}"
                class="{{ request()->routeIs('test-results.*') ? 'active' : '' }}">
                <i class="fa-solid fa-file-medical"></i> Lab Results
            </a>
        @endcan

        <div class="px-3 mt-4 mb-2 text-uppercase text-secondary small fw-bold"
            style="font-size: 0.7rem; letter-spacing: 1px;">Finance & Reports</div>

        @can('view billing')
            <a href="{{ route('invoices.index') }}" class="{{ request()->routeIs('invoices.*') ? 'active' : '' }}">
                <i class="fa-solid fa-file-invoice-dollar"></i> Billing
            </a>
        @endcan

        @can('view accounts')
            <a href="{{ route('accounts.index') }}" class="{{ request()->routeIs('accounts.*') ? 'active' : '' }}">
                <i class="fa-solid fa-wallet"></i> Accounts
            </a>
        @endcan

        @can('view reports')
            <a class="dropdown-toggle" data-bs-toggle="collapse" href="#reportsMenu" role="button"
                aria-expanded="{{ request()->routeIs('reports.*') ? 'true' : 'false' }}">
                <i class="fa-solid fa-chart-line"></i> Reports
            </a>
            <div class="collapse {{ request()->routeIs('reports.*') ? 'show' : '' }}" id="reportsMenu">
                <a href="{{ route('reports.account') }}"
                    class="{{ request()->routeIs('reports.account') ? 'text-info' : '' }}">Account Report</a>
                <a href="{{ route('reports.patient') }}"
                    class="{{ request()->routeIs('reports.patient') ? 'text-info' : '' }}">Patient Report</a>
                <a href="{{ route('reports.doctor') }}"
                    class="{{ request()->routeIs('reports.doctor') ? 'text-info' : '' }}">Doctor Report</a>
                <a href="{{ route('reports.labOrder') }}"
                    class="{{ request()->routeIs('reports.labOrder') ? 'text-info' : '' }}">Lab Order Report</a>
            </div>
        @endcan

        <div class="px-3 mt-4 mb-2 text-uppercase text-secondary small fw-bold"
            style="font-size: 0.7rem; letter-spacing: 1px;">Administration</div>

        @can('view staff')
            <a href="{{ route('staff.index') }}" class="{{ request()->routeIs('staff.*') ? 'active' : '' }}">
                <i class="fa-solid fa-user-tie"></i> Staff
            </a>
        @endcan

        @can('view settings')
            <a href="{{ route('roles.index') }}" class="{{ request()->routeIs('roles.*') ? 'active' : '' }}">
                <i class="fa-solid fa-user-shield"></i> Roles & Permissions
            </a>
            <a href="{{ route('cms.index') }}" class="{{ request()->routeIs('cms.*') ? 'active' : '' }}">
                <i class="fa-solid fa-desktop"></i> Frontend CMS
            </a>
            <a href="{{ route('settings.index') }}" class="{{ request()->routeIs('settings.*') ? 'active' : '' }}">
                <i class="fa-solid fa-gear"></i> Settings
            </a>
        @endcan

        <div style="height: 50px;"></div> <!-- Bottom Padding -->
    </div>

    <!-- Main Content -->
    <div class="main-content">

        <!-- Top Navbar -->
        <div class="top-navbar">
            <h5 class="page-title">@yield('title', 'Dashboard')</h5>

            <div class="user-profile dropdown">
                <div class="d-flex align-items-center" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="text-end me-3 d-none d-md-block">
                        <div class="fw-bold" style="font-size: 0.9rem; color: #1e293b;">
                            {{ Auth::user()->name ?? 'Administrator' }}</div>
                        <div class="text-secondary" style="font-size: 0.75rem;">
                            {{ Auth::user()->roles->first()->name ?? 'Admin' }}</div>
                    </div>
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'A') }}&background=4e73df&color=fff"
                        alt="User">
                </div>

                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm"
                    style="border-radius: 12px; margin-top: 10px;">
                    <li><a class="dropdown-item py-2" href="#"><i
                                class="fa-regular fa-user me-2 text-secondary"></i> My Profile</a></li>
                    <li><a class="dropdown-item py-2" href="#"><i
                                class="fa-solid fa-gear me-2 text-secondary"></i> Settings</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item py-2 text-danger"><i
                                    class="fa-solid fa-arrow-right-from-bracket me-2"></i> Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Page Content -->
        <div class="content-body">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap 5.3 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>
