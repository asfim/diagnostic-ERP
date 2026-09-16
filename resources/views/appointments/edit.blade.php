@extends('layouts.admin')

@section('title', 'Edit Appointment')

@section('content')
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Edit Appointment</h5>
        <span class="badge bg-secondary">{{ $appointment->appointment_id }}</span>
    </div>
    <div class="card-body">
        <form action="{{ route('appointments.update', $appointment->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Patient</label>
                    <input type="text" class="form-control bg-light" value="{{ $appointment->patient->name ?? 'N/A' }}" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Doctor</label>
                    <input type="text" class="form-control bg-light" value="{{ $appointment->doctor->name ?? 'N/A' }}" readonly>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Date <span class="text-danger">*</span></label>
                    <input type="date" name="date" class="form-control" required value="{{ $appointment->date }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Time <span class="text-danger">*</span></label>
                    <input type="time" name="time" class="form-control" required value="{{ $appointment->time }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-select" required>
                        <option value="Pending" {{ $appointment->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Confirmed" {{ $appointment->status == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="Completed" {{ $appointment->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                        <option value="Cancelled" {{ $appointment->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
            </div>
            
            <div class="mt-4 text-end">
                <a href="{{ route('appointments.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Appointment</button>
            </div>
        </form>
    </div>
</div>
@endsection
