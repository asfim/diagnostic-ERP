@extends('layouts.frontend')
@section('title', 'Download Reports - MediDiag')
@section('content')

<x-frontend.page-banner title="Download Reports" :breadcrumbs="['Patient Portal' => '#', 'Reports' => url('/reports')]" />

<section class="section-padding bg-light-soft">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6" data-aos="fade-up">
                <div class="card card-soft border-0 shadow-sm p-4 p-md-5">
                    <div class="text-center mb-4">
                        <div class="icon-box bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                            <i class="bi bi-file-earmark-pdf fs-2"></i>
                        </div>
                        <h3 class="fw-bold">Get Your Test Results</h3>
                        <p class="text-muted">Enter your details to view and download your diagnostic reports securely.</p>
                    </div>

                    <form onsubmit="event.preventDefault(); alert('Report generation functionality will be integrated here.');">
                        <div class="mb-4">
                            <label class="form-label fw-bold">Search By</label>
                            <div class="d-flex gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="searchType" id="typeInvoice" checked>
                                    <label class="form-check-label" for="typeInvoice">Invoice ID</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="searchType" id="typePatient">
                                    <label class="form-check-label" for="typePatient">Patient ID</label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">ID Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control rounded-pill px-4" placeholder="e.g., INV-12345 or PAT-98765" required>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold">Registered Mobile Number <span class="text-danger">*</span></label>
                            <input type="tel" class="form-control rounded-pill px-4" placeholder="+880 1..." required>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg rounded-pill w-100 fw-bold">
                            <i class="bi bi-search me-2"></i> Find Report
                        </button>
                    </form>
                    
                    <div class="mt-4 pt-4 border-top text-center text-muted small">
                        <i class="bi bi-lock-fill text-success me-1"></i> Your medical records are encrypted and strictly confidential.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
