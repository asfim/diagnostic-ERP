@extends('layouts.frontend')

@section('title', 'About Us - MediDiag')

@section('content')

<!-- Page Banner -->
<x-frontend.page-banner title="About Us" :breadcrumbs="['About Us' => url('/about')]" />

<!-- About Diagnostic Center -->
<section class="section-padding bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right">
                <div class="row g-3">
                    <div class="col-6">
                        <img src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=400&q=80" alt="Hospital Building" class="img-fluid rounded-4 shadow mb-3">
                        <img src="https://images.unsplash.com/photo-1582719508461-905c673771fd?auto=format&fit=crop&w=400&q=80" alt="Lab tech" class="img-fluid rounded-4 shadow">
                    </div>
                    <div class="col-6 mt-4">
                        <img src="https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&w=400&q=80" alt="Medical professional" class="img-fluid rounded-4 shadow mb-3">
                        <div class="bg-primary text-white p-4 rounded-4 shadow text-center">
                            <h2 class="display-5 fw-bold mb-0">15+</h2>
                            <p class="mb-0 fw-bold">Years Experience</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 ps-lg-5" data-aos="fade-left">
                <span class="text-secondary fw-bold text-uppercase">Who We Are</span>
                <h2 class="display-6 fw-bold text-dark mt-2 mb-4">Dedicated to Precision and Care</h2>
                <p class="lead text-muted mb-4">MediDiag Diagnostic Center was established with a singular vision: to provide world-class, accurate, and rapid diagnostic services to the people of Bangladesh.</p>
                <p class="text-muted mb-4">Over the past 15 years, we have grown into one of the most trusted names in healthcare. Equipped with state-of-the-art technology from global leaders in medical devices, our laboratories and imaging centers adhere to stringent international quality control standards.</p>
                
                <div class="d-flex align-items-center mb-4 bg-light-soft p-3 rounded-3 border-start border-4 border-secondary">
                    <i class="bi bi-quote fs-1 text-secondary me-3 opacity-50"></i>
                    <p class="mb-0 fst-italic text-dark fw-medium">"Our core philosophy is simple: Behind every sample is a human life waiting for an answer. We never compromise on quality."</p>
                </div>
                
                <div class="row g-4 text-center mt-2">
                    <div class="col-4">
                        <h3 class="text-primary fw-bold mb-1">50+</h3>
                        <p class="text-muted small mb-0">Specialist Doctors</p>
                    </div>
                    <div class="col-4 border-start border-end">
                        <h3 class="text-primary fw-bold mb-1">100k+</h3>
                        <p class="text-muted small mb-0">Happy Patients</p>
                    </div>
                    <div class="col-4">
                        <h3 class="text-primary fw-bold mb-1">500+</h3>
                        <p class="text-muted small mb-0">Tests Available</p>
                    </div>
                </div>
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
                        <h3 class="fw-bold mb-3">Our Mission</h3>
                        <p class="text-muted">To deliver precise, timely, and affordable diagnostic services to all segments of society, utilizing advanced medical technology and a highly skilled workforce, while maintaining the highest ethical standards.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="card card-soft border-0 h-100 p-4">
                    <div class="card-body">
                        <div class="icon-box bg-secondary bg-opacity-10 text-secondary rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 80px; height: 80px;">
                            <i class="bi bi-eye fs-1"></i>
                        </div>
                        <h3 class="fw-bold mb-3">Our Vision</h3>
                        <p class="text-muted">To become the leading and most trusted healthcare diagnostic brand in South Asia, setting new benchmarks for quality, innovation, and patient-centric care in the medical industry.</p>
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
            <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                <div class="text-center p-4 border rounded-4 border-light shadow-sm h-100">
                    <i class="bi bi-shield-check text-primary fs-1 mb-3"></i>
                    <h5 class="fw-bold">Integrity</h5>
                    <p class="text-muted small">We uphold the highest moral standards in our practices.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="200">
                <div class="text-center p-4 border rounded-4 border-light shadow-sm h-100">
                    <i class="bi bi-heart text-danger fs-1 mb-3"></i>
                    <h5 class="fw-bold">Compassion</h5>
                    <p class="text-muted small">We treat every patient with empathy and respect.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="300">
                <div class="text-center p-4 border rounded-4 border-light shadow-sm h-100">
                    <i class="bi bi-award text-secondary fs-1 mb-3"></i>
                    <h5 class="fw-bold">Excellence</h5>
                    <p class="text-muted small">We continuously strive for clinical and service excellence.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="400">
                <div class="text-center p-4 border rounded-4 border-light shadow-sm h-100">
                    <i class="bi bi-lightbulb text-warning fs-1 mb-3"></i>
                    <h5 class="fw-bold">Innovation</h5>
                    <p class="text-muted small">Embracing new technologies for better diagnostics.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Infrastructure & Certifications -->
<section class="section-padding bg-primary text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-right">
                <h2 class="fw-bold mb-4">World-Class Infrastructure</h2>
                <p class="lead mb-4 text-white-50">Our laboratories are equipped with fully automated analyzers, ensuring zero manual error and fastest report delivery.</p>
                <ul class="list-unstyled mb-4">
                    <li class="mb-3 d-flex align-items-center"><i class="bi bi-check-circle-fill text-secondary me-3 fs-5"></i> ISO 9001:2015 Certified Laboratories</li>
                    <li class="mb-3 d-flex align-items-center"><i class="bi bi-check-circle-fill text-secondary me-3 fs-5"></i> Fully Automated Pathology Workflow</li>
                    <li class="mb-3 d-flex align-items-center"><i class="bi bi-check-circle-fill text-secondary me-3 fs-5"></i> 3 Tesla MRI & 128 Slice CT Scan</li>
                    <li class="mb-3 d-flex align-items-center"><i class="bi bi-check-circle-fill text-secondary me-3 fs-5"></i> Internal & External Quality Control</li>
                </ul>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <img src="https://images.unsplash.com/photo-1579154204601-01588f351e67?auto=format&fit=crop&w=800&q=80" alt="Lab Equipment" class="img-fluid rounded-4 shadow-lg border border-4 border-white border-opacity-25">
            </div>
        </div>
    </div>
</section>

@endsection
