<!-- ================================================================
     TOPBAR
     ================================================================ -->
<div class="topbar site-topbar d-none d-lg-block">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8 d-flex gap-4">
                <span><i class="bi bi-telephone-fill"></i> Emergency: +880 1711 000 000</span>
                <span><i class="bi bi-envelope-fill"></i> info@medidag.com</span>
                <span><i class="bi bi-clock-fill"></i> Open 24/7</span>
            </div>
            <div class="col-md-4 text-end">
                <a href="#" class="me-2"><i class="bi bi-geo-alt-fill me-1"></i>Dhaka, BD</a>
                <span class="ms-2">
                    <a href="#" class="ms-2"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="ms-2"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="ms-2"><i class="bi bi-linkedin"></i></a>
                </span>
            </div>
        </div>
    </div>
</div>

<!-- ================================================================
     MAIN NAVBAR
     ================================================================ -->
<nav class="navbar navbar-expand-lg main-header py-2" id="mainNavbar">
    <div class="container">

        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ url('/') }}">
            <i class="bi bi-heart-pulse-fill text-secondary" style="font-size:2rem;"></i>
            <div>
                Medi<span>Diag</span>
                <small>Diagnostic &amp; Clinic</small>
            </div>
        </a>

        <!-- Mobile Hamburger -->
        <button class="navbar-toggler border-0 shadow-none p-1" type="button"
                data-bs-toggle="offcanvas" data-bs-target="#mobileMenu">
            <i class="bi bi-list" style="font-size:2rem; color:var(--primary);"></i>
        </button>

        <!-- Desktop Menu -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto align-items-center">

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('about') ? 'active' : '' }}" href="{{ url('/about') }}">About</a>
                </li>

                <!-- Services Hover Dropdown -->
                <li class="nav-item nav-hover-dropdown">
                    <a class="nav-link {{ request()->is('services*','departments*','tests*','packages*') ? 'active' : '' }}" href="#">
                        Services <i class="bi bi-chevron-down" style="font-size:.7rem;"></i>
                    </a>
                    <div class="hover-dropdown-menu" id="servicesDropdown">
                        <div class="row g-0">
                            <div class="col-md-6">
                                <p class="dropdown-section-label">Medical Services</p>
                                <a class="dropdown-item" href="{{ url('/departments') }}">
                                    <i class="bi bi-grid-3x3-gap-fill text-primary me-2"></i>All Departments
                                </a>
                                <a class="dropdown-item" href="{{ url('/departments/pathology') }}">
                                    <i class="bi bi-lungs text-primary me-2"></i>Pathology
                                </a>
                                <a class="dropdown-item" href="{{ url('/departments/radiology') }}">
                                    <i class="bi bi-broadcast text-primary me-2"></i>Radiology
                                </a>
                                <a class="dropdown-item" href="{{ url('/departments/cardiology') }}">
                                    <i class="bi bi-heart-pulse text-primary me-2"></i>Cardiology
                                </a>
                            </div>
                            <div class="col-md-6 border-start">
                                <p class="dropdown-section-label">Diagnostic</p>
                                <a class="dropdown-item" href="{{ url('/tests') }}">
                                    <i class="bi bi-clipboard2-pulse text-secondary me-2"></i>All Tests
                                </a>
                                <a class="dropdown-item" href="{{ url('/packages') }}">
                                    <i class="bi bi-box-seam text-secondary me-2"></i>Health Packages
                                </a>
                                <a class="dropdown-item" href="{{ url('/home-collection') }}">
                                    <i class="bi bi-truck text-secondary me-2"></i>Home Collection
                                </a>
                                <a class="dropdown-item" href="{{ url('/pricing') }}">
                                    <i class="bi bi-tags text-secondary me-2"></i>Pricing
                                </a>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('doctors*') ? 'active' : '' }}" href="{{ url('/doctors') }}">Doctors</a>
                </li>

                <!-- Patient Hover Dropdown -->
                <li class="nav-item nav-hover-dropdown">
                    <a class="nav-link {{ request()->is('appointment*','reports*','patient*') ? 'active' : '' }}" href="#">
                        Patient <i class="bi bi-chevron-down" style="font-size:.7rem;"></i>
                    </a>
                    <div class="hover-dropdown-menu" style="min-width:220px;">
                        <a class="dropdown-item" href="{{ url('/appointment') }}">
                            <i class="bi bi-calendar-check text-primary me-2"></i>Book Appointment
                        </a>
                        <a class="dropdown-item" href="{{ url('/reports') }}">
                            <i class="bi bi-file-medical text-primary me-2"></i>Online Reports
                        </a>
                        <a class="dropdown-item" href="{{ url('/home-collection') }}">
                            <i class="bi bi-truck text-primary me-2"></i>Home Collection
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ url('/login') }}">
                            <i class="bi bi-person-circle text-secondary me-2"></i>Patient Login
                        </a>
                        <a class="dropdown-item" href="{{ url('/register') }}">
                            <i class="bi bi-person-plus text-secondary me-2"></i>Register
                        </a>
                    </div>
                </li>

                <!-- More Hover Dropdown -->
                <li class="nav-item nav-hover-dropdown">
                    <a class="nav-link {{ request()->is('blog*','faq*','branches*','contact*') ? 'active' : '' }}" href="#">
                        More <i class="bi bi-chevron-down" style="font-size:.7rem;"></i>
                    </a>
                    <div class="hover-dropdown-menu" style="min-width:200px;">
                        <a class="dropdown-item" href="{{ url('/blog') }}">
                            <i class="bi bi-journal-text text-primary me-2"></i>Health Blog
                        </a>
                        <a class="dropdown-item" href="{{ url('/faq') }}">
                            <i class="bi bi-question-circle text-primary me-2"></i>FAQs
                        </a>
                        <a class="dropdown-item" href="{{ url('/branches') }}">
                            <i class="bi bi-geo-alt text-primary me-2"></i>Our Branches
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ url('/contact') }}">
                            <i class="bi bi-telephone text-secondary me-2"></i>Contact Us
                        </a>
                    </div>
                </li>

            </ul>

            <!-- Right: Search + Buttons -->
            <div class="d-flex align-items-center gap-2">
                <button class="btn btn-link text-dark p-2 rounded-circle" data-bs-toggle="modal" data-bs-target="#searchModal" title="Search">
                    <i class="bi bi-search fs-5"></i>
                </button>
                <a href="{{ url('/login') }}" class="btn btn-outline-primary rounded-pill px-3 py-2 fw-semibold">
                    <i class="bi bi-person me-1"></i>Login
                </a>
                <a href="{{ url('/appointment') }}" class="btn btn-secondary rounded-pill px-4 py-2 fw-bold">
                    Book Appointment
                </a>
            </div>
        </div>
    </div>
