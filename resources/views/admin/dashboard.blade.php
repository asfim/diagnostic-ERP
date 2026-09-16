@extends('layouts.admin')

@section('title', 'Dashboard Summary')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h4 class="mb-3">ERP Overview</h4>
    </div>
</div>

<div class="row g-4 mb-4">
    <!-- Patients Count -->
    <div class="col-md-3">
        <div class="card text-white bg-primary shadow-sm border-0">
            <div class="card-body">
                <h6 class="card-title text-uppercase text-white-50">Total Patients</h6>
                <h2 class="card-text mb-0">{{ $total_patients }}</h2>
                <small><i class="fa-solid fa-users mt-2"></i> Registered</small>
            </div>
        </div>
    </div>
    
    <!-- Doctors Count -->
    <div class="col-md-3">
        <div class="card text-white bg-info shadow-sm border-0">
            <div class="card-body">
                <h6 class="card-title text-uppercase text-white-50">Total Doctors</h6>
                <h2 class="card-text mb-0">{{ $total_doctors }}</h2>
                <small><i class="fa-solid fa-user-doctor mt-2"></i> Active</small>
            </div>
        </div>
    </div>
    
    <!-- Appointments -->
    <div class="col-md-3">
        <div class="card text-white bg-warning shadow-sm border-0">
            <div class="card-body">
                <h6 class="card-title text-uppercase text-dark opacity-75">Appointments</h6>
                <h2 class="card-text mb-0 text-dark">{{ $total_appointments }}</h2>
                <small class="text-dark"><i class="fa-solid fa-calendar-check mt-2"></i> Booked</small>
            </div>
        </div>
    </div>
    
    <!-- Revenue -->
    <div class="col-md-3">
        <div class="card text-white bg-success shadow-sm border-0">
            <div class="card-body">
                <h6 class="card-title text-uppercase text-white-50">Total Revenue</h6>
                <h2 class="card-text mb-0">৳ {{ number_format($total_revenue, 2) }}</h2>
                <small><i class="fa-solid fa-bangladeshi-taka-sign mt-2"></i> Collected</small>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <!-- Lab Orders -->
    <div class="col-md-3">
        <div class="card text-white bg-secondary shadow-sm border-0">
            <div class="card-body">
                <h6 class="card-title text-uppercase text-white-50">Lab Orders</h6>
                <h2 class="card-text mb-0">{{ $total_lab_orders }}</h2>
                <small><i class="fa-solid fa-microscope mt-2"></i> Processing</small>
            </div>
        </div>
    </div>

    <!-- Invoices -->
    <div class="col-md-3">
        <div class="card text-white shadow-sm border-0" style="background-color: #6f42c1;">
            <div class="card-body">
                <h6 class="card-title text-uppercase text-white-50">Total Invoices</h6>
                <h2 class="card-text mb-0">{{ $total_invoices }}</h2>
                <small><i class="fa-solid fa-file-invoice mt-2"></i> Generated</small>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Recent Patients -->
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                <h6 class="mb-0 text-muted">Recent Patients</h6>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @forelse($recent_patients as $patient)
                        <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $patient->name }}</strong><br>
                                <small class="text-muted">{{ $patient->phone }}</small>
                            </div>
                            <span class="badge bg-light text-dark">{{ $patient->patient_id }}</span>
                        </li>
                    @empty
                        <li class="list-group-item px-0 text-muted">No recent patients.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
    
    <!-- Recent Appointments -->
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                <h6 class="mb-0 text-muted">Recent Appointments</h6>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @forelse($recent_appointments as $appointment)
                        <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $appointment->patient->name ?? 'Unknown' }}</strong> 
                                with <span class="text-primary">{{ $appointment->doctor->name ?? 'Unknown' }}</span><br>
                                <small class="text-muted">{{ $appointment->appointment_date }} at {{ $appointment->appointment_time }}</small>
                            </div>
                            <span class="badge {{ $appointment->status == 'Scheduled' ? 'bg-warning text-dark' : 'bg-success' }}">
                                {{ $appointment->status }}
                            </span>
                        </li>
                    @empty
                        <li class="list-group-item px-0 text-muted">No recent appointments.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
