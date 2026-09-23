@extends('layouts.admin')

@section('title', 'Billing & Invoices')

@section('content')

{{-- Page Header --}}
<div class="page-header-premium d-flex justify-content-between align-items-center">
    <div>
        <h4><i class="fa-solid fa-file-invoice-dollar me-2"></i>Invoices</h4>
        <p>Manage patient billing, payments, and dues</p>
    </div>
    <a href="{{ route('invoices.create') }}" class="btn btn-premium-new">
        <i class="fa-solid fa-plus me-2"></i>Create Invoice
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
        <i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card-premium card">
    <div class="table-responsive">
        <table class="table table-premium mb-0">
            <thead>
                <tr>
                    <th>Invoice No</th>
                    <th>Date</th>
                    <th>Patient Name</th>
                    <th>Total (৳)</th>
                    <th>Paid (৳)</th>
                    <th>Due (৳)</th>
                    <th>Status</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($invoices as $invoice)
                <tr>
                    <td><span class="id-badge">{{ $invoice->invoice_no }}</span></td>
                    <td><span class="text-muted">{{ date('d M Y', strtotime($invoice->date)) }}</span></td>
                    <td><span class="fw-semibold text-dark">{{ $invoice->patient->name ?? 'N/A' }}</span></td>
                    <td class="fw-medium">৳ {{ number_format($invoice->total, 2) }}</td>
                    <td class="fw-bold text-success">৳ {{ number_format($invoice->paid, 2) }}</td>
                    <td>
                        @if($invoice->due > 0)
                            <span class="fw-bold text-danger">৳ {{ number_format($invoice->due, 2) }}</span>
                        @else
                            <span class="fw-semibold text-muted">৳ 0.00</span>
                        @endif
                    </td>
                    <td>
                        @if($invoice->payment_status == 'Paid')
                            <span class="status-pill pill-success"><i class="fa-solid fa-check-circle"></i> Paid</span>
                        @elseif($invoice->payment_status == 'Partial')
                            <span class="status-pill pill-warning"><i class="fa-solid fa-circle-half-stroke"></i> Partial</span>
                        @else
                            <span class="status-pill pill-danger"><i class="fa-solid fa-xmark-circle"></i> Unpaid</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('invoices.show', $invoice->id) }}" class="action-btn action-btn-view" title="View/Print">
                                <i class="fa-solid fa-print"></i>
                            </a>
                            <a href="{{ route('invoices.edit', $invoice->id) }}" class="action-btn action-btn-edit" title="Edit Invoice">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this invoice?');" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn action-btn-del" title="Delete">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8">
                        <div class="empty-state">
                            <i class="fa-solid fa-file-invoice"></i>
                            <strong>No invoices found</strong>
                            <p class="mt-2 mb-0 small">Create a new invoice for patient billing.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($invoices->hasPages())
        <div class="px-4 py-3 border-top">
            {{ $invoices->links() }}
        </div>
    @endif
</div>
@endsection
