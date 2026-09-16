@extends('layouts.admin')

@section('title', 'Add New Test')

@section('content')
<div class="card">
    <div class="card-header bg-white">
        <h5 class="mb-0">Configure New Lab Test</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('tests.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Test Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" required placeholder="e.g. Complete Blood Count (CBC)">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Department <span class="text-danger">*</span></label>
                    <select name="department_id" class="form-select" required>
                        <option value="">-- Select Department --</option>
                        @foreach($departments as $dept)
                            <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Specimen Type</label>
                    <input type="text" name="specimen_type" class="form-control" placeholder="e.g. Blood, Urine">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Container</label>
                    <input type="text" name="container" class="form-control" placeholder="e.g. EDTA Tube">
                </div>
                
                <hr class="mt-4">
                
                <div class="col-md-4">
                    <label class="form-label">Patient Price (৳) <span class="text-danger">*</span></label>
                    <input type="number" name="price" class="form-control" step="0.01" value="0.00" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Lab Cost (৳) <span class="text-danger">*</span></label>
                    <input type="number" name="cost" class="form-control" step="0.01" value="0.00" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Turnaround Time (Hours)</label>
                    <input type="number" name="turnaround_time" class="form-control" value="24">
                </div>
            </div>
            
            <div class="mt-4 text-end">
                <a href="{{ route('tests.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Save Test</button>
            </div>
        </form>
    </div>
</div>
@endsection
