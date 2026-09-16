@extends('layouts.admin')

@section('title', 'Accounts Ledger')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h4>Accounts Dashboard</h4>
    </div>
    <div class="col-md-6 text-end">
        <form action="{{ route('accounts.index') }}" method="GET" class="d-flex justify-content-end">
            <input type="date" name="date" class="form-control w-auto me-2" value="{{ $date }}">
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h6>Today's Total Income</h6>
                <h3>৳{{ number_format($totalIncome, 2) }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning text-dark">
            <div class="card-body">
                <h6>Today's Total Due</h6>
                <h3>৳{{ number_format($totalDue, 2) }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-danger text-white">
            <div class="card-body">
                <h6>Today's Expenses</h6>
                <h3>৳{{ number_format($expenses, 2) }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h6>Net Balance</h6>
                <h3>৳{{ number_format($totalIncome - $expenses, 2) }}</h3>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-white">
                <h6 class="mb-0">Income Breakdown</h6>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        OPD/Consultation Billing
                        <span class="badge bg-primary rounded-pill">৳{{ number_format($invoiceIncome, 2) }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Lab Tests Income
                        <span class="badge bg-primary rounded-pill">৳{{ number_format($labIncome, 2) }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
