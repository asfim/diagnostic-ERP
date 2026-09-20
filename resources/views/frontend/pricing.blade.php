@extends('layouts.frontend')
@section('title', 'Pricing - MediDiag')
@section('content')

<x-frontend.page-banner title="Test Pricing & Packages" :breadcrumbs="['Services' => '#', 'Pricing' => url('/pricing')]" />

<section class="section-padding bg-light-soft">
    <div class="container">
        <div class="section-header centered" data-aos="fade-up">
            <span class="label">Transparent Pricing</span>
            <h2>Affordable Diagnostics for All</h2>
            <p>We believe in transparent pricing with no hidden costs. Search for specific tests or choose one of our comprehensive health packages.</p>
        </div>

        <div class="row justify-content-center mb-5" data-aos="fade-up" data-aos-delay="100">
            <div class="col-lg-8">
                <div class="card card-soft border-0 shadow-sm p-3">
                    <form action="{{ url('/tests') }}" method="GET" class="d-flex gap-2">
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-white border-0"><i class="bi bi-search text-muted"></i></span>
                            <input type="text" name="search" class="form-control border-0" placeholder="Search for a test name or code..." style="box-shadow: none;">
                        </div>
                        <button type="submit" class="btn btn-primary rounded-3 px-4 fw-bold">Search</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Popular Tests -->
            <div class="col-lg-8" data-aos="fade-right">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                    <div class="card-header bg-white border-bottom p-4">
                        <h4 class="fw-bold mb-0">Popular Tests</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-4">Test Name</th>
                                        <th>Code</th>
                                        <th>Report Time</th>
                                        <th class="text-end pe-4">Price (৳)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="ps-4 fw-semibold">Complete Blood Count (CBC)</td>
                                        <td><span class="badge bg-secondary bg-opacity-10 text-secondary">T-001</span></td>
                                        <td><span class="text-success small"><i class="bi bi-clock me-1"></i>4 Hours</span></td>
                                        <td class="text-end pe-4 fw-bold text-primary">400</td>
                                    </tr>
                                    <tr>
                                        <td class="ps-4 fw-semibold">Lipid Profile</td>
                                        <td><span class="badge bg-secondary bg-opacity-10 text-secondary">T-015</span></td>
                                        <td><span class="text-success small"><i class="bi bi-clock me-1"></i>Same Day</span></td>
                                        <td class="text-end pe-4 fw-bold text-primary">800</td>
                                    </tr>
                                    <tr>
                                        <td class="ps-4 fw-semibold">HbA1c (Glycosylated Hemoglobin)</td>
                                        <td><span class="badge bg-secondary bg-opacity-10 text-secondary">T-023</span></td>
                                        <td><span class="text-success small"><i class="bi bi-clock me-1"></i>Same Day</span></td>
                                        <td class="text-end pe-4 fw-bold text-primary">600</td>
                                    </tr>
                                    <tr>
                                        <td class="ps-4 fw-semibold">Thyroid Profile (T3, T4, TSH)</td>
                                        <td><span class="badge bg-secondary bg-opacity-10 text-secondary">T-041</span></td>
                                        <td><span class="text-muted small"><i class="bi bi-clock me-1"></i>Next Day</span></td>
                                        <td class="text-end pe-4 fw-bold text-primary">1,200</td>
                                    </tr>
                                    <tr>
                                        <td class="ps-4 fw-semibold">Liver Function Test (LFT)</td>
                                        <td><span class="badge bg-secondary bg-opacity-10 text-secondary">T-035</span></td>
                                        <td><span class="text-success small"><i class="bi bi-clock me-1"></i>Same Day</span></td>
                                        <td class="text-end pe-4 fw-bold text-primary">900</td>
                                    </tr>
                                    <tr>
                                        <td class="ps-4 fw-semibold">Serum Creatinine</td>
                                        <td><span class="badge bg-secondary bg-opacity-10 text-secondary">T-018</span></td>
                                        <td><span class="text-success small"><i class="bi bi-clock me-1"></i>4 Hours</span></td>
                                        <td class="text-end pe-4 fw-bold text-primary">300</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-top p-3 text-center">
                        <a href="{{ url('/tests') }}" class="btn btn-link text-decoration-none fw-bold">View All Tests <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Promotional Banner -->
            <div class="col-lg-4" data-aos="fade-left">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100 text-center bg-primary text-white position-relative">
                    <!-- Background pattern overlay -->
                    <div class="position-absolute top-0 start-0 w-100 h-100 opacity-25" style="background: radial-gradient(circle, transparent 20%, var(--primary-dark) 20%, var(--primary-dark) 80%, transparent 80%, transparent) 0% 0% / 20px 20px;"></div>
                    
                    <div class="card-body p-5 position-relative z-index-1 d-flex flex-column justify-content-center">
                        <div class="mb-4">
                            <i class="bi bi-box2-heart display-1"></i>
                        </div>
                        <h3 class="fw-bold mb-3">Save up to 40%</h3>
                        <p class="mb-4 text-white-50">Choose our comprehensive health packages and save significantly on your total diagnostic costs.</p>
                        <a href="{{ url('/packages') }}" class="btn btn-light btn-lg rounded-pill fw-bold text-primary w-100">Explore Packages</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
