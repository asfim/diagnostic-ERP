@extends('layouts.admin')

@section('title', 'Add Doctor')

@section('content')
<div class="card">
    <div class="card-header bg-white">
        <h5 class="mb-0">Register New Doctor</h5>
    </div>
    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
        @endif
        <form action="{{ route('doctors.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Full Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Specialization <span class="text-danger">*</span></label>
                    <input type="text" name="specialization" class="form-control" placeholder="e.g. Cardiologist" required value="{{ old('specialization') }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Mobile Number <span class="text-danger">*</span></label>
                    <input type="text" name="mobile" class="form-control" required value="{{ old('mobile') }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" id="doctorEmail" class="form-control" value="{{ old('email') }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Consultation Fee (৳) <span class="text-danger">*</span></label>
                    <input type="number" name="consultation_fee" class="form-control" step="0.01" value="{{ old('consultation_fee', '0.00') }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Profile Photo</label>
                    <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror" accept="image/*">
                    @error('photo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Login Account Section --}}
            <div class="card mt-4 border border-info border-opacity-50">
                <div class="card-header bg-info bg-opacity-10 d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fa-solid fa-lock text-info me-2"></i>
                        <span class="fw-semibold text-info">Create Login Account (Optional)</span>
                    </div>
                    <div class="form-check form-switch m-0">
                        <input class="form-check-input" type="checkbox" name="create_account" id="createAccountToggle" value="1" onchange="toggleAccountFields(this)" {{ old('create_account') ? 'checked' : '' }}>
                        <label class="form-check-label text-info fw-bold" for="createAccountToggle">Enable</label>
                    </div>
                </div>
                <div class="card-body" id="accountFields" style="{{ old('create_account') ? '' : 'display:none;' }}">
                    <div class="alert alert-info py-2 small">
                        <i class="fa-solid fa-circle-info me-1"></i>
                        ডাক্তার এই ইমেইল ও পাসওয়ার্ড দিয়ে সিস্টেমে লগইন করতে পারবেন। তাকে <strong>Doctor</strong> রোল অটোমেটিক অ্যাসাইন করা হবে।
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Login Email <span class="text-danger">*</span></label>
                            <input type="email" name="login_email" id="loginEmail" class="form-control" placeholder="doctor@clinic.com" value="{{ old('login_email') }}">
                            <div class="form-text">এই ইমেইলটি লগইনের জন্য ব্যবহার হবে।</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Password <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="password" name="password" id="passwordField" class="form-control" placeholder="Minimum 8 characters">
                                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword()">
                                    <i class="fa-solid fa-eye" id="eyeIcon"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 text-end">
                <a href="{{ route('doctors.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save me-1"></i> Save Doctor</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function toggleAccountFields(checkbox) {
        const fields = document.getElementById('accountFields');
        fields.style.display = checkbox.checked ? 'block' : 'none';
        
        // Sync email field
        if (checkbox.checked) {
            const doctorEmail = document.getElementById('doctorEmail').value;
            if (doctorEmail) {
                document.getElementById('loginEmail').value = doctorEmail;
            }
        }
    }

    function togglePassword() {
        const pwd = document.getElementById('passwordField');
        const icon = document.getElementById('eyeIcon');
        if (pwd.type === 'password') {
            pwd.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            pwd.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }

    // Auto-fill login email when doctor email is typed
    document.getElementById('doctorEmail').addEventListener('input', function() {
        const toggle = document.getElementById('createAccountToggle');
        if (toggle.checked) {
            document.getElementById('loginEmail').value = this.value;
        }
    });
</script>
@endpush
@endsection
