@extends('layouts.frontend')
@section('title', $department->name . ' - MediDiag')
@section('content')

<x-frontend.page-banner :title="$department->name"
    :breadcrumbs="['Departments' => url('/departments'), $department->name => '#']" />

<section class="section-padding">
    <div class="container">

        {{-- Department Intro --}}
        <div class="row align-items-center g-5 mb-5" data-aos="fade-up">
            <div class="col-lg-6">
                <span class="label" style="color:var(--secondary);font-weight:700;text-transform:uppercase;font-size:.8rem;">{{ $department->name }}</span>
                <h2 class="fw-bold mt-2 mb-3">{{ $department->name }} Department</h2>
                <p class="text-muted lead">{{ $department->description ?? 'Our '.$department->name.' department is equipped with world-class technology and staffed by experienced specialists dedicated to providing accurate and timely diagnostic results.' }}</p>
            </div>
            <div class="col-lg-6 text-center text-lg-end">
                <div class="d-inline-flex gap-4">
                    <div class="text-center">
                        <h3 class="fw-bold text-primary">{{ $doctors->count() }}</h3>
                        <small class="text-muted">Doctors</small>
                    </div>
                    <div class="text-center">
                        <h3 class="fw-bold text-secondary">{{ $tests->count() }}</h3>
                        <small class="text-muted">Tests</small>
                    </div>
                    <div class="text-center">
                        <h3 class="fw-bold text-success">24/7</h3>
                        <small class="text-muted">Available</small>
                    </div>
                </div>
            </div>
        </div>

        {{-- Doctors --}}
        @if($doctors->count())
        <div class="mb-5">
            <h4 class="fw-bold mb-4">Specialist Doctors</h4>
            <div class="row g-4">
                @foreach($doctors as $doc)
                <div class="col-lg-3 col-md-6" data-aos="fade-up">
                    <div class="doctor-card">
                        @if($doc->photo)
                        <img src="{{ asset('storage/'.$doc->photo) }}" alt="{{ $doc->name }}">
                        @else
                        <img src="https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?auto=format&fit=crop&w=500&q=80" alt="{{ $doc->name }}">
                        @endif
                        <div class="doc-body">
                            <h5>{{ $doc->name }}</h5>
                            <p class="specialty">{{ $doc->specialization }}</p>
                            <p class="degree">{{ $doc->qualification }}</p>
                            <div class="d-flex gap-2 justify-content-center">
                                <a href="{{ url('/doctors/'.$doc->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">Profile</a>
                                <a href="{{ url('/appointment') }}?doctor={{ $doc->id }}" class="btn btn-sm btn-primary rounded-pill px-3">Book</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Tests --}}
        @if($tests->count())
        <div>
            <h4 class="fw-bold mb-4">Available Tests</h4>
            <div class="row g-3">
                @foreach($tests as $test)
                <div class="col-lg-4 col-md-6" data-aos="fade-up">
                    <div class="card border-0 shadow-sm rounded-3 p-3 d-flex flex-row align-items-center gap-3">
                        <i class="bi bi-droplet-fill text-primary fs-4 flex-shrink-0"></i>
                        <div class="flex-grow-1">
                            <h6 class="mb-0 fw-bold small">{{ $test->name }}</h6>
                            <small class="text-muted">{{ $test->specimen_type ?? 'Blood' }}</small>
                        </div>
                        <div class="text-end">
                            <span class="fw-bold text-primary small">৳ {{ number_format($test->price) }}</span><br>
                            <a href="{{ url('/appointment') }}?test={{ $test->id }}" class="btn btn-sm btn-outline-primary rounded-pill mt-1">Book</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- CTA --}}
        <div class="text-center mt-5 pt-3">
            <a href="{{ url('/appointment') }}" class="btn btn-primary btn-lg rounded-pill px-5 fw-bold me-2">
                <i class="bi bi-calendar-check me-2"></i>Book Appointment
            </a>
            <a href="{{ url('/contact') }}" class="btn btn-outline-primary btn-lg rounded-pill px-4 fw-bold">
                Contact Us
            </a>
        </div>
    </div>
</section>

@endsection
