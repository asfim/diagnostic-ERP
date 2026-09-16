@extends('layouts.admin')

@section('title', 'Book Appointment')

@section('content')
<div class="card">
    <div class="card-header bg-white">
        <h5 class="mb-0">New Appointment</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('appointments.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Select Patient <span class="text-danger">*</span></label>
                    <select name="patient_id" class="form-select" required>
                        <option value="">-- Select Patient --</option>
                        @foreach($patients as $patient)
                            <option value="{{ $patient->id }}">{{ $patient->patient_id }} - {{ $patient->name }} ({{ $patient->mobile }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Select Doctor <span class="text-danger">*</span></label>
                    <select name="doctor_id" class="form-select" required>
                        <option value="">-- Select Doctor --</option>
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}">{{ $doctor->name }} ({{ $doctor->specialization }}) - ৳{{ $doctor->consultation_fee }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Date <span class="text-danger">*</span></label>
                    <input type="date" name="date" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Time <span class="text-danger">*</span></label>
                    <input type="time" name="time" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Type</label>
                    <select name="appointment_type" class="form-select">
                        <option value="New">New</option>
                        <option value="Follow-up">Follow-up</option>
                    </select>
                </div>
                
                <hr class="mt-4">
                
                <div class="col-md-4">
                    <label class="form-label">Consultation Fee (৳)</label>
                    <input type="number" name="consultation_fee" class="form-control" step="0.01" value="500" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Discount (৳)</label>
                    <input type="number" name="discount" class="form-control" step="0.01" value="0">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Paid Amount (৳)</label>
                    <input type="number" name="paid" class="form-control" step="0.01" value="500" required>
                </div>
            </div>
            
            <div class="mt-4 text-end">
                <a href="{{ route('appointments.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Confirm Appointment</button>
            </div>
        </form>
    </div>
</div>
@endsection
