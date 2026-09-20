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
                <div class="doctor-card">
                    @if($doc->photo)
                    <img src="{{ asset('storage/'.$doc->photo) }}" alt="{{ $doc->name }}">
                    @else
                    <img src="https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?auto=format&fit=crop&w=500&q=80"
                         alt="{{ $doc->name }}">
                    @endif
                    <div class="doc-body">
                        <h5>{{ $doc->name }}</h5>
                        <p class="specialty">{{ $doc->specialization }}</p>
                        <p class="degree">{{ $doc->qualification }}</p>
                        @if($doc->department)
                        <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill mb-3 small">
                            {{ $doc->department->name }}
                        </span>
                        @endif
                        @if($doc->consultation_fee)
                        <p class="text-primary fw-bold small mb-3">Fee: ৳ {{ number_format($doc->consultation_fee) }}</p>
                        @endif
                        <div class="d-flex gap-2 justify-content-center">
                            <a href="{{ url('/doctors/'.$doc->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">Profile</a>
                            <a href="{{ url('/appointment') }}?doctor={{ $doc->id }}" class="btn btn-sm btn-primary rounded-pill px-3">Book</a>
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

@endsection
