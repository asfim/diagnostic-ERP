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
                
                <div class="col-md-12">
                    <label class="form-label">Select Tests <span class="text-danger">*</span></label>
                    <select name="tests[]" id="tests" class="form-select select2" multiple required>
                        @foreach($tests as $test)
                            <option value="{{ $test->id }}" 
                                data-price="{{ $test->price }}"
                                {{ in_array($test->id, $selectedTestIds) ? 'selected' : '' }}>
                                {{ $test->name }} (৳{{ $test->price }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <hr class="mt-4">
                
                <div class="col-md-4">
                    <label class="form-label">Total Amount (৳)</label>
                    <input type="number" id="totalAmount" name="total_amount" class="form-control bg-light" value="{{ $order->total_amount }}" readonly>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Discount (৳)</label>
                    <input type="number" name="discount" id="discountInput" class="form-control" step="0.01" value="{{ $order->discount }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Paid Amount (৳)</label>
                    <input type="number" name="paid_amount" id="paidInput" class="form-control" step="0.01" value="{{ $order->paid_amount }}">
                    <small class="text-muted d-block mt-1">Net Payable: <strong class="text-primary">৳<span id="netPayableDisplay">{{ number_format($order->total_amount - $order->discount, 2) }}</span></strong></small>
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

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function() {
    $('#tests').select2({
        placeholder: 'Select tests...',
        allowClear: true
    });

    const totalAmountInput = document.getElementById('totalAmount');
    const discountInput = document.getElementById('discountInput');
    const paidInput = document.getElementById('paidInput');
    const dueAmountDisplay = document.getElementById('dueAmount');
    const netPayableDisplay = document.getElementById('netPayableDisplay');
    
    $('#tests').on('change', calculateTotal);
    discountInput.addEventListener('input', calculateTotal);
    paidInput.addEventListener('input', calculateTotal);

    function calculateTotal() {
        // Calculate new total from selected tests
        let total = 0;
        const selectedOptions = document.getElementById('tests').selectedOptions;
        for (let i = 0; i < selectedOptions.length; i++) {
            total += parseFloat(selectedOptions[i].getAttribute('data-price')) || 0;
        }
        
        totalAmountInput.value = total.toFixed(2);
        
        const discount = parseFloat(discountInput.value) || 0;
        let paid = parseFloat(paidInput.value) || 0;
        
        const netPayable = total - discount;
        if(netPayableDisplay) {
            netPayableDisplay.textContent = netPayable.toFixed(2);
        }

        const due = netPayable - paid;
        dueAmountDisplay.textContent = due.toFixed(2);
    }
});
</script>
@endsection
