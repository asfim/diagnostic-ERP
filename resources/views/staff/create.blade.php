@extends('layouts.admin')

@section('title', 'Add New Staff')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Add New Staff</h4>
    <a href="{{ route('staff.index') }}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left me-1"></i> Back</a>
</div>

<div class="card">
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('staff.store') }}" method="POST">
            @csrf
            
            <h6 class="mb-3 border-bottom pb-2">Personal Information</h6>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label">Name *</label>
                    <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Designation *</label>
                    <input type="text" name="designation" class="form-control" required value="{{ old('designation') }}" placeholder="e.g. Receptionist, Lab Tech">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                </div>
            </div>

            <h6 class="mb-3 border-bottom pb-2 mt-4">Login & Role Settings</h6>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label">Email Address *</label>
                    <input type="email" name="email" class="form-control" required value="{{ old('email') }}" placeholder="staff@example.com">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Password *</label>
                    <input type="password" name="password" class="form-control" required minlength="6">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Assign Role *</label>
                    <select name="role" class="form-select" required>
                        <option value="">Select Role</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mt-4 text-end">
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save"></i> Save Staff</button>
            </div>
        </form>
    </div>
</div>
@endsection
