@extends('layouts.admin')

@section('title', 'Edit Doctor')

@section('content')
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Edit Doctor: {{ $doctor->name }}</h5>
        <span class="badge bg-secondary">{{ $doctor->doctor_id }}</span>
    </div>
    <div class="card-body">
        <form action="{{ route('doctors.update', $doctor->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Full Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" required value="{{ $doctor->name }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Specialization <span class="text-danger">*</span></label>
                    <input type="text" name="specialization" class="form-control" placeholder="e.g. Cardiologist" required value="{{ $doctor->specialization }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Mobile Number <span class="text-danger">*</span></label>
                    <input type="text" name="mobile" class="form-control" required value="{{ $doctor->mobile }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" value="{{ $doctor->email }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Consultation Fee (৳) <span class="text-danger">*</span></label>
                    <input type="number" name="consultation_fee" class="form-control" step="0.01" required value="{{ $doctor->consultation_fee }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="1" {{ $doctor->status ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ !$doctor->status ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
            </div>
            <div class="mt-4 text-end">
                <a href="{{ route('doctors.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Doctor</button>
            </div>
        </form>
    </div>
</div>
@endsection
