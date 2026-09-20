@extends('layouts.frontend')
@section('title', 'Medical Blog & Health Tips - MediDiag')
@section('content')

<x-frontend.page-banner title="Health & Wellness Blog" :breadcrumbs="['Home' => url('/'), 'Blog' => url('/blog')]" />

<section class="section-padding bg-white">
    <div class="container">
        <div class="section-header centered" data-aos="fade-up">
            <span class="label">Latest News</span>
            <h2>Medical Insights & Health Tips</h2>
            <p>Stay updated with the latest medical research, health tips, and news from our expert doctors.</p>
        </div>

        <div class="row g-4">
            <!-- Blog Post 1 -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1498837167922-ddd27525d352?auto=format&fit=crop&w=600&q=80" class="card-img-top" alt="Healthy eating" style="height: 220px; object-fit: cover;">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3 text-muted small">
                            <span class="badge bg-primary bg-opacity-10 text-primary me-3">Nutrition</span>
                            <span><i class="bi bi-calendar3 me-1"></i> Oct 15, 2026</span>
                        </div>
                        <h4 class="fw-bold mb-3">10 Superfoods to Boost Your Immune System</h4>
                        <p class="text-muted mb-4">Discover the best foods you can eat right now to keep your immune system strong during the winter months.</p>
                        <a href="#" class="text-primary fw-bold text-decoration-none">Read More <i class="bi bi-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>

            <!-- Blog Post 2 -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1505751172876-fa1923c5c528?auto=format&fit=crop&w=600&q=80" class="card-img-top" alt="Doctor consulting" style="height: 220px; object-fit: cover;">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3 text-muted small">
                            <span class="badge bg-success bg-opacity-10 text-success me-3">Health Checkup</span>
                            <span><i class="bi bi-calendar3 me-1"></i> Oct 12, 2026</span>
                        </div>
                        <h4 class="fw-bold mb-3">Why Annual Health Checkups Are Crucial</h4>
                        <p class="text-muted mb-4">Prevention is better than cure. Learn why routine full-body checkups can detect hidden diseases early.</p>
                        <a href="#" class="text-success fw-bold text-decoration-none">Read More <i class="bi bi-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>

            <!-- Blog Post 3 -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1571019614242-c5c5adee9f50?auto=format&fit=crop&w=600&q=80" class="card-img-top" alt="Heart health" style="height: 220px; object-fit: cover;">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3 text-muted small">
                            <span class="badge bg-danger bg-opacity-10 text-danger me-3">Cardiology</span>
                            <span><i class="bi bi-calendar3 me-1"></i> Oct 05, 2026</span>
                        </div>
                        <h4 class="fw-bold mb-3">Understanding Your Lipid Profile Report</h4>
                        <p class="text-muted mb-4">Confused by your cholesterol levels? A cardiologist explains what HDL, LDL, and Triglycerides actually mean.</p>
                        <a href="#" class="text-danger fw-bold text-decoration-none">Read More <i class="bi bi-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>
            
            <!-- Add more dummy posts here as needed -->
        </div>
        
        <div class="text-center mt-5">
            <button class="btn btn-outline-primary rounded-pill px-5 fw-bold">Load More Articles</button>
        </div>
    </div>
</section>

@endsection
