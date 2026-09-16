@extends('layouts.admin')

@section('title', 'Account Report')

@section('content')
<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('reports.account') }}" method="GET" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label">Start Date</label>
                <input type="date" name="start_date" class="form-control" value="{{ $startDate }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">End Date</label>
                <input type="date" name="end_date" class="form-control" value="{{ $endDate }}">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-filter"></i> Generate Report</button>
                <button type="button" class="btn btn-secondary" onclick="window.print()"><i class="fa-solid fa-print"></i> Print</button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header bg-white">
        <h5 class="mb-0">Financial Report ({{ date('d M, Y', strtotime($startDate)) }} to {{ date('d M, Y', strtotime($endDate)) }})</h5>
    </div>
    <div class="card-body">
        <h4 class="text-success mb-4">Total Income: ৳{{ number_format($totalIncome, 2) }}</h4>
        
        <div class="row">
            <div class="col-md-6">
                <h6>Invoice Income (OPD/Consultations)</h6>
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th>Invoice No</th>
                            <th>Date</th>
                            <th>Paid (৳)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoices as $inv)
                        <tr>
                            <td>{{ $inv->invoice_no }}</td>
                            <td>{{ date('d-m-Y', strtotime($inv->created_at)) }}</td>
                            <td>{{ number_format($inv->paid, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <h6>Lab Orders Income</h6>
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th>Order No</th>
                            <th>Date</th>
                            <th>Paid (৳)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($labOrders as $ord)
                        <tr>
                            <td>{{ $ord->order_id }}</td>
                            <td>{{ date('d-m-Y', strtotime($ord->created_at)) }}</td>
                            <td>{{ number_format($ord->paid_amount, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
