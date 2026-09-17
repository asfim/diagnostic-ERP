@extends('layouts.admin')

@section('title', 'Book Appointment')

@section('content')
<div class="card">
    <div class="card-header bg-white">
        <h5 class="mb-0">New Appointment</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('appointments.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Select Patient <span class="text-danger">*</span></label>
                    <select name="patient_id" class="form-select" required>
                        <option value="">-- Select Patient --</option>
                        @foreach($patients as $patient)
                            <option value="{{ $patient->id }}">{{ $patient->patient_id }} - {{ $patient->name }} ({{ $patient->mobile }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Select Doctor <span class="text-danger">*</span></label>
                    <select name="doctor_id" class="form-select" required>
                        <option value="">-- Select Doctor --</option>
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}">{{ $doctor->name }} ({{ $doctor->specialization }}) - ৳{{ $doctor->consultation_fee }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Date <span class="text-danger">*</span></label>
                    <input type="date" name="date" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Time <span class="text-danger">*</span></label>
                    <input type="time" name="time" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Type</label>
                    <select name="appointment_type" class="form-select">
                        <option value="New">New</option>
                        <option value="Follow-up">Follow-up</option>
                    </select>
                </div>
                
                <hr class="mt-4">
                
                <div class="col-md-3">
                    <label class="form-label">Consultation Fee (৳)</label>
                    <input type="number" name="consultation_fee" id="consultation_fee" class="form-control" step="0.01" value="500" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Discount Type</label>
                    <select name="discount_type" id="discount_type" class="form-select">
                        <option value="fixed">Fixed Amount</option>
                        <option value="percent">Percentage (%)</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Discount Value</label>
                    <input type="number" name="discount_value" id="discount_value" class="form-control" step="0.01" value="0">
                    <input type="hidden" name="discount" id="actual_discount" value="0">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Paid Amount (৳)</label>
                    <input type="number" name="paid" id="paid_amount" class="form-control" step="0.01" value="500" required>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Due Amount (৳)</label>
                    <input type="number" name="due" id="due_amount" class="form-control" step="0.01" value="0">
                </div>
            </div>
            
            <div class="mt-4 text-end">
                <a href="{{ route('appointments.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Confirm Appointment</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const feeInput = document.getElementById('consultation_fee');
        const discountTypeInput = document.getElementById('discount_type');
        const discountValueInput = document.getElementById('discount_value');
        const actualDiscountInput = document.getElementById('actual_discount');
        const paidInput = document.getElementById('paid_amount');
        const dueInput = document.getElementById('due_amount');

        // Update fee based on doctor selection
        const doctorSelect = document.querySelector('select[name="doctor_id"]');
        if(doctorSelect) {
            doctorSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                if(selectedOption.value !== "") {
                    // Extract fee from text, text looks like: Name (Spec) - ৳500
                    const text = selectedOption.text;
                    const feeMatch = text.match(/৳(\d+(\.\d+)?)/);
                    if(feeMatch && feeMatch[1]) {
                        feeInput.value = feeMatch[1];
                        paidInput.value = feeMatch[1]; // default paid to fee
                        calculateDue();
                    }
                }
            });
        }

        function calculateDue(event) {
            const fee = parseFloat(feeInput.value) || 0;
            const discountType = discountTypeInput.value;
            const discountValue = parseFloat(discountValueInput.value) || 0;

            let actualDiscount = 0;
            if (discountType === 'percent') {
                actualDiscount = fee * (discountValue / 100);
            } else {
                actualDiscount = discountValue;
            }
            
            if (actualDiscount > fee) {
                actualDiscount = fee;
            }

            actualDiscountInput.value = actualDiscount.toFixed(2);

            // Auto-update paid amount if the event is triggered by fee or discount fields
            if (event && (event.target === feeInput || event.target === discountTypeInput || event.target === discountValueInput)) {
                paidInput.value = (fee - actualDiscount).toFixed(2);
            }

            const paid = parseFloat(paidInput.value) || 0;
            let due = fee - actualDiscount - paid;
            
            if(due < 0) due = 0;

            dueInput.value = due.toFixed(2);
        }

        feeInput.addEventListener('input', calculateDue);
        discountTypeInput.addEventListener('change', calculateDue);
        paidInput.addEventListener('input', calculateDue);
    });
</script>
@endsection