</nav>

<!-- ================================================================
     MOBILE OFFCANVAS
     ================================================================ -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="mobileMenu">
    <div class="offcanvas-header border-bottom py-3">
        <div class="d-flex align-items-center gap-2">
            <i class="bi bi-heart-pulse-fill text-secondary fs-3"></i>
            <div>
                <h5 class="fw-bold text-primary mb-0">MediDiag</h5>
                <small class="text-muted" style="font-size:.7rem; letter-spacing:.05em;">DIAGNOSTIC &amp; CLINIC</small>
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body px-0 py-0">
        <div class="accordion border-0" id="mobileAccordion">

            <div class="border-bottom">
                <a class="nav-link px-4 py-3 fw-semibold text-dark" href="{{ url('/') }}">Home</a>
            </div>
            <div class="border-bottom">
                <a class="nav-link px-4 py-3 fw-semibold text-dark" href="{{ url('/about') }}">About Us</a>
            </div>

            <!-- Services Accordion -->
            <div class="accordion-item rounded-0 border-0 border-bottom">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed px-4 py-3 fw-semibold bg-white text-dark shadow-none" type="button"
                            data-bs-toggle="collapse" data-bs-target="#mobServices">
                        Services
                    </button>
                </h2>
                <div id="mobServices" class="accordion-collapse collapse" data-bs-parent="#mobileAccordion">
                    <div class="accordion-body pt-0 ps-4 pb-3">
                        <a class="d-block text-muted py-1" href="{{ url('/departments') }}">All Departments</a>
                        <a class="d-block text-muted py-1" href="{{ url('/tests') }}">Diagnostic Tests</a>
                        <a class="d-block text-muted py-1" href="{{ url('/packages') }}">Health Packages</a>
                        <a class="d-block text-muted py-1" href="{{ url('/home-collection') }}">Home Collection</a>
                        <a class="d-block text-muted py-1" href="{{ url('/pricing') }}">Pricing</a>
                    </div>
                </div>
            </div>

            <div class="border-bottom">
                <a class="nav-link px-4 py-3 fw-semibold text-dark" href="{{ url('/doctors') }}">Doctors</a>
            </div>

            <!-- Patient Accordion -->
            <div class="accordion-item rounded-0 border-0 border-bottom">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed px-4 py-3 fw-semibold bg-white text-dark shadow-none" type="button"
                            data-bs-toggle="collapse" data-bs-target="#mobPatient">
                        Patient
                    </button>
                </h2>
                <div id="mobPatient" class="accordion-collapse collapse" data-bs-parent="#mobileAccordion">
                    <div class="accordion-body pt-0 ps-4 pb-3">
                        <a class="d-block text-muted py-1" href="{{ url('/appointment') }}">Book Appointment</a>
                        <a class="d-block text-muted py-1" href="{{ url('/reports') }}">Online Reports</a>
                        <a class="d-block text-muted py-1" href="{{ url('/home-collection') }}">Home Collection</a>
                        <a class="d-block text-muted py-1" href="{{ url('/login') }}">Patient Login</a>
                        <a class="d-block text-muted py-1" href="{{ url('/register') }}">Register</a>
                    </div>
                </div>
            </div>

            <!-- More Accordion -->
            <div class="accordion-item rounded-0 border-0 border-bottom">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed px-4 py-3 fw-semibold bg-white text-dark shadow-none" type="button"
                            data-bs-toggle="collapse" data-bs-target="#mobMore">
                        More
                    </button>
                </h2>
                <div id="mobMore" class="accordion-collapse collapse" data-bs-parent="#mobileAccordion">
                    <div class="accordion-body pt-0 ps-4 pb-3">
                        <a class="d-block text-muted py-1" href="{{ url('/blog') }}">Health Blog</a>
                        <a class="d-block text-muted py-1" href="{{ url('/faq') }}">FAQs</a>
                        <a class="d-block text-muted py-1" href="{{ url('/branches') }}">Our Branches</a>
                        <a class="d-block text-muted py-1" href="{{ url('/contact') }}">Contact Us</a>
                    </div>
                </div>
            </div>

        </div>

        <div class="p-4 border-top mt-auto">
            <a href="{{ url('/appointment') }}" class="btn btn-secondary w-100 rounded-pill fw-bold mb-2">
                <i class="bi bi-calendar-check me-2"></i>Book Appointment
            </a>
            <a href="{{ url('/login') }}" class="btn btn-outline-primary w-100 rounded-pill fw-bold">
                <i class="bi bi-person me-2"></i>Patient Login
            </a>
            <div class="text-center mt-3 text-muted small">
                <i class="bi bi-telephone-fill text-danger me-1"></i>
                Emergency: <strong>+880 1711 000 000</strong>
            </div>
        </div>
    </div>
