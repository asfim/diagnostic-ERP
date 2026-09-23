@extends('layouts.admin')

@section('title', 'Patient Management')

@section('content')

{{-- Page Header --}}
<div class="page-header-premium d-flex justify-content-between align-items-center">
    <div>
        <h4><i class="fa-solid fa-users me-2"></i>Patients</h4>
        <p>Manage all registered patients in the diagnostic center</p>
    </div>
    <a href="{{ route('patients.create') }}" class="btn btn-premium-new">
        <i class="fa-solid fa-plus me-2"></i>New Patient
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
                    <th>Patient ID</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($patients as $patient)
                <tr>
                    <td><span class="id-badge">{{ $patient->patient_id }}</span></td>
                    <td><span class="fw-semibold text-dark">{{ $patient->name }}</span></td>
                    <td>{{ $patient->mobile ?? $patient->phone ?? 'N/A' }}</td>
                    <td>{{ $patient->age }}</td>
                    <td>
                        @if(strtolower($patient->gender) == 'male')
                            <span class="status-pill pill-primary"><i class="fa-solid fa-mars"></i> {{ ucfirst($patient->gender) }}</span>
                        @elseif(strtolower($patient->gender) == 'female')
                            <span class="status-pill" style="background:#fce7f3; color:#db2777"><i class="fa-solid fa-venus"></i> {{ ucfirst($patient->gender) }}</span>
                        @else
                            <span class="status-pill pill-secondary">{{ ucfirst($patient->gender) }}</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('patients.edit', $patient->id) }}" class="action-btn action-btn-edit" title="Edit Patient">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <form action="{{ route('patients.destroy', $patient->id) }}" method="POST" onsubmit="return confirm('Delete this patient?');" class="d-inline">
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
                            <i class="fa-solid fa-user-injured"></i>
                            <strong>No patients found</strong>
                            <p class="mt-2 mb-0 small">Register a new patient to get started.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($patients->hasPages())
        <div class="px-4 py-3 border-top">
            {{ $patients->links() }}
        </div>
    @endif
</div>
@endsection
