<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Doctor Portal') - {{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --doctor-primary: #0f766e;
            --doctor-dark: #134e4a;
            --sidebar-bg: #0d2d29;
            --sidebar-hover: #1a4a45;
            --sidebar-text: #ccfbf1;
        }
        body { font-family: 'Inter', sans-serif; background-color: #f1f5f9; color: #334155; overflow-x: hidden; }
        .sidebar {
            width: 260px; height: 100vh; position: fixed; top: 0; left: 0;
            background: var(--sidebar-bg); color: var(--sidebar-text);
            padding-top: 20px; z-index: 1000; overflow-y: auto;
            box-shadow: 4px 0 10px rgba(0,0,0,0.15);
        }
        .sidebar::-webkit-scrollbar { width: 5px; }
        .sidebar::-webkit-scrollbar-thumb { background: var(--sidebar-hover); border-radius: 10px; }
        .sidebar .brand { padding: 15px 20px 20px; text-align: center; border-bottom: 1px solid rgba(255,255,255,0.07); margin-bottom: 10px; }
        .sidebar .brand .doctor-badge { display: inline-block; background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.15); border-radius: 20px; padding: 3px 14px; font-size: 0.75rem; color: #5eead4; margin-top: 5px; }
        .sidebar a { padding: 11px 25px; display: flex; align-items: center; color: var(--sidebar-text); text-decoration: none; transition: all 0.25s; font-weight: 500; font-size: 0.92rem; margin: 2px 12px; border-radius: 8px; }
        .sidebar a i { width: 24px; font-size: 1rem; opacity: 0.75; margin-right: 10px; }
        .sidebar a:hover { background: var(--sidebar-hover); color: #fff; transform: translateX(3px); }
        .sidebar a.active { background: linear-gradient(135deg, var(--doctor-primary), var(--doctor-dark)); color: #fff; box-shadow: 0 4px 10px rgba(15,118,110,0.4); }
        .sidebar a.active i { opacity: 1; }
        .main-content { margin-left: 260px; min-height: 100vh; display: flex; flex-direction: column; }
        .top-navbar { background: #fff; padding: 14px 30px; box-shadow: 0 2px 8px rgba(0,0,0,0.04); display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 999; border-bottom: 2px solid #f0fdfa; }
        .top-navbar .page-title { margin: 0; font-weight: 600; color: var(--doctor-dark); font-size: 1.2rem; }
        .top-navbar img { width: 40px; height: 40px; border-radius: 50%; border: 2px solid var(--doctor-primary); padding: 2px; }
        .content-body { padding: 28px; flex-grow: 1; }
        .card { border: none; border-radius: 12px; box-shadow: 0 0.15rem 1.75rem 0 rgba(0,0,0,0.1); margin-bottom: 22px; }
        .card-header { background-color: #fff; border-bottom: 1px solid #e0f2fe; padding: 1.1rem 1.4rem; border-radius: 12px 12px 0 0 !important; font-weight: 600; color: var(--doctor-primary); }
        .btn { border-radius: 8px; font-weight: 500; transition: all 0.2s; }
        .btn-primary { background-color: var(--doctor-primary); border-color: var(--doctor-primary); }
        .btn-primary:hover { background-color: var(--doctor-dark); border-color: var(--doctor-dark); transform: translateY(-1px); }
        .btn-sm { padding: 0.35rem 0.75rem; border-radius: 6px; }
        .table { color: #475569; }
        .table > :not(caption) > * > * { padding: 0.85rem 1.1rem; border-bottom-color: #e2e8f0; }
        .table-dark { background-color: var(--doctor-primary) !important; color: #fff !important; }
        .table-dark th { color: #fff !important; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600; }
        .table-hover tbody tr:hover { background-color: #f0fdfa; }
        .form-control:focus, .form-select:focus { border-color: var(--doctor-primary); box-shadow: 0 0 0 0.25rem rgba(15,118,110,0.15); }
        .badge { padding: 0.4em 0.8em; border-radius: 6px; font-weight: 500; }
        .form-label { font-weight: 500; color: #475569; margin-bottom: 0.4rem; }
        .form-control, .form-select { border-radius: 8px; border: 1px solid #cbd5e1; padding: 0.6rem 1rem; }

        /* Mobile & Responsive Layout Enhancements */
        .sidebar-backdrop {
            position: fixed;
            top: 0; left: 0;
            width: 100vw; height: 100vh;
            background: rgba(13, 45, 41, 0.7);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
            z-index: 1039;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }
        .sidebar-backdrop.show {
            opacity: 1;
            visibility: visible;
        }

        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
                z-index: 1040;
                width: 270px;
                box-shadow: 10px 0 30px rgba(0, 0, 0, 0.4);
                transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0 !important;
                width: 100% !important;
            }
            .top-navbar {
                padding: 12px 16px;
            }
            .content-body {
                padding: 16px 12px;
            }
        }

        @media (max-width: 576px) {
            .top-navbar .page-title {
                font-size: 1.05rem;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                max-width: 170px;
            }
            .card-header {
                padding: 1rem;
                flex-direction: column;
                align-items: flex-start !important;
                gap: 10px;
            }
            .table-responsive {
                -webkit-overflow-scrolling: touch;
            }
        }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="brand">
        <h5 class="text-white mb-1 fw-bold"><i class="fa-solid fa-hospital me-2" style="color:#5eead4;"></i>{{ config('app.name') }}</h5>
        <span class="doctor-badge"><i class="fa-solid fa-stethoscope me-1"></i> Doctor Portal</span>
    </div>

    @php $doctorProfile = \App\Models\Doctor::where('user_id', auth()->id())->first(); @endphp

    @if($doctorProfile)
    <div class="px-3 py-3 mx-3 mb-2 text-center" style="background: rgba(255,255,255,0.05); border-radius: 10px;">
        <div class="fw-bold text-white" style="font-size: 0.95rem;">Dr. {{ $doctorProfile->name }}</div>
        <div style="font-size: 0.78rem; color: #5eead4;">{{ $doctorProfile->specialization }}</div>
    </div>
    @endif

    <div class="px-4 my-2 text-uppercase fw-bold" style="font-size: 0.68rem; letter-spacing: 1px; color: #5eead4; opacity: 0.7;">Navigation</div>

    <a href="{{ route('doctor.dashboard') }}" class="{{ request()->routeIs('doctor.dashboard') ? 'active' : '' }}">
        <i class="fa-solid fa-gauge-high"></i> My Dashboard
    </a>
    <a href="{{ route('doctor.appointments') }}" class="{{ request()->routeIs('doctor.appointments') ? 'active' : '' }}">
        <i class="fa-solid fa-calendar-check"></i> My Appointments
    </a>
    <a href="{{ route('doctor.consultations') }}" class="{{ request()->routeIs('doctor.consultations') ? 'active' : '' }}">
        <i class="fa-solid fa-stethoscope"></i> Consultations
    </a>
    <a href="{{ route('doctor.patients') }}" class="{{ request()->routeIs('doctor.patients') ? 'active' : '' }}">
        <i class="fa-solid fa-users"></i> My Patients
    </a>

    <div class="px-4 my-2 mt-3 text-uppercase fw-bold" style="font-size: 0.68rem; letter-spacing: 1px; color: #5eead4; opacity: 0.7;">Account</div>
    <a href="#"><i class="fa-regular fa-user"></i> My Profile</a>

    <div style="height: 30px;"></div>

    <div class="px-3 mb-4">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn w-100 text-start" style="color: #f87171; background: rgba(248,113,113,0.1); border: 1px solid rgba(248,113,113,0.2);">
                <i class="fa-solid fa-arrow-right-from-bracket me-2"></i> Logout
            </button>
        </form>
    </div>
</div>

<div class="main-content">
    <div class="top-navbar">
        <div class="d-flex align-items-center">
            <button id="doctorSidebarToggle" class="btn btn-light border-0 shadow-none me-2 d-lg-none p-2 rounded-3" type="button" aria-label="Toggle navigation">
                <i class="fa-solid fa-bars fs-4" style="color: var(--doctor-primary);"></i>
            </button>
            <h5 class="page-title mb-0">@yield('title', 'Dashboard')</h5>
        </div>
        <div class="dropdown">
            <div class="d-flex align-items-center" role="button" data-bs-toggle="dropdown">
                <div class="text-end me-3 d-none d-md-block">
                    <div class="fw-bold" style="font-size:0.88rem; color:var(--doctor-primary);">{{ auth()->user()->name ?? 'Doctor' }}</div>
                    <div class="text-muted" style="font-size:0.73rem;">Doctor</div>
                </div>
                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'D') }}&background=0f766e&color=fff" alt="Doctor">
            </div>
            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm" style="border-radius:12px; margin-top:10px;">
                <li><a class="dropdown-item py-2" href="#"><i class="fa-regular fa-user me-2 text-secondary"></i> My Profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item py-2 text-danger"><i class="fa-solid fa-arrow-right-from-bracket me-2"></i> Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>

    <div class="content-body">
        @yield('content')
    </div>
</div>

<div class="sidebar-backdrop" id="doctorSidebarBackdrop"></div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleBtn = document.getElementById('doctorSidebarToggle');
        const sidebar = document.querySelector('.sidebar');
        const backdrop = document.getElementById('doctorSidebarBackdrop');

        function toggle() {
            if (sidebar) sidebar.classList.toggle('show');
            if (backdrop) backdrop.classList.toggle('show');
        }

        function close() {
            if (sidebar) sidebar.classList.remove('show');
            if (backdrop) backdrop.classList.remove('show');
        }

        if (toggleBtn) toggleBtn.addEventListener('click', toggle);
        if (backdrop) backdrop.addEventListener('click', close);
        if (sidebar) {
            sidebar.querySelectorAll('a').forEach(l => l.addEventListener('click', () => {
                if (window.innerWidth < 992) close();
            }));
        }
    });
</script>
@stack('scripts')
</body>
</html>