</div>

<!-- ================================================================
     GLOBAL SEARCH MODAL
     ================================================================ -->
<div class="modal fade" id="searchModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow-lg">
            <div class="modal-body p-4">
                <form action="{{ url('/search') }}" method="GET">
                    <div class="input-group input-group-lg">
                        <input type="text" name="q" class="form-control rounded-start-pill border-2 border-primary px-4"
                               placeholder="Search doctors, tests, packages, departments…" autofocus>
                        <button class="btn btn-primary rounded-end-pill px-4" type="submit">
                            <i class="bi bi-search me-1"></i> Search
                        </button>
                    </div>
                </form>
                <div class="mt-3">
                    <p class="text-muted small mb-2">Quick Links:</p>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ url('/tests') }}" class="badge bg-light text-dark border">CBC Test</a>
                        <a href="{{ url('/tests') }}" class="badge bg-light text-dark border">Lipid Profile</a>
                        <a href="{{ url('/packages') }}" class="badge bg-light text-dark border">Executive Package</a>
                        <a href="{{ url('/doctors') }}" class="badge bg-light text-dark border">Find a Doctor</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@push('styles')
<style>
/* ================================================================
   FIXED HEADER WRAPPER
   ================================================================ */
.site-topbar {
    position: fixed;
    top: 0; left: 0; right: 0;
    z-index: 1041;
}
.main-header {
    position: fixed !important;
    top: 37px; /* topbar height */
    left: 0; right: 0;
    z-index: 1040;
}
/* Hide topbar on mobile → header moves up */
@media (max-width: 991.98px) {
    .main-header { top: 0; }
}

