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
                    <input type="number" id="totalAmount" class="form-control bg-light" value="{{ $order->total_amount }}" readonly>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Discount (৳)</label>
                    <input type="number" name="discount" id="discountInput" class="form-control" step="0.01" value="{{ $order->discount }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Paid Amount (৳)</label>
                    <input type="number" name="paid_amount" id="paidInput" class="form-control" step="0.01" value="{{ $order->paid_amount }}">
                </div>
                
                <div class="col-md-12">
                    <div class="alert alert-info py-2 mt-2 text-end">
                        <strong>Due Amount: ৳<span id="dueAmount">{{ number_format($order->due_amount, 2) }}</span></strong>
                    </div>
                </div>
                
                <div class="col-md-4 mt-2">
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
                <button type="submit" class="btn btn-primary">Update Order</button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const totalAmountInput = document.getElementById('totalAmount');
    const discountInput = document.getElementById('discountInput');
    const paidInput = document.getElementById('paidInput');
    const dueAmountDisplay = document.getElementById('dueAmount');
    discountInput.addEventListener('input', calculateTotal);
    paidInput.addEventListener('input', calculateTotal);

    function calculateTotal() {
        const total = parseFloat(totalAmountInput.value) || 0;
        const discount = parseFloat(discountInput.value) || 0;
        let paid = parseFloat(paidInput.value) || 0;
        
        // Prevent overpaying theoretically, though partial checks allow it.
        if(paid > (total - discount)) {
            // Optional: You could cap it here if you want
        }

        const due = total - discount - paid;
        dueAmountDisplay.textContent = due.toFixed(2);
    }
});
</script>
@endsection
