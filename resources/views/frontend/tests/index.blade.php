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
                <div class="row g-4">
                    @foreach($tests as $test)
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 80 }}">
                        <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden test-list-card">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="icon-box bg-primary bg-opacity-10 text-primary rounded-3 flex-shrink-0 me-3"
                                         style="width:50px;height:50px;">
                                        <i class="bi bi-droplet-fill fs-4"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="badge bg-primary bg-opacity-10 text-primary small mb-1">
                                            {{ $test->test_code }}
                                        </span>
                                        <h6 class="fw-bold mb-0">{{ $test->name }}</h6>
                                    </div>
                                </div>

                                <div class="d-flex flex-wrap gap-2 mb-3 text-muted small">
                                    @if($test->department)
                                    <span><i class="bi bi-building text-primary me-1"></i>{{ $test->department->name }}</span>
                                    @endif
                                    @if($test->specimen_type)
                                    <span><i class="bi bi-droplet text-danger me-1"></i>{{ $test->specimen_type }}</span>
                                    @endif
                                    @if($test->turnaround_time)
                                    <span><i class="bi bi-clock text-success me-1"></i>{{ $test->turnaround_time }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="card-footer bg-white border-top px-4 py-3 d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-primary fs-5">৳ {{ number_format($test->price) }}</span>
                                <div class="d-flex gap-2">
                                    <a href="{{ url('/tests/'.$test->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">Details</a>
                                    <a href="{{ url('/appointment') }}?test={{ $test->id }}" class="btn btn-sm btn-primary rounded-pill px-3">Book</a>
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
