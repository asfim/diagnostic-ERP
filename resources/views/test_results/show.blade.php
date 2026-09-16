@extends('layouts.admin')

@section('title', 'Lab Report')

@section('content')
<div class="row mb-3 d-print-none">
    <div class="col-md-6">
        <a href="{{ route('test-results.index') }}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Back</a>
    </div>
    <div class="col-md-6 text-end">
        <button onclick="window.print()" class="btn btn-primary"><i class="fa-solid fa-print"></i> Print Report</button>
    </div>
</div>

<div class="card border-0 shadow-sm" id="printable-area">
    <div class="card-body p-5">
        <!-- Header -->
        <div class="row mb-4 border-bottom pb-3">
            <div class="col-sm-8">
                <h3 class="text-primary mb-1"><strong>Diagnostic & Clinic ERP</strong></h3>
                <div>123 Health Avenue, City Center, Dhaka 1200</div>
                <div>Phone: +880 1234 567 890</div>
            </div>
            <div class="col-sm-4 text-end">
                <h3 class="text-uppercase text-muted">Laboratory Report</h3>
                <div><strong>Date:</strong> {{ date('d M, Y', strtotime($result->created_at)) }}</div>
            </div>
        </div>

        <!-- Patient Info -->
        <div class="row mb-4">
            <div class="col-sm-6">
                <div><strong>Patient Name:</strong> {{ $result->patient->name ?? 'N/A' }}</div>
                <div><strong>Age/Sex:</strong> {{ $result->patient->age ?? '-' }} / {{ ucfirst($result->patient->gender ?? '-') }}</div>
            </div>
            <div class="col-sm-6 text-end">
                <div><strong>Patient ID:</strong> {{ $result->patient->patient_id ?? 'N/A' }}</div>
                <div><strong>Order ID:</strong> {{ $result->diagnostic_order_id }}</div>
            </div>
        </div>

        <!-- Test Results -->
        <h5 class="mb-3 border-bottom pb-2">Department: Pathology</h5>
        
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Test Name</th>
                    <th>Result</th>
                    <th>Reference Range</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>{{ $result->test->name ?? 'Unknown Test' }}</strong></td>
                    <td><strong>{{ $result->result_value }}</strong></td>
                    <td>As per standard range</td>
                    <td>{{ $result->remarks ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Signatures -->
        <div class="row mt-5 pt-5">
            <div class="col-sm-4 text-center">
                <hr style="width: 80%; margin: 0 auto 10px auto;">
                <strong>Prepared By</strong><br>
                <small class="text-muted">Medical Technologist</small>
            </div>
            <div class="col-sm-4">
            </div>
            <div class="col-sm-4 text-center">
                <hr style="width: 80%; margin: 0 auto 10px auto;">
                <strong>Verified By</strong><br>
                <small class="text-muted">Pathologist / Consultant</small>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="row mt-4">
            <div class="col-12 text-center text-muted">
                <small><em>This report is generated automatically by Diagnostic & Clinic ERP and requires authorized signature to be valid.</em></small>
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
}
</style>
@endsection
