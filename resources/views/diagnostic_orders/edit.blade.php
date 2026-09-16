@extends('layouts.admin')

@section('title', 'Edit Lab Order')

@section('content')
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Edit Lab Order Status</h5>
        <span class="badge bg-secondary">{{ $order->order_id }}</span>
    </div>
    <div class="card-body">
        <form action="{{ route('diagnostic-orders.update', $order->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Patient</label>
                    <input type="text" class="form-control bg-light" value="{{ $order->patient->name ?? 'N/A' }}" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Order Date</label>
                    <input type="date" class="form-control bg-light" value="{{ $order->order_date }}" readonly>
                </div>
                
                <hr class="mt-4">
                
                <div class="col-md-4">
                    <label class="form-label">Total Amount (৳)</label>
                    <input type="text" class="form-control bg-light" value="{{ number_format($order->total_amount, 2) }}" readonly>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Paid Amount (৳)</label>
                    <input type="text" class="form-control bg-light" value="{{ number_format($order->paid_amount, 2) }}" readonly>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Due Amount (৳)</label>
                    <input type="text" class="form-control bg-light" value="{{ number_format($order->due_amount, 2) }}" readonly>
                </div>
                
                <div class="col-md-4 mt-4">
                    <label class="form-label">Order Status <span class="text-danger">*</span></label>
                    <select name="order_status" class="form-select" required>
                        <option value="Pending" {{ $order->order_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Processing" {{ $order->order_status == 'Processing' ? 'selected' : '' }}>Processing</option>
                        <option value="Completed" {{ $order->order_status == 'Completed' ? 'selected' : '' }}>Completed</option>
                        <option value="Cancelled" {{ $order->order_status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
            </div>
            
            <div class="mt-4 text-end">
                <a href="{{ route('diagnostic-orders.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Status</button>
            </div>
        </form>
    </div>
</div>
@endsection
