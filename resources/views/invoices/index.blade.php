@extends('layouts.admin')

@section('title', 'Billing & Invoices')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h4>All Invoices</h4>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('invoices.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Create Invoice</a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Invoice No</th>
                    <th>Date</th>
                    <th>Patient Name</th>
                    <th>Total (৳)</th>
                    <th>Paid (৳)</th>
                    <th>Due (৳)</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->invoice_no }}</td>
                    <td>{{ $invoice->date }}</td>
                    <td>{{ $invoice->patient->name ?? 'N/A' }}</td>
                    <td>{{ number_format($invoice->total, 2) }}</td>
                    <td>{{ number_format($invoice->paid, 2) }}</td>
                    <td class="text-danger fw-bold">{{ number_format($invoice->due, 2) }}</td>
                    <td>
                        @if($invoice->payment_status == 'Paid')
                            <span class="badge bg-success">Paid</span>
                        @elseif($invoice->payment_status == 'Partial')
                            <span class="badge bg-warning text-dark">Partial</span>
                        @else
                            <span class="badge bg-danger">Unpaid</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('invoices.show', $invoice->id) }}" class="btn btn-sm btn-info" title="View"><i class="fa-solid fa-eye"></i></a>
                        <a href="{{ route('invoices.show', $invoice->id) }}" class="btn btn-sm btn-primary" title="Print"><i class="fa-solid fa-print"></i></a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted">No invoices found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $invoices->links() }}
    </div>
</div>
@endsection
