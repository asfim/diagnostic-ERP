@extends('layouts.admin')

@section('title', 'Appointments')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h4>All Appointments</h4>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('appointments.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Book Appointment</a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Apt. ID</th>
                    <th>Date & Time</th>
                    <th>Patient Name</th>
                    <th>Doctor Name</th>
                    <th>Token</th>
                    <th>Due (৳)</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($appointments as $apt)
                <tr>
                    <td>{{ $apt->appointment_id }}</td>
                    <td>{{ $apt->date }} at {{ $apt->time }}</td>
                    <td>{{ $apt->patient->name ?? 'N/A' }}</td>
                    <td>{{ $apt->doctor->name ?? 'N/A' }}</td>
                    <td>{{ $apt->token }}</td>
                    <td>{{ number_format($apt->due, 2) }}</td>
                    <td>
                        <select class="form-select form-select-sm status-dropdown shadow-sm {{ $apt->status == 'Pending' ? 'bg-warning text-dark' : ($apt->status == 'Confirmed' ? 'bg-success text-white' : 'bg-secondary text-white') }}" data-id="{{ $apt->id }}" style="width: 110px; font-weight: 500; cursor: pointer;">
                            <option value="Pending" {{ $apt->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Confirmed" {{ $apt->status == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="Cancelled" {{ $apt->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </td>
                    <td class="d-flex gap-1">
                        <a href="{{ route('appointments.edit', $apt->id) }}" class="btn btn-sm btn-warning" title="Edit"><i class="fa-solid fa-pen"></i></a>
                        <form action="{{ route('appointments.destroy', $apt->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this appointment?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" title="Delete"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted">No appointments found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $appointments->links() }}
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
