@extends('layouts.admin')

@section('title', 'New Lab Order')

@section('content')
<div class="card">
    <div class="card-header bg-white">
        <h5 class="mb-0">Create Diagnostic Order</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('diagnostic-orders.store') }}" method="POST" id="orderForm">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Select Patient <span class="text-danger">*</span></label>
                    <select name="patient_id" class="form-select select2-patient" required>
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

                <!-- Dynamic Test Selection -->
                <div class="col-md-12">
                    <label class="form-label">Select Tests <span class="text-danger">*</span></label>
                    <select name="tests[]" id="testSelect" class="form-select select2-tests" multiple required>
                        @foreach($tests as $test)
                            <option value="{{ $test->id }}" data-price="{{ $test->price }}">{{ $test->name }} ({{ $test->test_code }}) - ৳{{ number_format($test->price, 2) }}</option>
                        @endforeach
                    </select>
                </div>

                <hr class="mt-4">
                
                <div class="col-md-4">
                    <label class="form-label">Total Amount (৳) <span class="text-danger">*</span></label>
                    <input type="number" name="total_amount" id="totalAmount" class="form-control bg-light" step="0.01" value="0.00" readonly>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Discount (৳)</label>
                    <input type="number" name="discount" id="discountInput" class="form-control" step="0.01" value="0.00">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Paid Amount (৳) <span class="text-danger">*</span></label>
                    <input type="number" name="paid_amount" id="paidInput" class="form-control" step="0.01" value="0.00" required>
                </div>
                <div class="col-md-12">
                    <div class="alert alert-info py-2 mt-2 text-end">
                        <strong>Due Amount: ৳<span id="dueAmount">0.00</span></strong>
                    </div>
                </div>
            </div>
            
            <div class="mt-4 text-end">
                <a href="{{ route('diagnostic-orders.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary" id="submitBtn">Create Order</button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const testSelect = $('#testSelect');
    const totalAmountInput = document.getElementById('totalAmount');
    const discountInput = document.getElementById('discountInput');
    const paidInput = document.getElementById('paidInput');
    const dueAmountDisplay = document.getElementById('dueAmount');

    // Calculate sum when selection changes
    testSelect.on('change', function() {
        let sum = 0;
        const selectedOptions = $(this).find('option:selected');
        selectedOptions.each(function() {
            sum += parseFloat($(this).data('price')) || 0;
        });
        
        totalAmountInput.value = sum.toFixed(2);
        calculateTotal();
    });

    // Calculate Due automatically when discount or paid amount changes
    discountInput.addEventListener('input', calculateTotal);
    paidInput.addEventListener('input', calculateTotal);

    function calculateTotal() {
        const total = parseFloat(totalAmountInput.value) || 0;
        const discount = parseFloat(discountInput.value) || 0;
        const paid = parseFloat(paidInput.value) || 0;
        
        const due = total - discount - paid;
        dueAmountDisplay.textContent = due.toFixed(2);
    }
});
</script>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2-patient').select2({
            theme: 'bootstrap-5',
            placeholder: "-- Select Patient --",
            allowClear: true,
            width: '100%'
        });
        
        $('.select2-tests').select2({
            theme: 'bootstrap-5',
            placeholder: "-- Select Tests --",
            allowClear: true,
            width: '100%'
        });
    });
</script>
@endpush
