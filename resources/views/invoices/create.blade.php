@extends('layouts.admin')

@section('title', 'Create Invoice')

@section('content')
<div class="card">
    <div class="card-header bg-white">
        <h5 class="mb-0">Generate New Bill</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('invoices.store') }}" method="POST">
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
                    <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}" required>
                </div>
                
                <hr class="mt-4">
                
                <div class="col-md-3">
                    <label class="form-label">Subtotal (৳) <span class="text-danger">*</span></label>
                    <input type="number" name="subtotal" class="form-control" step="0.01" value="0.00" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Discount (৳)</label>
                    <input type="number" name="discount" class="form-control" step="0.01" value="0.00">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Paid Amount (৳) <span class="text-danger">*</span></label>
                    <input type="number" name="paid" class="form-control" step="0.01" value="0.00" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Payment Method</label>
                    <select name="payment_method" class="form-select">
                        <option value="Cash">Cash</option>
                        <option value="Card">Card</option>
                        <option value="Mobile Banking">Mobile Banking</option>
                    </select>
                </div>
            </div>
            
            <div class="mt-4 text-end">
                <a href="{{ route('invoices.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Generate Invoice</button>
            </div>
        </form>
    </div>
</div>
@endsection
