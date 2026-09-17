@extends('layouts.admin')

@section('title', 'Prescription')

@section('content')
<div class="row mb-3 d-print-none">
    <div class="col-md-6">
        <a href="{{ route('consultations.index') }}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Back</a>
    </div>
    <div class="col-md-6 text-end">
        <button onclick="window.print()" class="btn btn-primary"><i class="fa-solid fa-print"></i> Print Prescription</button>
    </div>
</div>

<div class="card border-0 shadow-lg" id="printable-area" style="border-radius: 15px; overflow: hidden;">
    <!-- Stylish Header -->
    <div class="bg-primary text-white p-4 d-flex justify-content-between align-items-center" style="border-bottom: 5px solid #0056b3;">
        <div>
            <h2 class="mb-1" style="font-weight: 700; letter-spacing: 1px;">{{ $visit->doctor->name ?? 'Dr. XYZ' }}</h2>
            <div style="font-size: 1.1rem; opacity: 0.9;">{{ $visit->doctor->designation ?? 'MBBS, FCPS' }}</div>
            <div style="opacity: 0.8;"><i class="fa-solid fa-stethoscope me-2"></i>{{ $visit->doctor->specialization ?? 'Medicine' }}</div>
        </div>
        <div class="text-end">
            <h4 class="text-uppercase mb-2" style="font-weight: 800; letter-spacing: 2px;">Prescription</h4>
            <div>Diagnostic & Clinic ERP, Dhaka</div>
            <div><strong>Date:</strong> {{ date('d M, Y', strtotime($visit->visit_date)) }}</div>
            <div><strong>Visit ID:</strong> {{ $visit->visit_id }}</div>
        </div>
    </div>

    <div class="card-body p-5">
        <!-- Patient Info Ribbon -->
        <div class="row mb-5 p-3 rounded" style="background-color: #f8f9fa; border-left: 5px solid #0d6efd;">
            <div class="col-sm-4">
                <span class="text-muted text-uppercase" style="font-size: 0.8rem; font-weight: 600;">Patient Name</span><br>
                <strong class="fs-5">{{ $visit->patient->name ?? 'N/A' }}</strong>
            </div>
            <div class="col-sm-2">
                <span class="text-muted text-uppercase" style="font-size: 0.8rem; font-weight: 600;">Age</span><br>
                <strong class="fs-5">{{ $visit->patient->age ?? '-' }}</strong>
            </div>
            <div class="col-sm-3">
                <span class="text-muted text-uppercase" style="font-size: 0.8rem; font-weight: 600;">Gender</span><br>
                <strong class="fs-5">{{ ucfirst($visit->patient->gender ?? '-') }}</strong>
            </div>
            <div class="col-sm-3 text-end">
                <span class="text-muted text-uppercase" style="font-size: 0.8rem; font-weight: 600;">Patient ID</span><br>
                <strong class="fs-5 text-primary">{{ $visit->patient->patient_id ?? 'N/A' }}</strong>
            </div>
        </div>

        <div class="row">
            <!-- Left Sidebar (Vitals & Symptoms) -->
            <div class="col-sm-4 border-end pe-4">
                <h6 class="text-uppercase text-primary mb-3" style="font-weight: 700; letter-spacing: 1px;">Clinical Details</h6>
                
                <div class="mb-4">
                    <div class="d-flex align-items-center mb-2">
                        <div class="bg-light rounded p-2 me-3 text-primary"><i class="fa-solid fa-heart-pulse"></i></div>
                        <div>
                            <div class="text-muted" style="font-size: 0.85rem;">Blood Pressure</div>
                            <strong>{{ $visit->blood_pressure ?? '-' }}</strong>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="bg-light rounded p-2 me-3 text-primary"><i class="fa-solid fa-weight-scale"></i></div>
                        <div>
                            <div class="text-muted" style="font-size: 0.85rem;">Weight</div>
                            <strong>{{ $visit->weight ? $visit->weight . ' kg' : '-' }}</strong>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="bg-light rounded p-2 me-3 text-primary"><i class="fa-solid fa-temperature-half"></i></div>
                        <div>
                            <div class="text-muted" style="font-size: 0.85rem;">Temperature</div>
                            <strong>{{ $visit->temperature ? $visit->temperature . ' °F' : '-' }}</strong>
                        </div>
                    </div>
                </div>

                <h6 class="text-muted border-bottom pb-2 mt-4" style="font-weight: 600;">C/C (Complaints)</h6>
                <p style="white-space: pre-line;">{{ $visit->symptoms ?? 'None recorded.' }}</p>

                <h6 class="text-muted border-bottom pb-2 mt-4" style="font-weight: 600;">Notes / History</h6>
                <p style="white-space: pre-line;">{{ $visit->notes ?? 'None' }}</p>
            </div>
            
            <!-- Right Main (Medicines) -->
            <div class="col-sm-8 ps-5">
                <div class="mb-4 text-primary" style="font-family: 'Times New Roman', serif; font-size: 3.5rem; font-weight: bold; line-height: 1;">
                    Rx
                </div>
                
                @if($visit->prescription && $visit->prescription->items->count() > 0)
                    <div class="mb-5">
                        @foreach($visit->prescription->items as $index => $item)
                        <div class="d-flex mb-3 pb-3 {{ !$loop->last ? 'border-bottom border-light' : '' }}">
                            <div class="me-3 text-muted" style="font-size: 1.2rem;">{{ $index + 1 }}.</div>
                            <div class="w-100">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <strong class="fs-5" style="color: #2c3e50;">{{ $item->medicine_name }}</strong>
                                    <span class="badge bg-light text-dark border">{{ $item->duration }}</span>
                                </div>
                                <div class="d-flex text-muted" style="font-size: 0.95rem;">
                                    <div class="me-4"><i class="fa-regular fa-clock me-1"></i> {{ $item->dosage }}</div>
                                    @if($item->instruction)
                                    <div><i class="fa-solid fa-circle-info me-1"></i> {{ $item->instruction }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="mb-5 p-4 bg-light rounded text-center">
                        <i class="fa-solid fa-pills text-muted fs-1 mb-2"></i>
                        <p class="text-muted fst-italic mb-0">No medicines recorded yet.</p>
                    </div>
                @endif
                
                @if($visit->prescription && $visit->prescription->advice)
                <div class="mt-5 p-3 rounded" style="background-color: #fff9e6; border-left: 4px solid #ffc107;">
                    <h6 class="text-dark mb-2" style="font-weight: 700;"><i class="fa-regular fa-lightbulb text-warning me-2"></i>Advice</h6>
                    <p class="mb-0" style="white-space: pre-line;">{{ $visit->prescription->advice }}</p>
                </div>
                @endif

                @if($visit->prescription && $visit->prescription->next_visit_date)
                <div class="mt-4 text-end">
                    <span class="text-muted text-uppercase" style="font-size: 0.8rem; font-weight: 600;">Next Visit</span><br>
                    <strong class="fs-5 text-success">{{ date('d M, Y', strtotime($visit->prescription->next_visit_date)) }}</strong>
                </div>
                @endif
            </div>
        </div>

        <!-- Footer -->
        <div class="row mt-5 pt-5">
            <div class="col-6">
                <small class="text-muted">Consultation valid for 15 days.</small><br>
                <small class="text-muted"><strong>Serial No:</strong> {{ $visit->id }}</small>
            </div>
            <div class="col-6 text-end">
                <div class="border-bottom border-dark w-50 ms-auto mb-2"></div>
                <strong class="text-muted">Doctor's Signature</strong>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    body {
        background-color: #fff;
    }
    .sidebar, .navbar, .d-print-none {
        display: none !important;
    }
    .main-content {
        margin-left: 0 !important;
        padding: 0 !important;
    }
    .card {
        border: none !important;
        box-shadow: none !important;
        border-radius: 0 !important;
    }
    .bg-primary {
        background-color: #0d6efd !important;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }
    .bg-light, .rounded[style*="background-color: #f8f9fa"], .rounded[style*="background-color: #fff9e6"] {
        background-color: #f8f9fa !important;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }
    .text-white {
        color: #fff !important;
    }
    .border-end {
        border-right: 1px solid #dee2e6 !important;
    }
}
</style>
@endsection
