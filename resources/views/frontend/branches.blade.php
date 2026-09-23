@extends('layouts.frontend')
@section('title', 'Our Branches - MediDiag')
@section('content')

<x-frontend.page-banner title="Our Network" :breadcrumbs="['Home' => url('/'), 'Branches' => url('/branches')]" />

<section class="section-padding bg-light-soft">
    <div class="container">
        <div class="section-header centered" data-aos="fade-up">
            <span class="label">Find Us</span>
            <h2>Our Diagnostic Centers</h2>
            <p>We are expanding our network to provide world-class diagnostic services closer to your home.</p>
        </div>

        <div class="row g-4 justify-content-center">
            @php $delay = 100; @endphp
            
            {{-- Active Branches --}}
            @foreach($activeBranches as $branch)
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="{{ $delay }}">
                    <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
                        <div class="row g-0 h-100">
                            <div class="col-md-5">
                                <img src="{{ $branch->image_url }}" class="img-fluid h-100 object-fit-cover w-100" alt="{{ $branch->name }}" style="min-height: 220px;">
                            </div>
                            <div class="col-md-7">
                                <div class="card-body p-4 d-flex flex-column justify-content-center h-100">
                                    @if($branch->badge)
                                        <div class="badge bg-primary mb-2 align-self-start">{{ $branch->badge }}</div>
                                    @endif
                                    <h4 class="fw-bold mb-3">{{ $branch->name }}</h4>
                                    
                                    <ul class="list-unstyled text-muted small mb-4">
                                        @if($branch->address)
                                            <li class="mb-2"><i class="bi bi-geo-alt-fill text-primary me-2"></i> {{ $branch->address }}</li>
                                        @endif
                                        @if($branch->phone)
                                            <li class="mb-2"><i class="bi bi-telephone-fill text-primary me-2"></i> {{ $branch->phone }}</li>
                                        @endif
                                        @if($branch->email)
                                            <li class="mb-2"><i class="bi bi-envelope-fill text-primary me-2"></i> {{ $branch->email }}</li>
                                        @endif
                                        @if($branch->opening_hours)
                                            <li><i class="bi bi-clock-fill text-primary me-2"></i> {{ $branch->opening_hours }}</li>
                                        @endif
                                    </ul>
                                    
                                    @if($branch->map_link)
                                        <a href="{{ $branch->map_link }}" target="_blank" class="btn btn-outline-primary btn-sm rounded-pill fw-bold w-100 mt-auto">
                                            <i class="bi bi-map me-1"></i> View on Map
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @php $delay += 100; @endphp
            @endforeach

            {{-- Upcoming Branches --}}
            @foreach($upcomingBranches as $branch)
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="{{ $delay }}">
                    <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden bg-primary bg-opacity-10 border border-primary border-opacity-25">
                        <div class="card-body p-5 d-flex flex-column align-items-center justify-content-center text-center h-100">
                            @if($branch->image)
                                <img src="{{ $branch->image_url }}" class="rounded-circle mb-3 object-fit-cover shadow-sm" style="width: 80px; height: 80px;" alt="{{ $branch->name }}">
                            @else
                                <div class="icon-box bg-white text-primary rounded-circle mb-3 d-inline-flex align-items-center justify-content-center shadow-sm" style="width: 70px; height: 70px;">
                                    <i class="bi bi-building-add fs-2"></i>
                                </div>
                            @endif
                            
                            <h4 class="fw-bold mb-2">{{ $branch->name }}</h4>
                            
                            @if($branch->description)
                                <p class="text-primary mb-3">{{ $branch->description }}</p>
                            @endif

                            @if($branch->address)
                                <p class="text-muted small mb-3"><i class="bi bi-geo-alt-fill text-primary me-1"></i>{{ $branch->address }}</p>
                            @endif
                            
                            <span class="badge bg-primary px-4 py-2 rounded-pill shadow-sm">
                                {{ $branch->badge ?? 'Coming Soon' }}
                            </span>
                        </div>
                    </div>
                </div>
                @php $delay += 100; @endphp
            @endforeach

            @if($activeBranches->isEmpty() && $upcomingBranches->isEmpty())
                <div class="col-12 text-center py-5">
                    <p class="text-muted">No branches available at the moment.</p>
                </div>
            @endif
        </div>
    </div>
</section>

@endsection
