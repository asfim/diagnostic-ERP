@extends('layouts.admin')

@section('title', 'Invoice #' . $invoice->invoice_no)

@section('content')
<div class="row mb-3 d-print-none">
    <div class="col-md-6">
        <a href="{{ route('invoices.index') }}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Back</a>
    </div>
    <div class="col-md-6 text-end">
        <button onclick="window.print()" class="btn btn-primary"><i class="fa-solid fa-print"></i> Print Invoice</button>
    </div>
</div>

<div class="card border-0 shadow-sm invoice-container" id="printable-area">
    <div class="card-body p-5">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-sm-6">
                <h3 class="text-primary mb-1"><strong>Diagnostic & Clinic ERP</strong></h3>
                <div>123 Health Avenue, City Center, Dhaka 1200</div>
                <div>Phone: +880 1234 567 890</div>
                <div>Email: info@diagnostic.com</div>
            </div>
            <div class="col-sm-6 text-end">
                <h2 class="text-uppercase text-muted">Invoice</h2>
                <div><strong>Invoice No:</strong> {{ $invoice->invoice_no }}</div>
                <div><strong>Date:</strong> {{ date('d M, Y', strtotime($invoice->date)) }}</div>
                <div>
                    <strong>Status:</strong> 
                    @if($invoice->payment_status == 'Paid')
                        <span class="badge bg-success">Paid</span>
                    @elseif($invoice->payment_status == 'Partial')
                        <span class="badge bg-warning text-dark">Partial</span>
                    @else
                        <span class="badge bg-danger">Unpaid</span>
                    @endif
                </div>
            </div>
        </div>

        <hr>

        <!-- Patient Details -->
        <div class="row mb-4 mt-4">
            <div class="col-sm-6">
                <h5 class="text-muted">Bill To:</h5>
                <h4 class="mb-1">{{ $invoice->patient->name ?? 'Walk-in Patient' }}</h4>
                @if($invoice->patient)
                    <div><strong>Patient ID:</strong> {{ $invoice->patient->patient_id }}</div>
                    <div><strong>Phone:</strong> {{ $invoice->patient->phone }}</div>
                    <div><strong>Age/Gender:</strong> {{ $invoice->patient->age }} / {{ ucfirst($invoice->patient->gender) }}</div>
                @endif
            </div>
        </div>

        <!-- Billing Items -->
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Description</th>
                        <th class="text-end">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Diagnostic / Consultation Charges</td>
                        <td class="text-end">৳ {{ number_format($invoice->subtotal, 2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Totals -->
        <div class="row justify-content-end">
            <div class="col-sm-5">
                <table class="table table-borderless table-sm">
                    <tr>
                        <td class="text-end"><strong>Subtotal:</strong></td>
                        <td class="text-end">৳ {{ number_format($invoice->subtotal, 2) }}</td>
                    </tr>
                    <tr>
                        <td class="text-end"><strong>Discount:</strong></td>
                        <td class="text-end text-danger">- ৳ {{ number_format($invoice->discount, 2) }}</td>
                    </tr>
                    <tr class="border-top">
                        <td class="text-end"><strong>Net Total:</strong></td>
                        <td class="text-end fw-bold">৳ {{ number_format($invoice->total, 2) }}</td>
                    </tr>
                    <tr>
                        <td class="text-end"><strong>Paid Amount:</strong></td>
                        <td class="text-end text-success">৳ {{ number_format($invoice->paid, 2) }}</td>
                    </tr>
                    <tr class="border-top">
                        <td class="text-end"><strong>Due Amount:</strong></td>
                        <td class="text-end text-danger fw-bold fs-5">৳ {{ number_format($invoice->due, 2) }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <hr class="mt-5">
        
        <!-- Footer -->
        <div class="row">
            <div class="col-12 text-center text-muted">
                <small>Thank you for choosing us. Wishing you a quick recovery!</small><br>
                <small><em>This is a computer-generated invoice and requires no signature.</em></small>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    body {
        background-color: #fff;
    }
    .sidebar, .navbar, .d-print-none {
        display: none !important;
    }
    .main-content {
        margin-left: 0 !important;
        padding: 0 !important;
    }
    .card {
        border: none !important;
        box-shadow: none !important;
    }
    .badge {
        border: 1px solid #000;
        color: #000 !important;
        background: none !important;
    }
}
</style>
@endsection
