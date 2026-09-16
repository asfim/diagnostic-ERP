@extends('layouts.admin')

@section('title', 'Edit Lab Result')

@section('content')
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Edit Test Result</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('test-results.update', $result->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Patient</label>
                    <input type="text" class="form-control bg-light" value="{{ $result->patient->name ?? 'N/A' }}" readonly>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Order ID</label>
                    <input type="text" class="form-control bg-light" value="{{ $result->diagnostic_order_id }}" readonly>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Test</label>
                    <input type="text" class="form-control bg-light" value="{{ $result->test->name ?? 'N/A' }}" readonly>
                </div>
                
                <hr class="mt-4">
                
                <div class="col-md-6">
                    <label class="form-label">Result Value <span class="text-danger">*</span></label>
                    <input type="text" name="result_value" class="form-control" required value="{{ $result->result_value }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-select" required>
                        <option value="Completed" {{ $result->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                        <option value="Pending" {{ $result->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Review" {{ $result->status == 'Review' ? 'selected' : '' }}>Review</option>
                    </select>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Remarks / Notes</label>
                    <textarea name="remarks" class="form-control" rows="3">{{ $result->remarks }}</textarea>
                </div>
            </div>
            
            <div class="mt-4 text-end">
                <a href="{{ route('test-results.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Result</button>
            </div>
        </form>
    </div>
</div>
@endsection
