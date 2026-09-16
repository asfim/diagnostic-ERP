@extends('layouts.admin')

@section('title', 'New Lab Order')

@section('content')
<div class="card">
    <div class="card-header bg-white">
        <h5 class="mb-0">Create Diagnostic Order</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('diagnostic-orders.store') }}" method="POST">
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
                    <label class="form-label">Date <span class="text-danger">*</span></label>
                    <input type="date" name="order_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                </div>
                
                <hr class="mt-4">
                
                <div class="col-md-4">
                    <label class="form-label">Total Amount (৳) <span class="text-danger">*</span></label>
                    <input type="number" name="total_amount" class="form-control" step="0.01" value="0.00" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Discount (৳)</label>
                    <input type="number" name="discount" class="form-control" step="0.01" value="0.00">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Paid Amount (৳) <span class="text-danger">*</span></label>
                    <input type="number" name="paid_amount" class="form-control" step="0.01" value="0.00" required>
                </div>
            </div>
            
            <div class="mt-4 text-end">
                <a href="{{ route('diagnostic-orders.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Create Order</button>
            </div>
        </form>
    </div>
</div>
@endsection
