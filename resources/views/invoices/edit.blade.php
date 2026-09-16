@extends('layouts.admin')

@section('title', 'Update Invoice')

@section('content')
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Update Invoice Payment</h5>
        <span class="badge bg-secondary">{{ $invoice->invoice_no }}</span>
    </div>
    <div class="card-body">
        <form action="{{ route('invoices.update', $invoice->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Patient</label>
                    <input type="text" class="form-control bg-light" value="{{ $invoice->patient->name ?? 'N/A' }}" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Invoice Date</label>
                    <input type="date" class="form-control bg-light" value="{{ $invoice->date }}" readonly>
                </div>
                
                <hr class="mt-4">
                
                <div class="col-md-4">
                    <label class="form-label">Total Amount (৳)</label>
                    <input type="text" class="form-control bg-light" value="{{ number_format($invoice->total, 2) }}" readonly>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Paid Amount (৳) <span class="text-danger">*</span></label>
                    <input type="number" name="paid" class="form-control" step="0.01" value="{{ $invoice->paid }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Due Amount (৳)</label>
                    <input type="text" class="form-control bg-light" value="{{ number_format($invoice->due, 2) }}" readonly>
                </div>
            </div>
            
            <div class="mt-4 text-end">
                <a href="{{ route('invoices.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Payment</button>
            </div>
        </form>
    </div>
</div>
@endsection
