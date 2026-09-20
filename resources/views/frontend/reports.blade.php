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

                    <form action="{{ route('frontend.reports.search') }}" method="POST">
                        @csrf
                        
                        @if(session('error'))
                            <div class="alert alert-danger rounded-3">{{ session('error') }}</div>
                        @endif

                        <div class="mb-4">
                            <label class="form-label fw-bold">Search By</label>
                            <div class="d-flex gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="searchType" id="typeInvoice" value="typeInvoice" {{ old('searchType', 'typeInvoice') == 'typeInvoice' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="typeInvoice">Invoice ID</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="searchType" id="typePatient" value="typePatient" {{ old('searchType') == 'typePatient' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="typePatient">Patient ID</label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">ID Number <span class="text-danger">*</span></label>
                            <input type="text" name="id_number" class="form-control rounded-pill px-4" placeholder="e.g., ORD-260916-0001 or PT-260916-0001" value="{{ old('id_number') }}" required>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold">Registered Mobile Number <span class="text-danger">*</span></label>
                            <input type="tel" name="mobile" class="form-control rounded-pill px-4" placeholder="e.g., 01511112222" value="{{ old('mobile') }}" required>
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
            
            @if(isset($results))
            <div class="col-lg-8 mt-5" data-aos="fade-up">
                <h4 class="fw-bold mb-4">Search Results</h4>
                
                @if($results->isEmpty())
                    <div class="alert alert-warning rounded-3 shadow-sm text-center p-4">
                        <i class="bi bi-exclamation-triangle fs-3 d-block mb-2 text-warning"></i>
                        No completed reports found for the given details. If you gave your sample recently, please wait for the processing time.
                    </div>
                @else
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                        <div class="card-header bg-primary text-white p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="mb-0 fw-bold"><i class="bi bi-person-circle me-2"></i> {{ $patient->name }}</h6>
                                <span>{{ $patient->mobile }}</span>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-4">Date</th>
                                        <th>Test Name</th>
                                        <th>Invoice ID</th>
                                        <th>Status</th>
                                        <th class="text-end pe-4">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($results as $result)
                                    <tr>
                                        <td class="ps-4">{{ $result->created_at->format('d M, Y') }}</td>
                                        <td class="fw-semibold">{{ $result->test->name }}</td>
                                        <td><span class="badge bg-light text-dark border">{{ $result->diagnosticOrder->order_id }}</span></td>
                                        <td>
                                            <span class="badge bg-success-subtle text-success border border-success-subtle"><i class="bi bi-check-circle me-1"></i>Completed</span>
                                        </td>
                                        <td class="text-end pe-4">
                                            <a href="{{ route('frontend.reports.download', $result->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                                <i class="bi bi-download me-1"></i> Download
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
            @endif
        </div>
    </div>
</section>

@endsection