/* ================================================================
   HOVER DROPDOWN — BASE
   ================================================================ */
.nav-hover-dropdown {
    position: static; /* let dropdown use navbar as reference */
}

/* Each dropdown positioned relative to the navbar container */
.navbar-nav {
    position: static;
}

/* The dropdown panel */
.hover-dropdown-menu {
    display: none;
    position: fixed; /* fixed so it doesn't clip inside overflow:hidden */
    top: auto;       /* set dynamically via JS */
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 12px 48px rgba(0,0,0,.16);
    border: 1px solid rgba(0,0,0,.07);
    padding: 1rem;
    z-index: 9998;
    min-width: 200px;
    pointer-events: none;
    opacity: 0;
    transform: translateY(8px);
    transition: opacity .2s ease, transform .2s ease;
}

/* Show on hover */
.nav-hover-dropdown:hover > .hover-dropdown-menu {
    display: block;
    pointer-events: auto;
    opacity: 1;
    transform: translateY(0);
}

/* Keep visible when cursor moves into menu */
.hover-dropdown-menu:hover {
    display: block;
    pointer-events: auto;
    opacity: 1;
    transform: translateY(0);
}

/* ================================================================
   SERVICES DROPDOWN — 2-column, wider, left-anchored
   ================================================================ */
#servicesDropdown {
    min-width: 460px;
}

/* ================================================================
   SECTION LABELS inside dropdown
   ================================================================ */
.dropdown-section-label {
    font-size: .7rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .1em;
    color: #adb5bd;
    margin-bottom: .4rem;
    padding: 0 .5rem;
    display: block;
}

/* ================================================================
   DROPDOWN ITEMS
   ================================================================ */
.hover-dropdown-menu .dropdown-item {
    border-radius: 8px;
    font-weight: 500;
    font-size: .875rem;
    padding: .45rem .7rem;
    color: #212529;
    white-space: nowrap;
    transition: background .15s, color .15s, padding-left .15s;
    display: flex;
    align-items: center;
}
.hover-dropdown-menu .dropdown-item:hover {
    background: rgba(11,94,215,.07);
    color: #0b5ed7;
    padding-left: 1rem;
}
.hover-dropdown-menu .dropdown-divider {
    margin: .4rem 0;
    opacity: .1;
}

/* ================================================================
   CHEVRON ROTATE ON HOVER
   ================================================================ */
.nav-hover-dropdown:hover .bi-chevron-down {
    transform: rotate(180deg);
}
.bi-chevron-down {
    transition: transform .25s ease;
    display: inline-block;
}

/* ================================================================
   SCROLL SHRINK EFFECT
   ================================================================ */
.main-header.scrolled {
    box-shadow: 0 4px 32px rgba(0,0,0,.14) !important;
}

/* ================================================================
   ACTIVE NAV UNDERLINE
   ================================================================ */
.nav-link.active::after {
    transform: scaleX(1) !important;
}
</style>
@endpush

@push('scripts')
<script>
(function () {
    // ── Navbar scroll shrink ──────────────────────────────────────
    const nav = document.getElementById('mainNavbar');
    window.addEventListener('scroll', () => {
        nav.classList.toggle('scrolled', window.scrollY > 30);
    }, { passive: true });

    // ── Hover dropdown — position each panel dynamically ─────────
    // We use fixed positioning so the panel appears below the nav
    // item regardless of any overflow constraints.
    document.querySelectorAll('.nav-hover-dropdown').forEach(item => {
        const menu = item.querySelector('.hover-dropdown-menu');
        if (!menu) return;

        const position = () => {
            const rect   = item.getBoundingClientRect();
            const menuW  = menu.offsetWidth || parseInt(menu.style.minWidth) || 220;
            const vw     = window.innerWidth;

            // Vertical: directly below the nav item
            menu.style.top = (rect.bottom + 2) + 'px';

            // Horizontal: try to centre over trigger, clamp to viewport
            let left = rect.left + (rect.width / 2) - (menuW / 2);
            if (left + menuW > vw - 16) left = vw - menuW - 16;
            if (left < 8) left = 8;
            menu.style.left = left + 'px';
            menu.style.right = 'auto';
        };

        item.addEventListener('mouseenter', () => {
            position();
        });

        // Re-position on scroll / resize while open
        window.addEventListener('scroll', () => {
            if (item.matches(':hover')) position();
        }, { passive: true });
    });
})();
</script>
@endpush
