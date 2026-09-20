@extends('layouts.frontend')
@section('title', 'Home Sample Collection - MediDiag')
@section('content')

<x-frontend.page-banner title="Home Sample Collection" :breadcrumbs="['Services' => '#', 'Home Collection' => url('/home-collection')]" />

<section class="section-padding bg-white">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <img src="https://images.unsplash.com/photo-1618015359945-f09c6258edb5?auto=format&fit=crop&w=800&q=80" alt="Home Collection" class="img-fluid rounded-4 shadow-lg border border-4 border-light">
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <span class="label text-secondary fw-bold text-uppercase tracking-wide">Convenience First</span>
                <h2 class="display-6 fw-bold mt-2 mb-4 text-dark">Diagnostics at Your Doorstep</h2>
                <p class="lead text-muted mb-4">Why travel to a clinic when you can get your blood and samples collected safely from the comfort of your home? Our certified phlebotomists ensure a painless, hygienic, and precise collection process.</p>
                
                <div class="d-flex align-items-start mb-4">
                    <div class="icon-box bg-primary bg-opacity-10 text-primary rounded-circle me-3" style="width: 50px; height: 50px;">
                        <i class="bi bi-shield-check fs-4"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1">Safe & Hygienic</h5>
                        <p class="text-muted small mb-0">Single-use sterile equipment and strict COVID-19 protocols followed.</p>
                    </div>
                </div>
                
                <div class="d-flex align-items-start mb-4">
                    <div class="icon-box bg-secondary bg-opacity-10 text-secondary rounded-circle me-3" style="width: 50px; height: 50px;">
                        <i class="bi bi-clock fs-4"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1">On-Time Collection</h5>
                        <p class="text-muted small mb-0">Choose your preferred time slot, and our team will be there precisely on time.</p>
                    </div>
                </div>
                
                <a href="#bookingForm" class="btn btn-primary rounded-pill px-4 py-2 mt-2 fw-bold">Book Collection Now <i class="bi bi-arrow-down ms-1"></i></a>
            </div>
        </div>
    </div>
</section>

<section id="bookingForm" class="section-padding bg-light-soft">
    <div class="container">
        <div class="section-header centered" data-aos="fade-up">
            <span class="label">Booking Request</span>
            <h2>Request Home Collection</h2>
            <p>Fill out the simple form below, and our care team will contact you shortly to confirm your booking.</p>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-8" data-aos="fade-up" data-aos-delay="100">
                <div class="card card-soft border-0 shadow-sm p-4 p-md-5">
                    <form>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Patient Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control rounded-pill px-4" placeholder="Enter full name" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Mobile Number <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control rounded-pill px-4" placeholder="+880 1..." required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Preferred Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control rounded-pill px-4" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Preferred Time <span class="text-danger">*</span></label>
                                <select class="form-select rounded-pill px-4" required>
                                    <option value="">Select Time Slot...</option>
                                    <option>07:00 AM - 09:00 AM</option>
                                    <option>09:00 AM - 11:00 AM</option>
                                    <option>11:00 AM - 01:00 PM</option>
                                    <option>02:00 PM - 05:00 PM</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold">Detailed Address <span class="text-danger">*</span></label>
                                <textarea class="form-control rounded-4 p-3" rows="3" placeholder="House/Flat No, Road, Area..." required></textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold">Tests Required (Optional)</label>
                                <input type="text" class="form-control rounded-pill px-4" placeholder="E.g., CBC, Lipid Profile, etc.">
                            </div>
                            <div class="col-12 mt-4 text-center">
                                <button type="button" class="btn btn-secondary btn-lg rounded-pill px-5 fw-bold" onclick="alert('Booking functionality would submit to backend here!')">
                                    <i class="bi bi-send me-2"></i> Submit Request
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
