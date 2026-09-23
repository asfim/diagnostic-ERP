@extends('layouts.admin')

@section('title', 'Accounts Ledger')

@section('content')

{{-- Page Header --}}
<div class="page-header-premium d-flex justify-content-between align-items-center">
    <div>
        <h4><i class="fa-solid fa-wallet me-2"></i>Accounts Dashboard</h4>
        <p>Monitor daily income, expenses, and net balance</p>
    </div>
    <form action="{{ route('accounts.index') }}" method="GET" class="d-flex align-items-center gap-2 bg-white bg-opacity-10 p-2 rounded-3 border border-white border-opacity-25" style="backdrop-filter: blur(5px);">
        <input type="date" name="date" class="form-control form-control-sm border-0 shadow-none" value="{{ $date }}" style="background: rgba(255,255,255,0.9);">
        <button type="submit" class="btn btn-sm btn-light fw-bold text-primary px-3 shadow-sm">Filter</button>
    </form>
</div>

<div class="row mb-4 g-4">
    <div class="col-md-3">
        <div class="card card-premium h-100 border-0" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white;">
            <div class="card-body p-4 position-relative overflow-hidden">
                <i class="fa-solid fa-money-bill-trend-up position-absolute opacity-25" style="font-size: 5rem; right: -10px; bottom: -10px;"></i>
                <h6 class="opacity-75 mb-2 text-uppercase fw-bold" style="font-size: 0.75rem; letter-spacing: 0.5px;">Today's Income</h6>
                <h3 class="fw-bolder mb-0">৳{{ number_format($totalIncome, 2) }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-premium h-100 border-0" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white;">
            <div class="card-body p-4 position-relative overflow-hidden">
                <i class="fa-solid fa-file-invoice position-absolute opacity-25" style="font-size: 5rem; right: -10px; bottom: -10px;"></i>
                <h6 class="opacity-75 mb-2 text-uppercase fw-bold" style="font-size: 0.75rem; letter-spacing: 0.5px;">Today's Due</h6>
                <h3 class="fw-bolder mb-0">৳{{ number_format($totalDue, 2) }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-premium h-100 border-0" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white;">
            <div class="card-body p-4 position-relative overflow-hidden">
                <i class="fa-solid fa-money-bill-transfer position-absolute opacity-25" style="font-size: 5rem; right: -10px; bottom: -10px;"></i>
                <h6 class="opacity-75 mb-2 text-uppercase fw-bold" style="font-size: 0.75rem; letter-spacing: 0.5px;">Today's Expenses</h6>
                <h3 class="fw-bolder mb-0">৳{{ number_format($expenses, 2) }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-premium h-100 border-0" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white;">
            <div class="card-body p-4 position-relative overflow-hidden">
                <i class="fa-solid fa-scale-balanced position-absolute opacity-25" style="font-size: 5rem; right: -10px; bottom: -10px;"></i>
                <h6 class="opacity-75 mb-2 text-uppercase fw-bold" style="font-size: 0.75rem; letter-spacing: 0.5px;">Net Balance</h6>
                <h3 class="fw-bolder mb-0">৳{{ number_format($totalIncome - $expenses, 2) }}</h3>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card card-premium">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                <h6 class="mb-0 fw-bold text-primary"><i class="fa-solid fa-chart-pie me-2"></i>Income Breakdown</h6>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-3 border-bottom">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 text-primary rounded p-2 me-3">
                                <i class="fa-solid fa-stethoscope"></i>
                            </div>
                            <span class="fw-medium text-dark">OPD/Consultation Billing</span>
                        </div>
                        <span class="fw-bold text-primary fs-5">৳{{ number_format($invoiceIncome, 2) }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-3">
                        <div class="d-flex align-items-center">
                            <div class="bg-success bg-opacity-10 text-success rounded p-2 me-3">
                                <i class="fa-solid fa-microscope"></i>
                            </div>
                            <span class="fw-medium text-dark">Lab Tests Income</span>
                        </div>
                        <span class="fw-bold text-success fs-5">৳{{ number_format($labIncome, 2) }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
