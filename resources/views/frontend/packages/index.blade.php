@extends('layouts.frontend')
@section('title', 'Health Packages - MediDiag')
@section('content')

<x-frontend.page-banner title="Health Packages" :breadcrumbs="['Packages' => url('/packages')]" />

<section class="section-padding">
    <div class="container">
        <div class="section-header centered mb-5" data-aos="fade-up">
            <span class="label">Preventive Care</span>
            <h2>Choose the Right Package for You</h2>
            <p class="mt-2">Comprehensive health checkup packages at transparent prices, tailored to your needs.</p>
        </div>

        @if($packages->isEmpty())
        <div class="text-center py-5">
            <i class="bi bi-box-seam text-muted" style="font-size:4rem;"></i>
            <h4 class="mt-3 text-muted">No packages available yet.</h4>
            <a href="{{ url('/contact') }}" class="btn btn-primary rounded-pill px-4 mt-3">Contact Us</a>
        </div>
        @else
        <div class="row g-4">
            @foreach($packages as $i => $pkg)
            @php
                $discounted = $pkg->discount_price ?? $pkg->price;
                $savings = $pkg->price - $discounted;
                $pct = $savings > 0 && $pkg->price > 0 ? round(($savings / $pkg->price) * 100) : 0;
                $featured = $i === 1; // middle card is featured
            @endphp
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($i+1)*100 }}">
                <div class="package-card {{ $featured ? 'featured' : '' }}">
                    <div class="pkg-header {{ $featured ? 'bg-success' : 'bg-primary' }} text-white">
                        @if($pkg->image)
                            <img src="{{ asset('storage/' . $pkg->image) }}" alt="{{ $pkg->name }}" class="pkg-cover">
                        @else
                            <div class="pkg-icon"><i class="bi bi-shield-check"></i></div>
                        @endif
                        @if($featured)
                            <div class="pkg-badge bg-warning text-dark">⭐ Popular</div>
                        @elseif($pct > 0)
                            <div class="pkg-badge bg-danger">Save {{ $pct }}%</div>
                        @endif
                        <h4 class="fw-bold mt-2 mb-0">{{ $pkg->name }}</h4>
                        <div class="pkg-price">
                            ৳ {{ number_format($discounted) }}
                            @if($savings > 0)
                            <small>৳ {{ number_format($pkg->price) }}</small>
                            @endif
                        </div>
                        <p class="small mt-2 mb-0 opacity-75">
                            {{ $pkg->tests->count() }} Tests Included
                        </p>
                    </div>
                    <div class="pkg-body">
                        @if($pkg->description)
                        <p class="pkg-description text-muted text-center small mb-3">{{ Str::limit($pkg->description, 100) }}</p>
                        @endif
                        <ul class="list-unstyled">
                            @foreach($pkg->tests->take(5) as $test)
                            <li><i class="bi bi-check-circle-fill"></i> {{ $test->name }}</li>
                            @endforeach
                            @if($pkg->tests->count() > 5)
                            <li class="text-muted small">+ {{ $pkg->tests->count() - 5 }} more tests…</li>
                            @endif
                        </ul>
                        <div class="d-grid gap-2 mt-3">
                            <a href="{{ url('/packages/'.$pkg->id) }}" class="btn btn-outline-primary rounded-pill">View Details</a>
                            <a href="{{ url('/appointment') }}?package={{ $pkg->id }}" class="btn {{ $featured ? 'btn-success' : 'btn-primary' }} rounded-pill">Book Now</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>

@endsection
