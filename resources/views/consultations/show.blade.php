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

<div class="card border-0 shadow-sm" id="printable-area">
    <div class="card-body p-5">
        <!-- Header -->
        <div class="row mb-4 border-bottom pb-3">
            <div class="col-sm-8">
                <h3 class="text-primary mb-1"><strong>{{ $visit->doctor->name ?? 'Dr. XYZ' }}</strong></h3>
                <div>{{ $visit->doctor->designation ?? 'MBBS, FCPS' }}</div>
                <div>{{ $visit->doctor->specialization ?? 'Medicine' }}</div>
                <div>Diagnostic & Clinic ERP, Dhaka</div>
            </div>
            <div class="col-sm-4 text-end">
                <h3 class="text-uppercase text-muted">Prescription</h3>
                <div><strong>Date:</strong> {{ date('d M, Y', strtotime($visit->visit_date)) }}</div>
                <div><strong>Visit ID:</strong> {{ $visit->visit_id }}</div>
            </div>
        </div>

        <!-- Patient Info -->
        <div class="row mb-4 p-2 bg-light rounded">
            <div class="col-sm-4">
                <strong>Name:</strong> {{ $visit->patient->name ?? 'N/A' }}
            </div>
            <div class="col-sm-2">
                <strong>Age:</strong> {{ $visit->patient->age ?? '-' }}
            </div>
            <div class="col-sm-3">
                <strong>Sex:</strong> {{ ucfirst($visit->patient->gender ?? '-') }}
            </div>
            <div class="col-sm-3 text-end">
                <strong>ID:</strong> {{ $visit->patient->patient_id ?? 'N/A' }}
            </div>
        </div>

        <div class="row">
            <!-- Left Sidebar (Vitals & Symptoms) -->
            <div class="col-sm-4 border-end pe-4">
                <h6 class="text-muted border-bottom pb-1">Vitals</h6>
                <ul class="list-unstyled mb-4">
                    <li><strong>BP:</strong> {{ $visit->blood_pressure ?? '-' }}</li>
                    <li><strong>Weight:</strong> {{ $visit->weight ? $visit->weight . ' kg' : '-' }}</li>
                    <li><strong>Temp:</strong> {{ $visit->temperature ? $visit->temperature . ' °F' : '-' }}</li>
                </ul>

                <h6 class="text-muted border-bottom pb-1">C/C (Complaints)</h6>
                <p>{{ $visit->symptoms ?? 'None recorded.' }}</p>

                <h6 class="text-muted border-bottom pb-1 mt-4">Notes / History</h6>
                <p>{{ $visit->notes ?? 'None' }}</p>
            </div>
            
            <!-- Right Main (Medicines) -->
            <div class="col-sm-8 ps-4">
                <h2 class="text-muted mb-4" style="font-family: serif;">Rx</h2>
                
                <!-- Placeholder for medicines since we didn't fully implement prescription_items CRUD -->
                <div class="mb-4">
                    <p class="text-muted fst-italic">No medicines recorded yet. (Add items from the prescription module)</p>
                </div>
                
                <h6 class="text-muted mt-5 border-bottom pb-1">Advice</h6>
                <ul>
                    <li>Take medicines regularly as prescribed.</li>
                    <li>Drink plenty of water.</li>
                </ul>
            </div>
        </div>

        <!-- Footer -->
        <div class="row mt-5 pt-5 border-top">
            <div class="col-12 text-center text-muted">
                <small>Consultation valid for 15 days.</small><br>
                <small><strong>Serial No:</strong> {{ $visit->id }}</small>
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
    }
    .bg-light {
        background-color: transparent !important;
        border: 1px solid #ddd;
    }
}
</style>
@endsection
