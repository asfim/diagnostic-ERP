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
            width: 265px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: linear-gradient(180deg, #0f172a 0%, #1e293b 50%, #0f172a 100%);
            color: #e2e8f0;
            padding-top: 0;
            z-index: 1000;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.25);
            transition: all 0.3s;
            overflow-y: auto;
            scrollbar-gutter: stable;
        }

        .sidebar .collapsing {
            transition: none !important;
        }

        .sidebar::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 10px;
        }

        /* Brand / Logo */
        .sidebar .brand {
            padding: 24px 20px 20px;
            text-align: center;
            background: linear-gradient(135deg, rgba(78,115,223,0.25) 0%, rgba(37,99,235,0.1) 100%);
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
            margin-bottom: 10px;
            position: relative;
        }
        .sidebar .brand::after {
            content: '';
            position: absolute;
            bottom: 0; left: 20%; right: 20%;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(99,179,237,0.4), transparent);
        }
        .sidebar .brand .brand-icon {
            width: 48px; height: 48px;
            background: linear-gradient(135deg, #4e73df, #2563eb);
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            box-shadow: 0 4px 15px rgba(78,115,223,0.45);
        }
        .sidebar .brand h4 {
            font-weight: 700;
            color: #fff;
            letter-spacing: 0.5px;
            margin: 0;
            font-size: 1rem;
        }
        .sidebar .brand p {
            font-size: 0.7rem;
            color: rgba(255,255,255,0.45);
            margin: 0;
            letter-spacing: 1px;
        }

        /* Section Labels */
        .sidebar .nav-label {
            padding: 16px 20px 6px;
            font-size: 0.62rem;
            letter-spacing: 1.5px;
            font-weight: 700;
            color: rgba(255,255,255,0.3);
            text-transform: uppercase;
        }

        /* Nav Links */
        .sidebar a {
            padding: 10px 16px;
            display: flex;
            align-items: center;
            color: rgba(226, 232, 240, 0.75);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.875rem;
            margin: 2px 12px;
            border-radius: 10px;
            transition: all 0.2s ease;
            position: relative;
        }

        .sidebar a .nav-icon {
            width: 34px; height: 34px;
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            margin-right: 10px;
            background: rgba(255,255,255,0.05);
            transition: all 0.2s ease;
            flex-shrink: 0;
        }

        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.07);
            color: #fff;
        }

        .sidebar a:hover .nav-icon {
            background: rgba(78, 115, 223, 0.25);
            color: #93c5fd;
        }

        .sidebar a.active {
            background: linear-gradient(135deg, rgba(78,115,223,0.35) 0%, rgba(37,99,235,0.2) 100%);
            color: #fff;
            border: 1px solid rgba(78,115,223,0.3);
        }

        .sidebar a.active .nav-icon {
            background: linear-gradient(135deg, #4e73df, #2563eb);
            color: #fff;
            box-shadow: 0 3px 10px rgba(78,115,223,0.45);
        }

        /* Sidebar Dropdown */
        .sidebar .collapse {
            background: rgba(0, 0, 0, 0.15);
            margin: 0 12px;
            border-radius: 10px;
        }

        .sidebar .collapse a {
            padding: 8px 12px 8px 50px;
            margin: 1px 0;
            font-size: 0.82rem;
            font-weight: 400;
            border-radius: 0;
            color: rgba(226, 232, 240, 0.6);
        }

        .sidebar .collapse a::before {
            content: '';
            width: 5px; height: 5px;
            border-radius: 50%;
            background: rgba(255,255,255,0.25);
            display: inline-block;
            margin-right: 10px;
            margin-left: -15px;
            flex-shrink: 0;
        }

        .sidebar .collapse a:hover {
            background: rgba(255, 255, 255, 0.05);
            color: #fff;
        }
        .sidebar .collapse a:hover::before {
            background: #4e73df;
        }

        .sidebar .collapse a.text-info {
            color: #93c5fd !important;
            background: rgba(78,115,223,0.1);
        }
        .sidebar .collapse a.text-info::before {
            background: #4e73df;
        }

        .dropdown-toggle::after {
            margin-left: auto;
            opacity: 0.5;
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
        
        @media print {
            .sidebar, .top-navbar, .page-header-premium, .d-print-none {
                display: none !important;
            }
            .main-content {
                margin-left: 0 !important;
            }
            .content-body {
                padding: 0 !important;
            }
            .card, .card-premium {
                box-shadow: none !important;
                border: none !important;
            }
            body {
                background: #fff !important;
            }
        }
    </style>
    @stack('styles')
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="brand">
            @php
                $adminLogo = \App\Models\Setting::get('site_logo');
            @endphp
            @if($adminLogo)
                <img src="{{ asset('storage/' . $adminLogo) }}" alt="{{ config('app.name') }}" style="max-height: 60px; max-width: 100%; padding-top: 10px;">
            @else
                <div class="brand-icon">
                    <i class="fa-solid fa-hospital text-white fs-5"></i>
                </div>
            @endif
        </div>

        <div class="nav-label">Core</div>

        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <span class="nav-icon"><i class="fa-solid fa-chart-pie"></i></span> Dashboard
        </a>

        <div class="nav-label">Modules</div>

        @can('view patients')
            <a href="{{ route('patients.index') }}" class="{{ request()->routeIs('patients.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-solid fa-users"></i></span> Patients
            </a>
        @endcan

        @can('view doctors')
            <a href="{{ route('doctors.index') }}" class="{{ request()->routeIs('doctors.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-solid fa-user-doctor"></i></span> Doctors
            </a>
        @endcan

        @can('view appointments')
            <a href="{{ route('appointments.index') }}" class="{{ request()->routeIs('appointments.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-solid fa-calendar-check"></i></span> Appointments
            </a>
        @endcan

        @can('view consultations')
            <a href="{{ route('consultations.index') }}"
                class="{{ request()->routeIs('consultations.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-solid fa-stethoscope"></i></span> OPD Consultations
            </a>
        @endcan

        <div class="nav-label">Laboratory</div>

        @can('view tests')
            <a href="{{ route('tests.index') }}" class="{{ request()->routeIs('tests.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-solid fa-microscope"></i></span> Master Tests
            </a>
        @endcan

        @can('view lab orders')
            <a href="{{ route('diagnostic-orders.index') }}"
                class="{{ request()->routeIs('diagnostic-orders.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-solid fa-vial-circle-check"></i></span> Lab Orders
            </a>
        @endcan

        @can('view lab results')
            <a href="{{ route('test-results.index') }}"
                class="{{ request()->routeIs('test-results.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-solid fa-file-medical"></i></span> Lab Results
            </a>
        @endcan

        <div class="nav-label">Finance & Reports</div>

        @can('view billing')
            <a href="{{ route('invoices.index') }}" class="{{ request()->routeIs('invoices.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-solid fa-file-invoice-dollar"></i></span> Billing
            </a>
        @endcan

        @can('view accounts')
            <a href="{{ route('accounts.index') }}" class="{{ request()->routeIs('accounts.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-solid fa-wallet"></i></span> Accounts
            </a>
        @endcan

        @can('view reports')
            <a class="dropdown-toggle" data-bs-toggle="collapse" href="#reportsMenu" role="button"
                aria-expanded="{{ request()->routeIs('reports.*') ? 'true' : 'false' }}">
                <span class="nav-icon"><i class="fa-solid fa-chart-line"></i></span> Reports
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

        <div class="nav-label">Administration</div>

        @can('view staff')
            <a href="{{ route('staff.index') }}" class="{{ request()->routeIs('staff.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-solid fa-user-tie"></i></span> Staff
            </a>
        @endcan

        @can('view settings')
            <a href="{{ route('roles.index') }}" class="{{ request()->routeIs('roles.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-solid fa-user-shield"></i></span> Roles & Permissions
            </a>
            <a href="{{ route('cms.index') }}" class="{{ request()->routeIs('cms.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-solid fa-desktop"></i></span> Frontend CMS
            </a>
            <a href="{{ route('testimonials.index') }}" class="{{ request()->routeIs('testimonials.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-solid fa-comments"></i></span> Testimonials
            </a>
            <a href="{{ route('settings.index') }}" class="{{ request()->routeIs('settings.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-solid fa-gear"></i></span> Settings
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
