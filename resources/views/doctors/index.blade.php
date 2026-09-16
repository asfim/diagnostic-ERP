@extends('layouts.admin')

@section('title', 'Doctor Management')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h4>All Doctors</h4>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('doctors.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add Doctor</a>
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
                    <th>Doctor ID</th>
                    <th>Name</th>
                    <th>Specialization</th>
                    <th>Mobile</th>
                    <th>Fee (৳)</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($doctors as $doctor)
                <tr>
                    <td>{{ $doctor->doctor_id }}</td>
                    <td>{{ $doctor->name }}</td>
                    <td>{{ $doctor->specialization }}</td>
                    <td>{{ $doctor->mobile }}</td>
                    <td>{{ number_format($doctor->consultation_fee, 2) }}</td>
                    <td>
                        @if($doctor->status)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-danger">Inactive</span>
                        @endif
                    </td>
                    <td class="d-flex gap-1">
                        <a href="{{ route('doctors.edit', $doctor->id) }}" class="btn btn-sm btn-warning" title="Edit"><i class="fa-solid fa-pen"></i></a>
                        <form action="{{ route('doctors.destroy', $doctor->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this doctor?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" title="Delete"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">No doctors found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $doctors->links() }}
    </div>
</div>
@endsection
