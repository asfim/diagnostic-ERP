@extends('layouts.admin')

@section('title', 'Add Doctor')

@section('content')
<div class="card">
    <div class="card-header bg-white">
        <h5 class="mb-0">Register New Doctor</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('doctors.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Full Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Specialization <span class="text-danger">*</span></label>
                    <input type="text" name="specialization" class="form-control" placeholder="e.g. Cardiologist" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Mobile Number <span class="text-danger">*</span></label>
                    <input type="text" name="mobile" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Consultation Fee (৳) <span class="text-danger">*</span></label>
                    <input type="number" name="consultation_fee" class="form-control" step="0.01" value="0.00" required>
                </div>
            </div>
            <div class="mt-4 text-end">
                <a href="{{ route('doctors.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Save Doctor</button>
            </div>
        </form>
    </div>
</div>
@endsection
