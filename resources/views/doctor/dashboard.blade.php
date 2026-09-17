@extends('layouts.admin')

@section('title', 'Doctor Dashboard')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h4 class="mb-3">Welcome, Dr. {{ auth()->user()->name }}</h4>
    </div>
</div>

<div class="row g-4 mb-4">
    <!-- Today's Appointments -->
    <div class="col-md-4">
        <div class="card text-white bg-primary shadow-sm border-0">
            <div class="card-body">
                <h6 class="card-title text-uppercase text-white-50">Today's Appointments</h6>
                <h2 class="card-text mb-0">{{ $today_appointments_count }}</h2>
                <small><i class="fa-solid fa-calendar-day mt-2"></i> For Today</small>
            </div>
        </div>
    </div>
    
    <!-- Total Appointments -->
    <div class="col-md-4">
        <div class="card text-white bg-info shadow-sm border-0">
            <div class="card-body">
                <h6 class="card-title text-uppercase text-white-50">Total Appointments</h6>
                <h2 class="card-text mb-0">{{ $total_appointments }}</h2>
                <small><i class="fa-solid fa-calendar-check mt-2"></i> All time</small>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Today's Schedule -->
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 text-muted">Today's Schedule</h6>
                <a href="{{ route('appointments.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Time</th>
                                <th>Patient</th>
                                <th>Token</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($today_appointments as $appointment)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($appointment->time)->format('h:i A') }}</td>
                                    <td>
                                        <strong>{{ $appointment->patient->name ?? 'Unknown' }}</strong><br>
                                        <small class="text-muted">{{ $appointment->patient->phone ?? '' }}</small>
                                    </td>
                                    <td>{{ $appointment->token }}</td>
                                    <td>
                                        <select class="form-select form-select-sm status-dropdown shadow-sm {{ $appointment->status == 'Pending' ? 'bg-warning text-dark' : ($appointment->status == 'Confirmed' ? 'bg-success text-white' : 'bg-secondary text-white') }}" data-id="{{ $appointment->id }}" style="width: 110px; font-weight: 500; cursor: pointer;">
                                            <option value="Pending" {{ $appointment->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="Confirmed" {{ $appointment->status == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                                            <option value="Completed" {{ $appointment->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="Cancelled" {{ $appointment->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                    </td>
                                    <td>
                                        <a href="{{ route('appointments.show', $appointment->id) }}" class="btn btn-sm btn-light" title="View Details">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="{{ route('consultations.create', ['appointment_id' => $appointment->id]) }}" class="btn btn-sm btn-primary" title="Start Consultation">
                                            <i class="fa-solid fa-stethoscope"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-3">No appointments for today.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Upcoming Appointments -->
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                <h6 class="mb-0 text-muted">Upcoming Appointments</h6>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @forelse($upcoming_appointments as $appointment)
                        <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $appointment->patient->name ?? 'Unknown' }}</strong><br>
                                <small class="text-muted">{{ \Carbon\Carbon::parse($appointment->date)->format('M d, Y') }} at {{ \Carbon\Carbon::parse($appointment->time)->format('h:i A') }}</small>
                            </div>
                            <span class="badge {{ $appointment->status == 'Scheduled' ? 'bg-warning text-dark' : 'bg-primary' }}">
                                {{ $appointment->status }}
                            </span>
                        </li>
                    @empty
                        <li class="list-group-item px-0 text-muted">No upcoming appointments.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const dropdowns = document.querySelectorAll('.status-dropdown');
    dropdowns.forEach(dropdown => {
        dropdown.addEventListener('change', function() {
            const appointmentId = this.dataset.id;
            const newStatus = this.value;
            const selectElement = this;

            fetch(`/appointments/${appointmentId}/status`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ status: newStatus })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update classes based on status for visual feedback
                    selectElement.className = 'form-select form-select-sm status-dropdown shadow-sm';
                    if (newStatus === 'Pending') selectElement.classList.add('bg-warning', 'text-dark');
                    else if (newStatus === 'Confirmed') selectElement.classList.add('bg-success', 'text-white');
                    else selectElement.classList.add('bg-secondary', 'text-white');
                } else {
                    alert('Failed to update status.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while updating status.');
            });
        });
    });
});
</script>
@endsection
