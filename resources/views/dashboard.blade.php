@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="row mb-4">
    <!-- Total Patients -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-0 shadow-sm h-100 py-2" style="background: linear-gradient(135deg, #4e73df 0%, #224abe 100%); border-radius: 15px;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1 text-white-50">Total Patients</div>
                        <div class="h3 mb-0 font-weight-bold text-white">{{ \App\Models\Patient::count() ?? 0 }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fa-solid fa-users fa-2x text-white" style="opacity: 0.5;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Doctors -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-0 shadow-sm h-100 py-2" style="background: linear-gradient(135deg, #1cc88a 0%, #13855c 100%); border-radius: 15px;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1 text-white-50">Total Doctors</div>
                        <div class="h3 mb-0 font-weight-bold text-white">{{ \App\Models\Doctor::count() ?? 0 }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fa-solid fa-user-doctor fa-2x text-white" style="opacity: 0.5;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Income -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-0 shadow-sm h-100 py-2" style="background: linear-gradient(135deg, #36b9cc 0%, #258391 100%); border-radius: 15px;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1 text-white-50">Total Income (Today)</div>
                        <div class="h3 mb-0 font-weight-bold text-white">৳ {{ \App\Models\Invoice::whereDate('created_at', today())->sum('total_amount') ?? 0 }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fa-solid fa-bangladeshi-taka-sign fa-2x text-white" style="opacity: 0.5;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Lab Orders -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-0 shadow-sm h-100 py-2" style="background: linear-gradient(135deg, #f6c23e 0%, #dda20a 100%); border-radius: 15px;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1 text-white-50">Pending Lab Orders</div>
                        <div class="h3 mb-0 font-weight-bold text-white">{{ \App\Models\DiagnosticOrder::where('status', 'Pending')->count() ?? 0 }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fa-solid fa-vial-circle-check fa-2x text-white" style="opacity: 0.5;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow-sm mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Recent Appointments</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Patient</th>
                                <th>Doctor</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(\App\Models\Appointment::with('patient', 'doctor')->latest()->take(5)->get() as $apt)
                            <tr>
                                <td>
                                    <div class="fw-bold">{{ $apt->patient->name ?? 'Unknown' }}</div>
                                    <div class="small text-muted">{{ $apt->patient->phone ?? '' }}</div>
                                </td>
                                <td>{{ $apt->doctor->name ?? 'Unknown' }}</td>
                                <td>{{ $apt->appointment_date }}</td>
                                <td>
                                    @php
                                        $statusClass = match($apt->status) {
                                            'Confirmed' => 'success',
                                            'Pending' => 'warning',
                                            'Cancelled' => 'danger',
                                            default => 'secondary'
                                        };
                                    @endphp
                                    <span class="badge bg-{{ $statusClass }} bg-opacity-25 text-{{ $statusClass }}">{{ $apt->status }}</span>
                                </td>
                            </tr>
                            @endforeach
                            @if(\App\Models\Appointment::count() == 0)
                            <tr><td colspan="4" class="text-center py-4 text-muted">No appointments found.</td></tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow-sm mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">System Info</h6>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3 text-primary">
                        <i class="fa-solid fa-hospital fa-lg"></i>
                    </div>
                    <div>
                        <div class="fw-bold">{{ config('app.name') }}</div>
                        <div class="small text-muted">Clinic ERP System</div>
                    </div>
                </div>
                <hr>
                <div class="small text-muted mb-1">Today's Date</div>
                <div class="fw-bold mb-3">{{ now()->format('l, F j, Y') }}</div>
                
                <div class="small text-muted mb-1">Logged in as</div>
                <div class="fw-bold text-primary">{{ Auth::user()->name ?? 'Administrator' }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
