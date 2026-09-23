@extends('layouts.admin')

@section('title', 'Appointments')

@section('content')

{{-- Page Header --}}
<div class="page-header-premium d-flex justify-content-between align-items-center">
    <div>
        <h4><i class="fa-solid fa-calendar-check me-2"></i>Appointments</h4>
        <p>Manage and track patient appointments</p>
    </div>
    <a href="{{ route('appointments.create') }}" class="btn btn-premium-new">
        <i class="fa-solid fa-plus me-2"></i>Book Appointment
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
        <i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card-premium card">
    <div class="table-responsive">
        <table class="table table-premium mb-0">
            <thead>
                <tr>
                    <th>Apt. ID</th>
                    <th>Date & Time</th>
                    <th>Patient Name</th>
                    <th>Doctor Name</th>
                    <th>Token</th>
                    <th>Due (৳)</th>
                    <th>Status</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($appointments as $apt)
                <tr>
                    <td><span class="id-badge">{{ $apt->appointment_id }}</span></td>
                    <td>
                        <span class="fw-semibold text-dark">{{ $apt->date }}</span><br>
                        <small class="text-muted">{{ $apt->time }}</small>
                    </td>
                    <td><span class="fw-semibold text-dark">{{ $apt->patient->name ?? 'N/A' }}</span></td>
                    <td><span class="text-muted fw-medium">{{ $apt->doctor->name ?? 'N/A' }}</span></td>
                    <td><span class="badge bg-secondary">{{ $apt->token }}</span></td>
                    <td class="fw-bold text-danger">৳ {{ number_format($apt->due, 2) }}</td>
                    <td>
                        <select class="form-select form-select-sm status-dropdown shadow-sm {{ $apt->status == 'Pending' ? 'bg-warning text-dark' : ($apt->status == 'Confirmed' ? 'bg-success text-white' : 'bg-secondary text-white') }}" data-id="{{ $apt->id }}" style="width: 110px; font-weight: 500; cursor: pointer; border-radius: 20px;">
                            <option value="Pending" {{ $apt->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Confirmed" {{ $apt->status == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="Cancelled" {{ $apt->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('appointments.edit', $apt->id) }}" class="action-btn action-btn-edit" title="Edit Appointment">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <form action="{{ route('appointments.destroy', $apt->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this appointment?');" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn action-btn-del" title="Cancel">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8">
                        <div class="empty-state">
                            <i class="fa-solid fa-calendar-xmark"></i>
                            <strong>No appointments found</strong>
                            <p class="mt-2 mb-0 small">Book a new appointment to get started.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($appointments->hasPages())
        <div class="px-4 py-3 border-top">
            {{ $appointments->links() }}
        </div>
    @endif
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
