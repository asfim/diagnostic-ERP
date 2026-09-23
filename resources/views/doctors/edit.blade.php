@extends('layouts.admin')

@section('title', 'Edit Doctor')

@section('content')
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Edit Doctor: {{ $doctor->name }}</h5>
        <span class="badge bg-secondary">{{ $doctor->doctor_id }}</span>
    </div>
    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
        @endif
        <form action="{{ route('doctors.update', $doctor->id) }}" method="POST" enctype="multipart/form-data">
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
                <div class="col-md-12">
                    <label class="form-label">Profile Photo (Leave blank to keep current)</label>
                    <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror" accept="image/*">
                    @error('photo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @if($doctor->photo)
                        <div class="mt-2">
                            <img src="{{ asset('storage/'.$doctor->photo) }}" alt="Current Photo" width="80" class="rounded">
                        </div>
                    @endif
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
