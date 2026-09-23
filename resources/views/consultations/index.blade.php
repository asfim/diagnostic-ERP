@extends('layouts.admin')

@section('title', 'OPD Consultations')

@section('content')

{{-- Page Header --}}
<div class="page-header-premium d-flex justify-content-between align-items-center">
    <div>
        <h4><i class="fa-solid fa-stethoscope me-2"></i>Patient Visits (OPD)</h4>
        <p>Record and manage out-patient department consultations</p>
    </div>
    <a href="{{ route('consultations.create') }}" class="btn btn-premium-new">
        <i class="fa-solid fa-plus me-2"></i>Record Visit
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
                    <th>Visit ID</th>
                    <th>Date</th>
                    <th>Patient Name</th>
                    <th>Doctor Name</th>
                    <th>Status</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($visits as $visit)
                <tr>
                    <td><span class="id-badge">{{ $visit->visit_id }}</span></td>
                    <td>
                        <span class="fw-semibold text-dark">{{ date('d M Y', strtotime($visit->visit_date)) }}</span>
                    </td>
                    <td><span class="fw-semibold text-dark">{{ $visit->patient->name ?? 'N/A' }}</span></td>
                    <td><span class="text-muted fw-medium">{{ $visit->doctor->name ?? 'N/A' }}</span></td>
                    <td>
                        <select class="form-select form-select-sm status-dropdown shadow-sm {{ $visit->status == 'Pending' ? 'bg-warning text-dark' : ($visit->status == 'Completed' ? 'bg-success text-white' : 'bg-secondary text-white') }}" data-id="{{ $visit->id }}" style="width: 110px; font-weight: 500; cursor: pointer; border-radius: 20px;">
                            <option value="Pending" {{ $visit->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Completed" {{ $visit->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                            <option value="Cancelled" {{ $visit->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('consultations.show', $visit->id) }}" class="action-btn action-btn-view" title="View/Print">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="{{ route('prescriptions.form', $visit->id) }}" class="action-btn" style="background: #ecfdf5; color: #10b981;" title="Write Prescription">
                                <i class="fa-solid fa-prescription"></i>
                            </a>
                            <a href="{{ route('consultations.edit', $visit->id) }}" class="action-btn action-btn-edit" title="Edit Visit">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <form action="{{ route('consultations.destroy', $visit->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this visit?');" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn action-btn-del" title="Delete">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">
                        <div class="empty-state">
                            <i class="fa-solid fa-clipboard-user"></i>
                            <strong>No visits recorded</strong>
                            <p class="mt-2 mb-0 small">Record a new patient visit to get started.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($visits->hasPages())
        <div class="px-4 py-3 border-top">
            {{ $visits->links() }}
        </div>
    @endif
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
