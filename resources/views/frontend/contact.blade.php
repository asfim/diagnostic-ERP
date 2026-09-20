@extends('layouts.frontend')

@section('title', 'Contact Us - MediDiag')

@section('content')

<!-- Page Banner -->
<x-frontend.page-banner title="Contact Us" :breadcrumbs="['Contact Us' => url('/contact')]" />

<!-- Contact Info Cards -->
<section class="section-padding bg-light-soft" style="margin-top: -50px; position: relative; z-index: 10;">
    <div class="container">
        <div class="row g-4 justify-content-center">
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card card-soft text-center border-0 h-100 p-4 shadow-sm">
                    <div class="card-body">
                        <div class="icon-box bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 70px; height: 70px;">
                            <i class="bi bi-geo-alt-fill fs-2"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Visit Us</h4>
                        <p class="text-muted mb-0">123 Healthcare Avenue, Block B<br>Dhaka 1212, Bangladesh</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="card card-soft text-center border-0 h-100 p-4 shadow-sm border border-primary border-2">
                    <div class="card-body">
                        <div class="icon-box bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-4 shadow" style="width: 70px; height: 70px;">
                            <i class="bi bi-telephone-fill fs-2"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Call Us 24/7</h4>
                        <p class="mb-1 text-muted">Emergency / Hotline:</p>
                        <h5 class="text-primary fw-bold mb-2">+880 1711 000 000</h5>
                        <p class="mb-1 text-muted">Appointment:</p>
                        <h5 class="text-primary fw-bold mb-0">+880 1711 111 111</h5>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="card card-soft text-center border-0 h-100 p-4 shadow-sm">
                    <div class="card-body">
                        <div class="icon-box bg-secondary bg-opacity-10 text-secondary rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 70px; height: 70px;">
                            <i class="bi bi-envelope-fill fs-2"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Email Us</h4>
                        <p class="text-muted mb-1">General Inquiries:</p>
                        <p class="fw-bold text-dark mb-2">info@diagnosticcenter.com</p>
                        <p class="text-muted mb-1">Report Support:</p>
                        <p class="fw-bold text-dark mb-0">reports@diagnosticcenter.com</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form & Map -->
<section class="section-padding bg-white pt-0">
    <div class="container">
        <div class="row g-5">
            <!-- Contact Form -->
            <div class="col-lg-6" data-aos="fade-right">
                <div class="bg-light-soft p-5 rounded-4 h-100">
                    <span class="text-secondary fw-bold text-uppercase">Get in Touch</span>
                    <h2 class="fw-bold text-dark mt-2 mb-4">Send Us a Message</h2>
                    <p class="text-muted mb-4">Have a question or need assistance? Fill out the form below and our support team will get back to you shortly.</p>
                    
                    <form>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Full Name</label>
                                <input type="text" class="form-control rounded-pill px-4" placeholder="John Doe">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Phone Number</label>
                                <input type="tel" class="form-control rounded-pill px-4" placeholder="+880 1xxx xxxxxx">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold">Email Address</label>
                                <input type="email" class="form-control rounded-pill px-4" placeholder="john@example.com">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold">Subject</label>
                                <select class="form-select rounded-pill px-4">
                                    <option selected>General Inquiry</option>
                                    <option>Feedback/Complaint</option>
                                    <option>Report Issue</option>
                                    <option>Corporate Partnership</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold">Message</label>
                                <textarea class="form-control rounded-4 p-3" rows="4" placeholder="How can we help you?"></textarea>
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 w-100 fw-bold">Send Message <i class="bi bi-send ms-2"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Map & Working Hours -->
            <div class="col-lg-6" data-aos="fade-left">
                <div class="card card-soft border-0 h-100 shadow-sm overflow-hidden rounded-4">
                    <!-- Google Map iframe (placeholder) -->
                    <div style="height: 350px; background-color: #e9ecef;" class="position-relative">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.9024424301397!2d90.39108011536269!3d23.750858094676575!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjPCsDQ1JzAzLjEiTiA5MMKwMjMnMzUuOCJF!5e0!3m2!1sen!2sbd!4v1620000000000!5m2!1sen!2sbd" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                    <div class="card-body p-4 bg-primary text-white">
                        <h4 class="fw-bold mb-4 border-bottom border-light pb-3 border-opacity-25"><i class="bi bi-clock-history me-2"></i> Working Hours</h4>
                        
                        <div class="d-flex justify-content-between mb-3 border-bottom border-light pb-2 border-opacity-25">
                            <span class="fw-medium">Diagnostic Center</span>
                            <span class="fw-bold text-secondary">24/7 Open</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3 border-bottom border-light pb-2 border-opacity-25">
                            <span class="fw-medium">Doctor Consultation</span>
                            <span>09:00 AM - 10:00 PM</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3 border-bottom border-light pb-2 border-opacity-25">
                            <span class="fw-medium">Home Sample Collection</span>
                            <span>07:00 AM - 08:00 PM</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="fw-medium">Report Delivery</span>
                            <span>08:00 AM - 09:00 PM</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
