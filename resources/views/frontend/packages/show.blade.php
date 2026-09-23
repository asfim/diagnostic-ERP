@extends('layouts.frontend')
@section('title', $package->name . ' - MediDiag')
@section('content')

<x-frontend.page-banner :title="$package->name"
    :breadcrumbs="['Packages' => url('/packages'), $package->name => '#']" />

<section class="section-padding">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8" data-aos="fade-right">
                @if($package->description)
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <h4 class="fw-bold mb-3">Package Overview</h4>
                    <p class="text-muted">{{ $package->description }}</p>
                </div>
                @endif

                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <h4 class="fw-bold mb-3">
                        <i class="bi bi-clipboard-check text-primary me-2"></i>
                        Included Tests ({{ $package->tests->count() }})
                    </h4>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Test Name</th>
                                    <th>Department</th>
                                    <th>Sample</th>
                                    <th>Report Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($package->tests as $i => $test)
                                <tr>
                                    <td><span class="badge bg-primary bg-opacity-10 text-primary">{{ $i+1 }}</span></td>
                                    <td class="fw-semibold">{{ $test->name }}</td>
                                    <td><span class="text-muted small">{{ $test->department->name ?? '—' }}</span></td>
                                    <td><span class="text-muted small">{{ $test->specimen_type ?? '—' }}</span></td>
                                    <td><span class="text-success small">{{ $test->turnaround_time ?? 'Same day' }}</span></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <h4 class="fw-bold mb-3">Preparation Instructions</h4>
                    <ul class="text-muted">
                        <li class="mb-2">Fast for 10–12 hours before the test (water is allowed).</li>
                        <li class="mb-2">Do not take any medication unless necessary.</li>
                        <li class="mb-2">Arrive at the center at least 15 minutes early.</li>
                        <li class="mb-2">Bring your booking confirmation and a valid ID.</li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-4" data-aos="fade-left">
                <div class="card border-0 shadow-lg rounded-4 p-4 sticky-top" style="top:90px;">
                    @php
                        $discounted = $package->discount_price ?? $package->price;
                        $savings = $package->price - $discounted;
                    @endphp
                    <div class="text-center border-bottom pb-4 mb-4">
                        <p class="text-muted mb-1 small">Package Price</p>
                        <h2 class="fw-bold text-primary display-5">৳ {{ number_format($discounted) }}</h2>
                        @if($savings > 0)
                        <p class="text-muted text-decoration-line-through mb-0">৳ {{ number_format($package->price) }}</p>
                        <span class="badge bg-danger rounded-pill mt-1">Save ৳ {{ number_format($savings) }}</span>
                        @endif
                    </div>
                    <div class="d-grid gap-3">
                        @php
                            $waNumber = \App\Models\Setting::get('site_whatsapp', '8801711000000');
                            $waMessage = urlencode("Hello, I would like to book the package: {$package->name}");
                            $phone = \App\Models\Setting::get('site_phone', '+8801711000000');
                        @endphp
                        <a href="{{ url('/appointment') }}?package={{ $package->id }}" class="btn btn-primary btn-lg rounded-pill fw-bold">
                            <i class="bi bi-calendar-check me-2"></i>Book Package
                        </a>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $waNumber) }}?text={{ $waMessage }}" class="btn btn-success btn-lg rounded-pill fw-bold" target="_blank">
                            <i class="bi bi-whatsapp me-2"></i>WhatsApp Booking
                        </a>
                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}" class="btn btn-outline-primary btn-lg rounded-pill fw-bold">
                            <i class="bi bi-telephone me-2"></i>Call to Book
                        </a>
                    </div>
                    <div class="mt-4 pt-3 border-top text-center">
                        <small class="text-muted">
                            <i class="bi bi-shield-check text-success me-1"></i>
                            100% Accurate Results &bull; Home Collection Available
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
