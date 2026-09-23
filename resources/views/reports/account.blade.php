@extends('layouts.admin')

@section('title', 'Account Report')

@section('content')

{{-- Page Header --}}
<div class="page-header-premium d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4><i class="fa-solid fa-file-invoice-dollar me-2"></i>Account Report</h4>
        <p>View consolidated financial income from OPD invoices and Lab orders</p>
    </div>
</div>

<div class="card-premium card mb-4 d-print-none">
    <div class="card-body">
        <form action="{{ route('reports.account') }}" method="GET" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label text-muted small fw-bold text-uppercase">Start Date</label>
                <input type="date" name="start_date" class="form-control" value="{{ $startDate }}">
            </div>
            <div class="col-md-4">
                <label class="form-label text-muted small fw-bold text-uppercase">End Date</label>
                <input type="date" name="end_date" class="form-control" value="{{ $endDate }}">
            </div>
            <div class="col-md-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-filter me-2"></i>Generate</button>
                <button type="button" class="btn btn-secondary" onclick="window.print()"><i class="fa-solid fa-print me-2"></i>Print</button>
            </div>
        </form>
    </div>
</div>

<div class="card-premium card">
    <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
        <h6 class="mb-0 fw-bold text-primary"><i class="fa-solid fa-calendar-days me-2"></i>Financial Report ({{ date('d M, Y', strtotime($startDate)) }} to {{ date('d M, Y', strtotime($endDate)) }})</h6>
    </div>
    <div class="card-body">
        <div class="d-flex align-items-center mb-4 bg-light p-3 rounded-3 border">
            <div class="me-3">
                <div class="rounded-circle bg-success bg-opacity-10 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                    <i class="fa-solid fa-money-bill-wave text-success fs-4"></i>
                </div>
            </div>
            <div>
                <span class="text-muted small fw-bold text-uppercase">Total Income</span>
                <h4 class="text-success mb-0 fw-bold">৳ {{ number_format($totalIncome, 2) }}</h4>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-6">
                <h6 class="fw-bold mb-3"><i class="fa-solid fa-file-invoice me-2 text-muted"></i>Invoice Income (OPD)</h6>
                <div class="table-responsive">
                    <table class="table table-premium mb-0">
                        <thead>
                            <tr>
                                <th>Invoice No</th>
                                <th>Date</th>
                                <th>Paid (৳)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($invoices as $inv)
                            <tr>
                                <td><span class="id-badge">{{ $inv->invoice_no }}</span></td>
                                <td><span class="text-muted">{{ date('d M Y', strtotime($inv->created_at)) }}</span></td>
                                <td><strong class="text-success">৳ {{ number_format($inv->paid, 2) }}</strong></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-3">No invoices found for this period.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <h6 class="fw-bold mb-3"><i class="fa-solid fa-vial me-2 text-muted"></i>Lab Orders Income</h6>
                <div class="table-responsive">
                    <table class="table table-premium mb-0">
                        <thead>
                            <tr>
                                <th>Order No</th>
                                <th>Date</th>
                                <th>Paid (৳)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($labOrders as $ord)
                            <tr>
                                <td><span class="id-badge">{{ $ord->order_id }}</span></td>
                                <td><span class="text-muted">{{ date('d M Y', strtotime($ord->created_at)) }}</span></td>
                                <td><strong class="text-success">৳ {{ number_format($ord->paid_amount, 2) }}</strong></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-3">No lab orders found for this period.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
