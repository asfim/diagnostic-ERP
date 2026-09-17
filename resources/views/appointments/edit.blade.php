@extends('layouts.admin')

@section('title', 'Edit Appointment')

@section('content')
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Edit Appointment</h5>
        <span class="badge bg-secondary">{{ $appointment->appointment_id }}</span>
    </div>
    <div class="card-body">
        <form action="{{ route('appointments.update', $appointment->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Patient</label>
                    <input type="text" class="form-control bg-light" value="{{ $appointment->patient->name ?? 'N/A' }}" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Doctor</label>
                    <input type="text" class="form-control bg-light" value="{{ $appointment->doctor->name ?? 'N/A' }}" readonly>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Date <span class="text-danger">*</span></label>
                    <input type="date" name="date" class="form-control" required value="{{ $appointment->date }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Time <span class="text-danger">*</span></label>
                    <input type="time" name="time" class="form-control" required value="{{ $appointment->time }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-select" required>
                        <option value="Pending" {{ $appointment->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Confirmed" {{ $appointment->status == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="Completed" {{ $appointment->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                        <option value="Cancelled" {{ $appointment->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
            </div>
            
            <hr class="mt-4">
            
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Consultation Fee (৳)</label>
                    <input type="number" name="consultation_fee" id="consultation_fee" class="form-control" step="0.01" value="{{ $appointment->consultation_fee ?? 0 }}" required>
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
                    <!-- Displaying the current discount as fixed by default for edit -->
                    <input type="number" name="discount_value" id="discount_value" class="form-control" step="0.01" value="{{ $appointment->discount ?? 0 }}">
                    <!-- Hidden field to submit the actual calculated discount amount to the server -->
                    <input type="hidden" name="discount" id="actual_discount" value="{{ $appointment->discount ?? 0 }}">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Paid Amount (৳)</label>
                    <input type="number" name="paid" id="paid_amount" class="form-control" step="0.01" value="{{ $appointment->paid ?? 0 }}" required>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Due Amount (৳)</label>
                    <input type="number" name="due" id="due_amount" class="form-control" step="0.01" value="{{ $appointment->due ?? 0 }}">
                </div>
            </div>
            
            <div class="mt-4 text-end">
                <a href="{{ route('appointments.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Appointment</button>
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
            
            // Ensure discount is not more than fee
            if (actualDiscount > fee) {
                actualDiscount = fee;
            }

            actualDiscountInput.value = actualDiscount.toFixed(2);

            // If the change came from fee, discount type, or discount value, auto-update paid amount
            if (event && (event.target === feeInput || event.target === discountTypeInput || event.target === discountValueInput)) {
                paidInput.value = (fee - actualDiscount).toFixed(2);
            }

            const paid = parseFloat(paidInput.value) || 0;
            let due = fee - actualDiscount - paid;
            
            // Due can't be negative in this simple scenario
            if(due < 0) due = 0;

            dueInput.value = due.toFixed(2);
        }

        feeInput.addEventListener('input', calculateDue);
        discountTypeInput.addEventListener('change', calculateDue);
        discountValueInput.addEventListener('input', calculateDue);
        paidInput.addEventListener('input', calculateDue);
    });
</script>
@endsection
