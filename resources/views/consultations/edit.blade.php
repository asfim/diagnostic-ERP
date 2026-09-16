@extends('layouts.admin')

@section('title', 'Edit OPD Visit')

@section('content')
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Edit OPD Visit</h5>
        <span class="badge bg-secondary">{{ $visit->visit_id }}</span>
    </div>
    <div class="card-body">
        <form action="{{ route('consultations.update', $visit->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Patient</label>
                    <input type="text" class="form-control bg-light" value="{{ $visit->patient->name ?? 'N/A' }}" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Doctor</label>
                    <input type="text" class="form-control bg-light" value="{{ $visit->doctor->name ?? 'N/A' }}" readonly>
                </div>
                
                <hr class="mt-4">
                
                <div class="col-md-12">
                    <label class="form-label">Symptoms / Chief Complaints</label>
                    <textarea name="symptoms" class="form-control" rows="2">{{ $visit->symptoms }}</textarea>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Blood Pressure</label>
                    <input type="text" name="blood_pressure" class="form-control" placeholder="e.g. 120/80" value="{{ $visit->blood_pressure }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Weight (kg)</label>
                    <input type="text" name="weight" class="form-control" value="{{ $visit->weight }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Temperature (Â°F)</label>
                    <input type="text" name="temperature" class="form-control" value="{{ $visit->temperature }}">
                </div>
                <div class="col-md-8">
                    <label class="form-label">General Notes</label>
                    <textarea name="notes" class="form-control" rows="2">{{ $visit->notes }}</textarea>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-select" required>
                        <option value="Pending" {{ $visit->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Completed" {{ $visit->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                        <option value="Cancelled" {{ $visit->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
            </div>
            
            <div class="mt-4 text-end">
                <a href="{{ route('consultations.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Visit</button>
            </div>
        </form>
    </div>
</div>
@endsection
