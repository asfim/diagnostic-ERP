@extends('layouts.frontend')
@section('title', 'Our Doctors - MediDiag')
@section('content')

<x-frontend.page-banner title="Our Doctors" :breadcrumbs="['Doctors' => url('/doctors')]" />

<section class="section-padding">
    <div class="container">

        {{-- Search & Filter Bar --}}
        <form method="GET" action="{{ url('/doctors') }}" data-aos="fade-up" class="mb-5">
            <div class="row g-3 align-items-end bg-light-soft p-4 rounded-4 shadow-sm">
                <div class="col-md-5">
                    <label class="form-label fw-semibold small">Search Doctor</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 rounded-start-pill">
                            <i class="bi bi-search text-muted"></i>
                        </span>
                        <input type="text" name="search" class="form-control border-start-0 rounded-end-pill"
                               placeholder="Doctor name…" value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold small">Department</label>
                    <select name="department" class="form-select rounded-pill" onchange="this.form.submit()">
                        <option value="">All Departments</option>
                        @foreach($departments as $dept)
                        <option value="{{ $dept->id }}" {{ request('department') == $dept->id ? 'selected' : '' }}>
                            {{ $dept->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary rounded-pill w-100 fw-bold">
                        <i class="bi bi-search me-1"></i> Search
                    </button>
                </div>
            </div>
        </form>

        {{-- Doctor Grid --}}
        @if($doctors->isEmpty())
        <div class="text-center py-5">
            <i class="bi bi-person-x text-muted" style="font-size:4rem;"></i>
            <h4 class="mt-3 text-muted">No doctors found</h4>
        </div>
        @else
        <div class="row g-4">
            @foreach($doctors as $i => $doc)
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 4) * 80 }}">
                <div class="doctor-card-premium h-100">
                    <div class="doc-img-wrapper">
                        @if($doc->photo)
                        <img src="{{ asset('storage/'.$doc->photo) }}" alt="{{ $doc->name }}" class="img-fluid w-100">
                        @else
                        <img src="https://images.unsplash.com/photo-1594824436998-058a23116fc7?auto=format&fit=crop&w=500&q=80" alt="{{ $doc->name }}" class="img-fluid w-100">
                        @endif
                    </div>
                    <div class="doc-body p-4 text-center">
                        <h5 class="fw-bold mb-1">{{ $doc->name }}</h5>
                        <p class="specialty text-primary fw-semibold mb-2">
                            <i class="bi bi-heart-pulse-fill me-1"></i>{{ $doc->department ? $doc->department->name : 'Specialist' }}
                        </p>
                        <p class="degree small text-muted mb-3">{{ $doc->specialization }}</p>
                        
                        <div class="d-flex justify-content-center gap-3 mb-3 border-top pt-3 opacity-75">
                            <div class="text-muted small" title="Experience">
                                <i class="bi bi-briefcase-fill text-primary"></i> {{ $doc->experience_years ?? 0 }} Yrs
                            </div>
                            <div class="text-muted small" title="Fee">
                                <i class="bi bi-cash-coin text-success"></i> ৳{{ $doc->consultation_fee ?? 0 }}
                            </div>
                        </div>

                        <div class="d-flex gap-2 justify-content-center mt-auto">
                            <a href="{{ url('/doctors/'.$doc->id) }}" class="btn btn-outline-primary rounded-pill px-3 w-50">Profile</a>
                            <a href="{{ url('/appointment') }}?doctor={{ $doc->id }}" class="btn btn-primary rounded-pill px-3 w-50 fw-bold">Book</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-5">{{ $doctors->withQueryString()->links() }}</div>
        @endif

    </div>
</section>

@push('styles')
<style>
/* Premium Doctor Card Styles */
.doctor-card-premium {
    background: #ffffff;
    border-radius: 1.25rem;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    border: 1px solid rgba(0, 0, 0, 0.03);
    transition: all 0.3s ease;
    overflow: hidden;
    display: flex;
    flex-direction: column;
}
.doctor-card-premium:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
    border-color: rgba(var(--bs-primary-rgb), 0.15);
}
.doc-img-wrapper {
    position: relative;
    overflow: hidden;
    height: 240px;
}
.doc-img-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: top;
    transition: transform 0.5s ease;
}
.doctor-card-premium:hover .doc-img-wrapper img {
    transform: scale(1.05);
}
.doctor-card-premium .doc-body {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}
</style>
@endpush

@endsection
