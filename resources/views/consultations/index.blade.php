@extends('layouts.admin')

@section('title', 'OPD Consultations')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h4>Patient Visits (OPD)</h4>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('consultations.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Record Visit</a>
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
                    <th>Visit ID</th>
                    <th>Date</th>
                    <th>Patient Name</th>
                    <th>Doctor Name</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($visits as $visit)
                <tr>
                    <td>{{ $visit->visit_id }}</td>
                    <td>{{ $visit->visit_date }}</td>
                    <td>{{ $visit->patient->name ?? 'N/A' }}</td>
                    <td>{{ $visit->doctor->name ?? 'N/A' }}</td>
                    <td>
                        <select class="form-select form-select-sm status-dropdown shadow-sm {{ $visit->status == 'Pending' ? 'bg-warning text-dark' : ($visit->status == 'Completed' ? 'bg-success text-white' : 'bg-secondary text-white') }}" data-id="{{ $visit->id }}" style="width: 110px; font-weight: 500; cursor: pointer;">
                            <option value="Pending" {{ $visit->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Completed" {{ $visit->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                            <option value="Cancelled" {{ $visit->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </td>
                    <td class="d-flex gap-1">
                        <a href="{{ route('consultations.show', $visit->id) }}" class="btn btn-sm btn-info text-white" title="View/Print"><i class="fa-solid fa-eye"></i></a>
                        <a href="{{ route('prescriptions.form', $visit->id) }}" class="btn btn-sm btn-success" title="Write Prescription"><i class="fa-solid fa-prescription"></i></a>
                        <a href="{{ route('consultations.edit', $visit->id) }}" class="btn btn-sm btn-warning" title="Edit"><i class="fa-solid fa-pen"></i></a>
                        <form action="{{ route('consultations.destroy', $visit->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this visit?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" title="Delete"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">No visits recorded.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $visits->links() }}
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const dropdowns = document.querySelectorAll('.status-dropdown');
    dropdowns.forEach(dropdown => {
        dropdown.addEventListener('change', function() {
            const visitId = this.dataset.id;
            const newStatus = this.value;
            const selectElement = this;

            fetch(`/consultations/${visitId}/status`, {
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
                    selectElement.className = 'form-select form-select-sm status-dropdown shadow-sm';
                    if (newStatus === 'Pending') selectElement.classList.add('bg-warning', 'text-dark');
                    else if (newStatus === 'Completed') selectElement.classList.add('bg-success', 'text-white');
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
