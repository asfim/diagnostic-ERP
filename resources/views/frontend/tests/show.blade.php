@extends('layouts.frontend')
@section('title', $test->name . ' - MediDiag Tests')
@section('content')

<x-frontend.page-banner :title="$test->name"
    :breadcrumbs="['Tests' => url('/tests'), $test->name => '#']" />

<section class="section-padding">
    <div class="container">
        <div class="row g-5">

            {{-- Test Details --}}
            <div class="col-lg-8" data-aos="fade-right">
                <div class="card border-0 shadow-sm rounded-4 p-4 p-lg-5 mb-4">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="icon-box bg-primary bg-opacity-10 text-primary rounded-3" style="width:64px;height:64px;">
                            <i class="bi bi-clipboard2-pulse fs-2"></i>
                        </div>
                        <div>
                            <span class="badge bg-primary rounded-pill px-3 mb-1">{{ $test->test_code }}</span>
                            <h2 class="fw-bold mb-0">{{ $test->name }}</h2>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        @if($test->department)
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center gap-2 bg-light-soft p-3 rounded-3">
                                <i class="bi bi-building text-primary fs-5"></i>
                                <div><small class="text-muted d-block">Department</small><strong>{{ $test->department->name }}</strong></div>
                            </div>
                        </div>
                        @endif
                        @if($test->specimen_type)
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center gap-2 bg-light-soft p-3 rounded-3">
                                <i class="bi bi-droplet text-danger fs-5"></i>
                                <div><small class="text-muted d-block">Sample Type</small><strong>{{ $test->specimen_type }}</strong></div>
                            </div>
                        </div>
                        @endif
                        @if($test->turnaround_time)
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center gap-2 bg-light-soft p-3 rounded-3">
                                <i class="bi bi-clock text-success fs-5"></i>
                                <div><small class="text-muted d-block">Report Time</small><strong>{{ $test->turnaround_time }}</strong></div>
                            </div>
                        </div>
                        @endif
                        @if($test->container)
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center gap-2 bg-light-soft p-3 rounded-3">
                                <i class="bi bi-box2 text-warning fs-5"></i>
                                <div><small class="text-muted d-block">Container</small><strong>{{ $test->container }}</strong></div>
                            </div>
                        </div>
                        @endif
                    </div>

                    {{-- Preparation Instructions (placeholder) --}}
                    <h5 class="fw-bold mb-3 border-bottom pb-2">Preparation Instructions</h5>
                    <ul class="text-muted">
                        <li class="mb-2">Fast for 8–12 hours before the test (water is allowed).</li>
                        <li class="mb-2">Avoid strenuous exercise 24 hours before the test.</li>
                        <li class="mb-2">Bring a valid government ID and previous reports if available.</li>
                        <li class="mb-2">Inform us of any medications you are currently taking.</li>
                    </ul>
                </div>

                {{-- Related Tests --}}
                @if($related->count())
                <div>
                    <h5 class="fw-bold mb-3">Related Tests</h5>
                    <div class="row g-3">
                        @foreach($related as $r)
                        <div class="col-sm-6">
                            <div class="card border-0 shadow-sm rounded-3 p-3 d-flex flex-row align-items-center gap-3">
                                <i class="bi bi-droplet-fill text-primary fs-4"></i>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0 fw-bold small">{{ $r->name }}</h6>
                                    <span class="text-primary fw-bold small">৳ {{ number_format($r->price) }}</span>
                                </div>
                                <a href="{{ url('/tests/'.$r->id) }}" class="btn btn-sm btn-outline-primary rounded-pill">View</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            {{-- Booking Sidebar --}}
            <div class="col-lg-4" data-aos="fade-left">
                <div class="card border-0 shadow-lg rounded-4 p-4 sticky-top" style="top:90px;">
                    <div class="text-center border-bottom pb-4 mb-4">
                        <p class="text-muted mb-1 small">Test Price</p>
                        <h2 class="fw-bold text-primary display-5">৳ {{ number_format($test->price) }}</h2>
                        <p class="text-muted small mb-0">Home collection extra ৳ 200</p>
                    </div>
                    <div class="d-grid gap-3">
                        <a href="{{ url('/appointment') }}?test={{ $test->id }}" class="btn btn-primary btn-lg rounded-pill fw-bold">
                            <i class="bi bi-calendar-check me-2"></i>Book This Test
                        </a>
                        <a href="https://wa.me/8801711000000?text=I want to book {{ urlencode($test->name) }}" class="btn btn-success btn-lg rounded-pill fw-bold" target="_blank">
                            <i class="bi bi-whatsapp me-2"></i>WhatsApp Booking
                        </a>
                        <a href="tel:+8801711000000" class="btn btn-outline-primary btn-lg rounded-pill fw-bold">
                            <i class="bi bi-telephone me-2"></i>Call to Book
                        </a>
                    </div>
                    <div class="mt-4 pt-3 border-top">
                        <div class="d-flex gap-2 align-items-start mb-2">
                            <i class="bi bi-shield-check text-success mt-1"></i>
                            <small class="text-muted">ISO certified accurate results</small>
                        </div>
                        <div class="d-flex gap-2 align-items-start mb-2">
                            <i class="bi bi-clock text-success mt-1"></i>
                            <small class="text-muted">Fast report delivery online</small>
                        </div>
                        <div class="d-flex gap-2 align-items-start">
                            <i class="bi bi-truck text-success mt-1"></i>
                            <small class="text-muted">Home collection available</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
