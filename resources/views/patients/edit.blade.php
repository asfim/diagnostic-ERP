@extends('layouts.admin')

@section('title', 'Edit Patient')

@section('content')
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Edit Patient: {{ $patient->name }}</h5>
        <span class="badge bg-secondary">{{ $patient->patient_id }}</span>
    </div>
    <div class="card-body">
        <form action="{{ route('patients.update', $patient->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Full Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" required value="{{ $patient->name }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Mobile Number <span class="text-danger">*</span></label>
                    <input type="text" name="mobile" class="form-control" required value="{{ $patient->mobile }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Age</label>
                    <input type="number" name="age" class="form-control" value="{{ $patient->age }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Gender</label>
                    <select name="gender" class="form-select">
                        <option value="">Select</option>
                        <option value="Male" {{ strtolower($patient->gender) == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ strtolower($patient->gender) == 'female' ? 'selected' : '' }}>Female</option>
                        <option value="Other" {{ strtolower($patient->gender) == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Blood Group</label>
                    <select name="blood_group" class="form-select">
                        <option value="">Select</option>
                        <option value="A+" {{ $patient->blood_group == 'A+' ? 'selected' : '' }}>A+</option>
                        <option value="A-" {{ $patient->blood_group == 'A-' ? 'selected' : '' }}>A-</option>
                        <option value="B+" {{ $patient->blood_group == 'B+' ? 'selected' : '' }}>B+</option>
                        <option value="B-" {{ $patient->blood_group == 'B-' ? 'selected' : '' }}>B-</option>
                        <option value="AB+" {{ $patient->blood_group == 'AB+' ? 'selected' : '' }}>AB+</option>
                        <option value="AB-" {{ $patient->blood_group == 'AB-' ? 'selected' : '' }}>AB-</option>
                        <option value="O+" {{ $patient->blood_group == 'O+' ? 'selected' : '' }}>O+</option>
                        <option value="O-" {{ $patient->blood_group == 'O-' ? 'selected' : '' }}>O-</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Address</label>
                    <input type="text" name="address" class="form-control" value="{{ $patient->address }}">
                </div>
            </div>
            <div class="mt-4 text-end">
                <a href="{{ route('patients.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Patient</button>
            </div>
        </form>
    </div>
</div>
@endsection
