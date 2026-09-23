@extends('layouts.frontend')

@section('title', 'About Us - MediDiag')

@section('content')

<!-- Page Banner -->
<x-frontend.page-banner title="About Us" :breadcrumbs="['About Us' => url('/about')]" />
@php
    $aboutImage = !empty($about['about_image']) ? asset('storage/' . $about['about_image']) : (!empty($about['image']) ? asset('storage/' . $about['image']) : 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=700&q=80');
@endphp

<!-- About Diagnostic Center -->
<section class="section-padding bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right">
                <div class="row g-3">
                    <div class="col-6">
                        <img src="{{ $aboutImage }}" alt="{{ $about['title'] ?? 'About MediDiag' }}" class="img-fluid rounded-4 shadow mb-3">
                        <img src="{{ $aboutImage }}" alt="{{ $about['title'] ?? 'About MediDiag' }}" class="img-fluid rounded-4 shadow">
                    </div>
                    <div class="col-6 mt-4">
                        <img src="{{ $aboutImage }}" alt="{{ $about['title'] ?? 'About MediDiag' }}" class="img-fluid rounded-4 shadow mb-3">
                        <div class="bg-primary text-white p-4 rounded-4 shadow text-center">
                            <h2 class="display-5 fw-bold mb-0">{{ $about['years_number'] ?? '15+' }}</h2>
                            <p class="mb-0 fw-bold">{{ $about['years_text'] ?? 'Years Experience' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 ps-lg-5" data-aos="fade-left">
                <span class="text-secondary fw-bold text-uppercase">{{ $about['label'] ?? 'Who We Are' }}</span>
                <h2 class="display-6 fw-bold text-dark mt-2 mb-4">{{ $about['title'] ?? 'Dedicated to Precision and Care' }}</h2>
                <p class="lead text-muted mb-4">{{ $about['description'] ?? 'We provide comprehensive diagnostic services with a commitment to accuracy, reliability, and patient comfort.' }}</p>

                @if(!empty($about['features']))
                    <div class="row g-2 mb-4">
                        @foreach($about['features'] as $feature)
                            @if($feature)
                                <div class="col-sm-6"><div class="d-flex align-items-center gap-2 text-muted small"><i class="bi bi-check-circle-fill text-secondary"></i>{{ $feature }}</div></div>
                            @endif
                        @endforeach
                    </div>
                @endif
                
                @if(!empty($about['quote']))
                <div class="d-flex align-items-center mb-4 bg-light-soft p-3 rounded-3 border-start border-4 border-secondary">
                    <i class="bi bi-quote fs-1 text-secondary me-3 opacity-50"></i>
                    <p class="mb-0 fst-italic text-dark fw-medium">"{{ $about['quote'] }}"</p>
                </div>
                @endif
                
                <div class="row g-4 text-center mt-2">
                    <div class="col-4">
                        <h3 class="text-primary fw-bold mb-1">{{ $stats['doctors'] ?? '50+' }}</h3>
                        <p class="text-muted small mb-0">Specialist Doctors</p>
                    </div>
                    <div class="col-4 border-start border-end">
                        <h3 class="text-primary fw-bold mb-1">{{ $stats['patients'] ?? '100k+' }}</h3>
                        <p class="text-muted small mb-0">Happy Patients</p>
                    </div>
                    <div class="col-4">
                        <h3 class="text-primary fw-bold mb-1">{{ $stats['tests'] ?? '500+' }}</h3>
                        <p class="text-muted small mb-0">Tests Available</p>
                    </div>
                </div>
                @if(!empty($about['button_text']))
                    <a href="{{ $about['button_link'] ?? url('/contact') }}" class="btn btn-primary mt-4">{{ $about['button_text'] }} <i class="bi bi-arrow-right ms-1"></i></a>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Mission & Vision -->
<section class="section-padding bg-light-soft">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card card-soft border-0 h-100 p-4">
                    <div class="card-body">
                        <div class="icon-box bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 80px; height: 80px;">
                            <i class="bi bi-bullseye fs-1"></i>
                        </div>
                        <h3 class="fw-bold mb-3">{{ $about['mission_title'] ?? 'Our Mission' }}</h3>
                        <p class="text-muted">{{ $about['mission_text'] ?? 'To deliver precise, timely, and affordable diagnostic services to all segments of society while maintaining the highest ethical standards.' }}</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="card card-soft border-0 h-100 p-4">
                    <div class="card-body">
                        <div class="icon-box bg-secondary bg-opacity-10 text-secondary rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 80px; height: 80px;">
                            <i class="bi bi-eye fs-1"></i>
                        </div>
                        <h3 class="fw-bold mb-3">{{ $about['vision_title'] ?? 'Our Vision' }}</h3>
                        <p class="text-muted">{{ $about['vision_text'] ?? 'To become the leading and most trusted healthcare diagnostic brand in South Asia.' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Core Values -->
<section class="section-padding bg-white">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="fw-bold text-dark mt-2">Our Core Values</h2>
        </div>
        <div class="row g-4">
            @foreach($about['values'] ?? [] as $valueIndex => $value)
            <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="{{ ($valueIndex + 1) * 100 }}">
                <div class="text-center p-4 border rounded-4 border-light shadow-sm h-100">
                    <i class="bi {{ $value['icon'] ?? 'bi-star' }} text-{{ $value['color'] ?? 'primary' }} fs-1 mb-3"></i>
                    <h5 class="fw-bold">{{ $value['title'] ?? '' }}</h5>
                    <p class="text-muted small">{{ $value['description'] ?? '' }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Infrastructure & Certifications -->
<section class="section-padding bg-primary text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-right">
                <h2 class="fw-bold mb-4">{{ $about['infrastructure_title'] ?? 'World-Class Infrastructure' }}</h2>
                <p class="lead mb-4 text-white-50">{{ $about['infrastructure_text'] ?? 'Our laboratories are equipped with fully automated analyzers, ensuring zero manual error and fastest report delivery.' }}</p>
                <ul class="list-unstyled mb-4">
                    @foreach($about['infrastructure_points'] ?? [] as $point)
                        <li class="mb-3 d-flex align-items-center"><i class="bi bi-check-circle-fill text-secondary me-3 fs-5"></i> {{ $point }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <img src="{{ !empty($about['infrastructure_image']) ? asset('storage/' . $about['infrastructure_image']) : 'https://images.unsplash.com/photo-1579154204601-01588f351e67?auto=format&fit=crop&w=800&q=80' }}" alt="{{ $about['infrastructure_title'] ?? 'Lab Equipment' }}" class="img-fluid rounded-4 shadow-lg border border-4 border-white border-opacity-25">
            </div>
        </div>
    </div>
</section>

@endsection
