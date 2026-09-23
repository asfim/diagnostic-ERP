@extends('layouts.admin')

@section('title', 'Enter Lab Result')

@push('styles')
<style>
    .result-card {
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,.05);
        border: none;
    }
    .result-card .card-header {
        background: #fff;
        border-bottom: 1px solid #f1f5f9;
        padding: 20px 25px;
        border-radius: 12px 12px 0 0;
    }
    .form-section-title {
        font-size: 0.9rem;
        font-weight: 700;
        color: #475569;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 15px;
        border-bottom: 2px solid #e2e8f0;
        padding-bottom: 8px;
    }
    .parameter-table th {
        background: #f8fafc;
        font-size: 0.8rem;
        text-transform: uppercase;
        color: #64748b;
        font-weight: 600;
    }
    .parameter-table td {
        vertical-align: middle;
    }
</style>
@endpush

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card result-card">
            <div class="card-header">
                <h5 class="mb-0 text-primary"><i class="fa-solid fa-flask-vial me-2"></i> Enter New Lab Result</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('test-results.store') }}" method="POST" id="resultForm">
                    @csrf
                    
                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Select Lab Order <span class="text-danger">*</span></label>
                            <select name="diagnostic_order_id" id="orderSelect" class="form-select" required>
                                <option value="">-- Choose Pending Order --</option>
                                @foreach($orders as $order)
                                    <option value="{{ $order->id }}">
                                        {{ $order->order_id }} ({{ $order->patient->name ?? 'Unknown' }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Select Test <span class="text-danger">*</span></label>
                            <select name="test_id" id="testSelect" class="form-select" required disabled>
                                <option value="">-- First Choose an Order --</option>
                            </select>
                        </div>
                    </div>

                    <!-- Dynamic Parameters Area -->
                    <div id="parametersArea" style="display: none;">
                        <div class="form-section-title mt-4">Test Parameters</div>
                        
                        <div class="table-responsive">
                            <table class="table table-bordered parameter-table">
                                <thead>
                                    <tr>
                                        <th width="35%">Parameter Name</th>
                                        <th width="30%">Result Value <span class="text-danger">*</span></th>
                                        <th width="15%">Unit</th>
                                        <th width="20%">Reference Range</th>
                                    </tr>
                                </thead>
                                <tbody id="parametersList">
                                    <!-- Populated by JS -->
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Single Result Fallback (if no parameters) -->
                    <div id="singleResultArea" style="display: none;" class="mt-4">
                        <div class="form-section-title">Result</div>
                        <div class="col-md-12">
                            <label class="form-label">Result Value <span class="text-danger">*</span></label>
                            <input type="text" name="result_value" id="singleResultInput" class="form-control" placeholder="e.g. 14.5 g/dL">
                        </div>
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="form-section-title">Final Remarks / Interpretation</div>
                            <textarea name="remarks" class="form-control" rows="3" placeholder="Normal, High, Low, or any specific notes..."></textarea>
                        </div>
                    </div>
                    
                    <div class="mt-4 text-end">
                        <a href="{{ route('test-results.index') }}" class="btn btn-secondary px-4 me-2">Cancel</a>
                        <button type="submit" class="btn btn-primary px-4"><i class="fa-solid fa-save me-1"></i> Save Result</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Pass PHP data to JS
    const orders = @json($orders);
    const tests = @json($tests);
    
    document.addEventListener('DOMContentLoaded', function() {
        const orderSelect = document.getElementById('orderSelect');
        const testSelect = document.getElementById('testSelect');
        const parametersArea = document.getElementById('parametersArea');
        const parametersList = document.getElementById('parametersList');
        const singleResultArea = document.getElementById('singleResultArea');
        const singleResultInput = document.getElementById('singleResultInput');

        // Order Selection Change
        orderSelect.addEventListener('change', function() {
            const orderId = this.value;
            testSelect.innerHTML = '<option value="">-- Select Test --</option>';
            testSelect.disabled = true;
            parametersArea.style.display = 'none';
            singleResultArea.style.display = 'none';

            if (!orderId) return;

            // Find the selected order and its items
            const order = orders.find(o => o.id == orderId);
            if (order && order.items && order.items.length > 0) {
                testSelect.disabled = false;
                order.items.forEach(item => {
                    if (item.test) {
                        const option = document.createElement('option');
                        option.value = item.test.id;
                        option.textContent = item.test.name;
                        testSelect.appendChild(option);
                    }
                });
                
                // Auto-select if there's only 1 test in the order
                if (order.items.length === 1 && order.items[0].test) {
                    testSelect.value = order.items[0].test.id;
                    // Trigger change event to load parameters
                    testSelect.dispatchEvent(new Event('change'));
                }
            } else {
                testSelect.innerHTML = '<option value="">No tests found in this order</option>';
            }
        });

        // Test Selection Change
        testSelect.addEventListener('change', function() {
            const testId = this.value;
            parametersList.innerHTML = '';
            
            if (!testId) {
                parametersArea.style.display = 'none';
                singleResultArea.style.display = 'none';
                return;
            }

            // Find test details from master tests list to get parameters
            const testDetails = tests.find(t => t.id == testId);
            
            if (testDetails && testDetails.parameters && testDetails.parameters.length > 0) {
                // Has multiple parameters
                parametersArea.style.display = 'block';
                singleResultArea.style.display = 'none';
                singleResultInput.required = false;

                testDetails.parameters.forEach((param, index) => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>
                            <strong>${param.name}</strong>
                            <input type="hidden" name="parameters[${index}][id]" value="${param.id}">
                        </td>
                        <td>
                            <input type="text" name="parameters[${index}][value]" class="form-control form-control-sm" required>
                        </td>
                        <td class="text-muted text-center">${param.unit || '-'}</td>
                        <td class="text-muted" style="font-size:0.8rem">${param.reference_range || '-'}</td>
                    `;
                    parametersList.appendChild(tr);
                });
            } else {
                // No parameters defined, show single result input
                parametersArea.style.display = 'none';
                singleResultArea.style.display = 'block';
                singleResultInput.required = true;
            }
        });
    });
</script>
@endpush
