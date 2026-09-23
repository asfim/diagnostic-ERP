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
                    <h6 class="mb-3">Select Tests</h6>
                    <div class="row g-2 align-items-end mb-3">
                        <div class="col-md-8">
                            <label class="form-label">Test Name</label>
                            <select id="testSelect" class="form-select">
                                <option value="" data-price="0">-- Select Test --</option>
                                @foreach($tests as $test)
                                    <option value="{{ $test->id }}" data-name="{{ $test->name }}" data-price="{{ $test->price }}">{{ $test->name }} ({{ $test->test_code }}) - ৳{{ $test->price }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-success w-100" id="addTestBtn"><i class="fa-solid fa-plus"></i> Add Test</button>
                        </div>
                    </div>
                    
                    <table class="table table-bordered table-sm" id="testsTable">
                        <thead class="table-light">
                            <tr>
                                <th>Test Name</th>
                                <th width="20%">Price (৳)</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody id="testList">
                            <tr id="emptyRow">
                                <td colspan="3" class="text-center text-muted">No tests added yet.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <hr class="mt-2">
                
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
    const testSelect = document.getElementById('testSelect');
    const addTestBtn = document.getElementById('addTestBtn');
    const testList = document.getElementById('testList');
    const emptyRow = document.getElementById('emptyRow');
    
    const totalAmountInput = document.getElementById('totalAmount');
    const discountInput = document.getElementById('discountInput');
    const paidInput = document.getElementById('paidInput');
    const dueAmountDisplay = document.getElementById('dueAmount');
    const submitBtn = document.getElementById('submitBtn');
    
    let tests = [];

    // Add Test
    addTestBtn.addEventListener('click', function() {
        const selectedOption = testSelect.options[testSelect.selectedIndex];
        const testId = selectedOption.value;
        
        if (!testId) {
            alert('Please select a test first.');
            return;
        }
        
        // Prevent duplicate
        if (tests.find(t => t.id === testId)) {
            alert('This test is already added.');
            return;
        }

        const testName = selectedOption.getAttribute('data-name');
        const testPrice = parseFloat(selectedOption.getAttribute('data-price') || 0);

        tests.push({ id: testId, name: testName, price: testPrice });
        
        // Clear selection
        testSelect.value = "";
        
        renderTests();
    });

    // Remove Test (Event Delegation)
    testList.addEventListener('click', function(e) {
        if (e.target.closest('.remove-btn')) {
            const index = e.target.closest('.remove-btn').getAttribute('data-index');
            tests.splice(index, 1);
            renderTests();
        }
    });

    // Calculate Due automatically when discount or paid amount changes
    discountInput.addEventListener('input', calculateTotal);
    paidInput.addEventListener('input', calculateTotal);

    function renderTests() {
        testList.innerHTML = '';
        
        if (tests.length === 0) {
            testList.appendChild(emptyRow);
            emptyRow.style.display = 'table-row';
            totalAmountInput.value = '0.00';
            calculateTotal();
            return;
        }
        
        emptyRow.style.display = 'none';
        
        let sum = 0;
        tests.forEach((t, index) => {
            sum += t.price;
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>
                    ${t.name}
                    <input type="hidden" name="tests[]" value="${t.id}">
                </td>
                <td>
                    ${t.price.toFixed(2)}
                    <input type="hidden" name="prices[]" value="${t.price}">
                </td>
                <td>
                    <button type="button" class="btn btn-sm btn-danger remove-btn" data-index="${index}"><i class="fa-solid fa-times"></i></button>
                </td>
            `;
            testList.appendChild(tr);
        });
        
        totalAmountInput.value = sum.toFixed(2);
        calculateTotal();
    }

    function calculateTotal() {
        const total = parseFloat(totalAmountInput.value) || 0;
        const discount = parseFloat(discountInput.value) || 0;
        const paid = parseFloat(paidInput.value) || 0;
        
        const due = total - discount - paid;
        dueAmountDisplay.textContent = due.toFixed(2);
    }
    
    // Validate on submit
    document.getElementById('orderForm').addEventListener('submit', function(e) {
        if (tests.length === 0) {
            e.preventDefault();
            alert('Please add at least one test to the order.');
        }
    });
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
    });
</script>
@endpush
