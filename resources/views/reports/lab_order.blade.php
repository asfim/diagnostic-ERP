@extends('layouts.admin')

@section('title', 'Lab Order Report')

@section('content')
<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('reports.labOrder') }}" method="GET" class="row g-3 align-items-end">
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

<div class="row">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0">Lab Orders ({{ date('d M, Y', strtotime($startDate)) }} to {{ date('d M, Y', strtotime($endDate)) }})</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-sm">
                    <thead class="table-dark">
                        <tr>
                            <th>Order No</th>
                            <th>Date</th>
                            <th>Tests Included</th>
                            <th>Total (৳)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr>
                            <td>{{ $order->order_id }}</td>
                            <td>{{ date('d-m-Y', strtotime($order->order_date)) }}</td>
                            <td>
                                @foreach($order->items as $item)
                                    <span class="badge bg-secondary">{{ $item->test->name ?? 'Unknown' }}</span>
                                @endforeach
                            </td>
                            <td>{{ number_format($order->total_amount, 2) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">No lab orders found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0">Most Prescribed Tests</h5>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    @forelse($testCounts as $name => $count)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $name }}
                        <span class="badge bg-primary rounded-pill">{{ $count }} orders</span>
                    </li>
                    @empty
                    <li class="list-group-item text-center text-muted">No tests ordered in this period.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
