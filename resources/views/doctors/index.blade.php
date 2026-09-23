@extends('layouts.admin')

@section('title', 'Doctor Management')

@section('content')

{{-- Page Header --}}
<div class="page-header-premium d-flex justify-content-between align-items-center">
    <div>
        <h4><i class="fa-solid fa-user-doctor me-2"></i>Doctors</h4>
        <p>Manage hospital doctors and their specializations</p>
    </div>
    <a href="{{ route('doctors.create') }}" class="btn btn-premium-new">
        <i class="fa-solid fa-plus me-2"></i>Add Doctor
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
                    <th>Doctor ID</th>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Specialization</th>
                    <th>Mobile</th>
                    <th>Fee (৳)</th>
                    <th>Status</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($doctors as $doctor)
                <tr>
                    <td><span class="id-badge">{{ $doctor->doctor_id }}</span></td>
                    <td>
                        @if($doctor->photo)
                            <img src="{{ asset('storage/'.$doctor->photo) }}" alt="Photo" class="rounded-circle" style="width:40px; height:40px; object-fit:cover;">
                        @else
                            <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center text-white" style="width:40px; height:40px;">
                                <i class="fa-solid fa-user"></i>
                            </div>
                        @endif
                    </td>
                    <td><span class="fw-semibold text-dark">{{ $doctor->name }}</span></td>
                    <td><span class="text-muted">{{ $doctor->specialization }}</span></td>
                    <td>{{ $doctor->mobile }}</td>
                    <td class="fw-bold text-success">৳ {{ number_format($doctor->consultation_fee, 2) }}</td>
                    <td>
                        @if($doctor->status)
                            <span class="status-pill pill-success"><i class="fa-solid fa-check-circle"></i> Active</span>
                        @else
                            <span class="status-pill pill-danger"><i class="fa-solid fa-xmark-circle"></i> Inactive</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('doctors.edit', $doctor->id) }}" class="action-btn action-btn-edit" title="Edit Doctor">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <form action="{{ route('doctors.destroy', $doctor->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this doctor?');" class="d-inline">
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
                    <td colspan="8">
                        <div class="empty-state">
                            <i class="fa-solid fa-stethoscope"></i>
                            <strong>No doctors found</strong>
                            <p class="mt-2 mb-0 small">Add a new doctor to your system.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($doctors->hasPages())
        <div class="px-4 py-3 border-top">
            {{ $doctors->links() }}
        </div>
    @endif
</div>
@endsection
