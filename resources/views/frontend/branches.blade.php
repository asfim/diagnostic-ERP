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
            <!-- Main Branch -->
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
                    <div class="row g-0 h-100">
                        <div class="col-md-5">
                            <img src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=600&q=80" class="img-fluid h-100 object-fit-cover" alt="Dhaka Main Branch">
                        </div>
                        <div class="col-md-7">
                            <div class="card-body p-4 d-flex flex-column justify-content-center h-100">
                                <div class="badge bg-primary mb-2 align-self-start">Headquarters</div>
                                <h4 class="fw-bold mb-3">Dhaka Main Center</h4>
                                
                                <ul class="list-unstyled text-muted small mb-4">
                                    <li class="mb-2"><i class="bi bi-geo-alt-fill text-primary me-2"></i> 123 Health Avenue, Dhanmondi, Dhaka 1205</li>
                                    <li class="mb-2"><i class="bi bi-telephone-fill text-primary me-2"></i> +880 2 1234 5678</li>
                                    <li class="mb-2"><i class="bi bi-envelope-fill text-primary me-2"></i> dhaka@medidiag.com</li>
                                    <li><i class="bi bi-clock-fill text-primary me-2"></i> Open 24/7</li>
                                </ul>
                                
                                <a href="https://maps.google.com" target="_blank" class="btn btn-outline-primary btn-sm rounded-pill fw-bold w-100 mt-auto">
                                    <i class="bi bi-map me-1"></i> View on Map
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Branch 2 -->
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
                    <div class="row g-0 h-100">
                        <div class="col-md-5">
                            <img src="https://images.unsplash.com/photo-1586773860418-d37222d8fce3?auto=format&fit=crop&w=600&q=80" class="img-fluid h-100 object-fit-cover" alt="Chittagong Branch">
                        </div>
                        <div class="col-md-7">
                            <div class="card-body p-4 d-flex flex-column justify-content-center h-100">
                                <div class="badge bg-success mb-2 align-self-start">Regional Center</div>
                                <h4 class="fw-bold mb-3">Chattogram Branch</h4>
                                
                                <ul class="list-unstyled text-muted small mb-4">
                                    <li class="mb-2"><i class="bi bi-geo-alt-fill text-primary me-2"></i> 45 GEC Circle, CDA Avenue, Chattogram</li>
                                    <li class="mb-2"><i class="bi bi-telephone-fill text-primary me-2"></i> +880 31 9876 5432</li>
                                    <li class="mb-2"><i class="bi bi-envelope-fill text-primary me-2"></i> ctg@medidiag.com</li>
                                    <li><i class="bi bi-clock-fill text-primary me-2"></i> 8:00 AM - 10:00 PM</li>
                                </ul>
                                
                                <a href="https://maps.google.com" target="_blank" class="btn btn-outline-primary btn-sm rounded-pill fw-bold w-100 mt-auto">
                                    <i class="bi bi-map me-1"></i> View on Map
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Branch 3 -->
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
                    <div class="row g-0 h-100">
                        <div class="col-md-5">
                            <img src="https://images.unsplash.com/photo-1538108149393-fbbd81895907?auto=format&fit=crop&w=600&q=80" class="img-fluid h-100 object-fit-cover" alt="Sylhet Branch">
                        </div>
                        <div class="col-md-7">
                            <div class="card-body p-4 d-flex flex-column justify-content-center h-100">
                                <div class="badge bg-info text-white mb-2 align-self-start">New Center</div>
                                <h4 class="fw-bold mb-3">Sylhet Branch</h4>
                                
                                <ul class="list-unstyled text-muted small mb-4">
                                    <li class="mb-2"><i class="bi bi-geo-alt-fill text-primary me-2"></i> 78 Zindabazar, Sylhet City Center</li>
                                    <li class="mb-2"><i class="bi bi-telephone-fill text-primary me-2"></i> +880 821 5555 6666</li>
                                    <li class="mb-2"><i class="bi bi-envelope-fill text-primary me-2"></i> sylhet@medidiag.com</li>
                                    <li><i class="bi bi-clock-fill text-primary me-2"></i> 9:00 AM - 9:00 PM</li>
                                </ul>
                                
                                <a href="https://maps.google.com" target="_blank" class="btn btn-outline-primary btn-sm rounded-pill fw-bold w-100 mt-auto">
                                    <i class="bi bi-map me-1"></i> View on Map
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Branch 4 (Coming Soon) -->
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
                <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden bg-primary bg-opacity-10 border border-primary border-opacity-25">
                    <div class="card-body p-5 d-flex flex-column align-items-center justify-content-center text-center h-100">
                        <div class="icon-box bg-white text-primary rounded-circle mb-3 d-inline-flex align-items-center justify-content-center" style="width: 70px; height: 70px;">
                            <i class="bi bi-building-add fs-2"></i>
                        </div>
                        <h4 class="fw-bold mb-2">Rajshahi Branch</h4>
                        <p class="text-primary mb-3">Opening soon in early 2027 to serve the northern region!</p>
                        <span class="badge bg-primary px-3 py-2 rounded-pill">Coming Soon</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
