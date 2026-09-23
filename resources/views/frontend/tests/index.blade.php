@extends('layouts.frontend')
@section('title', 'Diagnostic Tests - MediDiag')
@section('content')

<x-frontend.page-banner title="Diagnostic Tests" :breadcrumbs="['Tests' => url('/tests')]" />

<section class="section-padding">
    <div class="container">
        <div class="row g-4">

            {{-- Sidebar Filters --}}
            <div class="col-lg-3" data-aos="fade-right">
                <div class="card border-0 shadow-sm rounded-4 p-4 sticky-top" style="top:90px;">
                    <h5 class="fw-bold mb-4"><i class="bi bi-funnel-fill text-primary me-2"></i>Filter Tests</h5>

                    <form method="GET" action="{{ url('/tests') }}" id="filterForm">
                        {{-- Search --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold small text-muted text-uppercase">Search</label>
                            <div class="input-group">
                                <input type="text" name="search" class="form-control rounded-start-pill border-end-0"
                                       placeholder="Test name or code…" value="{{ request('search') }}">
                                <button class="btn btn-primary rounded-end-pill px-3" type="submit">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>

                        {{-- Department --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold small text-muted text-uppercase">Department</label>
                            @foreach($departments as $dept)
                            <div class="form-check mb-1">
                                <input class="form-check-input" type="radio" name="department"
                                       id="dept{{ $dept->id }}" value="{{ $dept->id }}"
                                       {{ request('department') == $dept->id ? 'checked' : '' }}
                                       onchange="document.getElementById('filterForm').submit()">
                                <label class="form-check-label small" for="dept{{ $dept->id }}">{{ $dept->name }}</label>
                            </div>
                            @endforeach
                        </div>

                        {{-- Price Range --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold small text-muted text-uppercase">
                                Max Price: <span id="priceVal">৳ {{ request('max_price', 5000) }}</span>
                            </label>
                            <input type="range" class="form-range" name="max_price" min="100" max="10000" step="100"
                                   value="{{ request('max_price', 5000) }}"
                                   oninput="document.getElementById('priceVal').textContent='৳ '+this.value"
                                   onchange="document.getElementById('filterForm').submit()">
                        </div>

                        @if(request()->hasAny(['search','department','max_price']))
                        <a href="{{ url('/tests') }}" class="btn btn-outline-secondary btn-sm w-100 rounded-pill">
                            <i class="bi bi-x-circle me-1"></i> Clear Filters
                        </a>
                        @endif
                    </form>
                </div>
            </div>

            {{-- Test Grid --}}
            <div class="col-lg-9">
                <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
                    <p class="text-muted mb-0 small">
                        Showing <strong>{{ $tests->firstItem() }}–{{ $tests->lastItem() }}</strong>
                        of <strong>{{ $tests->total() }}</strong> tests
                    </p>
                    <select class="form-select form-select-sm w-auto rounded-pill border-primary">
                        <option>Sort: Relevant</option>
                        <option>Price: Low to High</option>
                        <option>Price: High to Low</option>
                    </select>
                </div>

                @if($tests->isEmpty())
                <div class="text-center py-5">
                    <i class="bi bi-clipboard-x text-muted" style="font-size:4rem;"></i>
                    <h4 class="mt-3 text-muted">No tests found</h4>
                    <p class="text-muted">Try adjusting your search or filters.</p>
                    <a href="{{ url('/tests') }}" class="btn btn-primary rounded-pill px-4">Reset</a>
                </div>
                @else
                <style>
                    /* Premium Test Card Styles */
                    .test-card-premium {
                        background: #fff;
                        border: 1px solid rgba(0,0,0,0.05);
                        border-radius: 1.25rem;
                        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                        position: relative;
                        overflow: hidden;
                    }
                    .test-card-premium::before {
                        content: '';
                        position: absolute;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 4px;
                        background: linear-gradient(90deg, var(--bs-primary), var(--bs-info));
                        opacity: 0;
                        transition: all 0.3s ease;
                    }
                    .test-card-premium:hover {
                        transform: translateY(-8px);
                        box-shadow: 0 15px 35px rgba(0,0,0,0.08);
                        border-color: rgba(var(--bs-primary-rgb), 0.1);
                    }
                    .test-card-premium:hover::before {
                        opacity: 1;
                    }
                    .test-card-premium .icon-container {
                        width: 55px;
                        height: 55px;
                        background: linear-gradient(135deg, rgba(var(--bs-primary-rgb), 0.1) 0%, rgba(var(--bs-info-rgb), 0.1) 100%);
                        border-radius: 12px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        font-size: 1.5rem;
                        color: var(--bs-primary);
                        transition: all 0.3s ease;
                    }
                    .test-card-premium:hover .icon-container {
                        background: linear-gradient(135deg, var(--bs-primary) 0%, var(--bs-info) 100%);
                        color: white;
                        transform: scale(1.05) rotate(5deg);
                    }
                    .test-badge-premium {
                        background: rgba(var(--bs-primary-rgb), 0.08);
                        color: var(--bs-primary);
                        font-weight: 600;
                        padding: 0.35em 0.8em;
                        border-radius: 20px;
                        font-size: 0.75rem;
                        letter-spacing: 0.5px;
                    }
                    .test-meta-info {
                        display: flex;
                        align-items: center;
                        gap: 15px;
                        flex-wrap: wrap;
                        font-size: 0.82rem;
                        color: #6c757d;
                        margin-top: 15px;
                        padding-top: 15px;
                        border-top: 1px dashed rgba(0,0,0,0.08);
                    }
                    .test-meta-info span {
                        display: flex;
                        align-items: center;
                        gap: 5px;
                    }
                    .test-card-footer {
                        background: #fafbfe;
                        border-top: 1px solid rgba(0,0,0,0.03);
                        padding: 1.25rem 1.5rem;
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        border-radius: 0 0 1.25rem 1.25rem;
                    }
                    .test-price {
                        font-size: 1.25rem;
                        font-weight: 700;
                        color: var(--bs-primary);
                        display: flex;
                        align-items: center;
                        gap: 4px;
                    }
                    .test-price small {
                        font-size: 0.75rem;
                        color: #999;
                        font-weight: normal;
                    }
                </style>

                <div class="row g-4">
                    @foreach($tests as $test)
                    <div class="col-lg-6 col-xl-6" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 4) * 80 }}">
                        <div class="test-card-premium h-100 d-flex flex-column">
                            <div class="p-4 flex-grow-1">
                                <div class="d-flex align-items-start gap-3">
                                    <div class="icon-container flex-shrink-0 shadow-sm">
                                        <i class="bi bi-heart-pulse-fill"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <span class="test-badge-premium">
                                                <i class="bi bi-upc-scan me-1"></i> {{ $test->test_code }}
                                            </span>
                                            @if($test->department)
                                            <span class="badge bg-light text-dark border border-secondary border-opacity-25 rounded-pill px-2 py-1" style="font-size: 0.7rem;">
                                                {{ $test->department->name }}
                                            </span>
                                            @endif
                                        </div>
                                        <h5 class="fw-bold mb-1 text-dark" style="font-size: 1.1rem; line-height: 1.4;">
                                            <a href="{{ url('/tests/'.$test->id) }}" class="text-decoration-none text-dark stretched-link">
                                                {{ $test->name }}
                                            </a>
                                        </h5>
                                        @if($test->description)
                                        <p class="text-muted small mb-0 mt-2 text-truncate" style="max-width: 250px;">
                                            {{ $test->description }}
                                        </p>
                                        @endif
                                    </div>
                                </div>

                                <div class="test-meta-info">
                                    @if($test->specimen_type)
                                    <span title="Sample Type">
                                        <i class="bi bi-droplet-fill text-danger opacity-75"></i> {{ $test->specimen_type }}
                                    </span>
                                    @endif
                                    @if($test->turnaround_time)
                                    <span title="Report Time">
                                        <i class="bi bi-clock-history text-success opacity-75"></i> {{ $test->turnaround_time }}
                                    </span>
                                    @endif
                                    <span title="Category">
                                        <i class="bi bi-tags-fill text-info opacity-75"></i> {{ $test->category ? $test->category->name : 'General' }}
                                    </span>
                                </div>
                            </div>
                            <div class="test-card-footer position-relative z-1">
                                <div class="test-price">
                                    <span>৳{{ number_format($test->price) }}</span>
                                </div>
                                <div class="d-flex gap-2">
                                    <a href="{{ url('/appointment') }}?test={{ $test->id }}" class="btn btn-primary btn-sm rounded-pill px-3 shadow-sm d-flex align-items-center gap-1 fw-semibold position-relative z-3">
                                        <i class="bi bi-calendar-check"></i> Book Now
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="mt-5">
                    {{ $tests->withQueryString()->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection
