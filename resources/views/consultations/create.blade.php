@extends('layouts.admin')

@section('title', 'Record OPD Visit')

@section('content')
<div class="card">
    <div class="card-header bg-white">
        <h5 class="mb-0">New Patient Visit</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('consultations.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Select Patient <span class="text-danger">*</span></label>
                    <select name="patient_id" class="form-select" required>
                        <option value="">-- Select Patient --</option>
                        @foreach($patients as $patient)
                            <option value="{{ $patient->id }}">{{ $patient->patient_id }} - {{ $patient->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Select Doctor <span class="text-danger">*</span></label>
                    <select name="doctor_id" class="form-select" required>
                        <option value="">-- Select Doctor --</option>
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}">{{ $doctor->name }} ({{ $doctor->specialization }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Date <span class="text-danger">*</span></label>
                    <input type="date" name="visit_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                </div>
                
                <hr class="mt-4">
                <h6 class="mb-3">Vitals & Symptoms</h6>
                
                <div class="col-md-3">
                    <label class="form-label">Blood Pressure (mmHg)</label>
                    <input type="text" name="blood_pressure" class="form-control" placeholder="e.g. 120/80">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Weight (kg)</label>
                    <input type="text" name="weight" class="form-control" placeholder="e.g. 70">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Temperature (°F)</label>
                    <input type="text" name="temperature" class="form-control" placeholder="e.g. 98.6">
                </div>
                <div class="col-md-12">
                    <label class="form-label">Symptoms / Chief Complaints</label>
                    <textarea name="symptoms" class="form-control" rows="3" placeholder="Fever, cough, headache..."></textarea>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Doctor Notes</label>
                    <textarea name="notes" class="form-control" rows="3"></textarea>
                </div>
            </div>
            
            <div class="mt-4 text-end">
                <a href="{{ route('consultations.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Save Visit</button>
            </div>
        </form>
    </div>
</div>
@endsection
