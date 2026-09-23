@extends('layouts.frontend')
@section('title', 'Home Sample Collection - MediDiag')
@section('content')

<x-frontend.page-banner title="Home Sample Collection" :breadcrumbs="['Services' => '#', 'Home Collection' => route('frontend.home-collection')]" />

@if(session('success'))
<section class="section-padding pb-0"><div class="container"><div class="alert alert-success border-0 shadow-sm"><i class="bi bi-check-circle me-2"></i>{{ session('success') }}</div></div></section>
@endif

<section class="section-padding bg-white">
    <div class="container"><div class="row align-items-center g-5">
        <div class="col-lg-6" data-aos="fade-right">
            @if(!empty($content['image']))
                <img src="{{ asset('storage/' . $content['image']) }}" alt="{{ $content['title'] }}" class="home-collection-hero-image">
            @else
                <img src="https://images.unsplash.com/photo-1618015359945-f09c6258edb5?auto=format&fit=crop&w=800&q=80" alt="Home Collection" class="home-collection-hero-image">
            @endif
        </div>
        <div class="col-lg-6" data-aos="fade-left">
            <span class="label text-secondary fw-bold text-uppercase tracking-wide">{{ $content['label'] }}</span>
            <h2 class="display-6 fw-bold mt-2 mb-4 text-dark">{{ $content['title'] }}</h2>
            <p class="lead text-muted mb-4">{{ $content['description'] }}</p>
            @foreach($content['features'] as $feature)
                <div class="d-flex align-items-start mb-4"><div class="icon-box bg-primary bg-opacity-10 text-primary rounded-circle me-3" style="width:50px;height:50px;flex:0 0 50px;"><i class="bi {{ $feature['icon'] }} fs-4"></i></div><div><h5 class="fw-bold mb-1">{{ $feature['title'] }}</h5><p class="text-muted small mb-0">{{ $feature['description'] }}</p></div></div>
            @endforeach
            <a href="#bookingForm" class="btn btn-primary rounded-pill px-4 py-2 mt-2 fw-bold">Book Collection Now <i class="bi bi-arrow-down ms-1"></i></a>
        </div>
    </div></div>
</section>

<section id="bookingForm" class="section-padding bg-light-soft"><div class="container"><div class="section-header centered" data-aos="fade-up"><span class="label">Booking Request</span><h2>Request Home Collection</h2><p>Fill out the form and our care team will contact you to confirm your booking.</p></div><div class="row justify-content-center"><div class="col-lg-8" data-aos="fade-up"><div class="card card-soft border-0 shadow-sm p-4 p-md-5">
<form action="{{ route('frontend.home-collection.store') }}" method="POST">@csrf
@if($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
<div class="row g-4"><div class="col-md-6"><label class="form-label fw-bold">Patient Name <span class="text-danger">*</span></label><input name="patient_name" value="{{ old('patient_name') }}" type="text" class="form-control rounded-pill px-4" placeholder="Enter full name" required></div><div class="col-md-6"><label class="form-label fw-bold">Mobile Number <span class="text-danger">*</span></label><input name="phone" value="{{ old('phone') }}" type="tel" class="form-control rounded-pill px-4" placeholder="+880 1..." required></div><div class="col-md-6"><label class="form-label fw-bold">Preferred Date <span class="text-danger">*</span></label><input name="preferred_date" value="{{ old('preferred_date') }}" min="{{ now()->format('Y-m-d') }}" type="date" class="form-control rounded-pill px-4" required></div><div class="col-md-6"><label class="form-label fw-bold">Preferred Time <span class="text-danger">*</span></label><select name="preferred_time" class="form-select rounded-pill px-4" required><option value="">Select Time Slot...</option>@foreach(['07:00 AM - 09:00 AM','09:00 AM - 11:00 AM','11:00 AM - 01:00 PM','02:00 PM - 05:00 PM'] as $slot)<option @selected(old('preferred_time') === $slot)>{{ $slot }}</option>@endforeach</select></div><div class="col-12"><label class="form-label fw-bold">Detailed Address <span class="text-danger">*</span></label><textarea name="address" class="form-control rounded-4 p-3" rows="3" placeholder="House/Flat No, Road, Area..." required>{{ old('address') }}</textarea></div><div class="col-12"><label class="form-label fw-bold">Tests Required (Optional)</label><input name="tests_required" value="{{ old('tests_required') }}" type="text" class="form-control rounded-pill px-4" placeholder="E.g., CBC, Lipid Profile, etc."></div><div class="col-12 mt-4 text-center"><button type="submit" class="btn btn-secondary btn-lg rounded-pill px-5 fw-bold"><i class="bi bi-send me-2"></i>Submit Request</button></div></div></form>
</div></div></div></div></section>
@endsection
