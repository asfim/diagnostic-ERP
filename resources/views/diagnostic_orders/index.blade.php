@extends('layouts.admin')

@section('title', 'Lab Orders')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h4>All Lab Orders</h4>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('diagnostic-orders.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> New Lab Order</a>
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
                    <th>Order ID</th>
                    <th>Date</th>
                    <th>Patient Name</th>
                    <th>Total (৳)</th>
                    <th>Due (৳)</th>
                    <th>Payment</th>
                    <th>Order Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td>{{ $order->order_id }}</td>
                    <td>{{ $order->order_date }}</td>
                    <td>{{ $order->patient->name ?? 'N/A' }}</td>
                    <td>{{ number_format($order->total_amount, 2) }}</td>
                    <td class="text-danger fw-bold">{{ number_format($order->due_amount, 2) }}</td>
                    <td>
                        @if($order->payment_status == 'Paid')
                            <span class="badge bg-success">Paid</span>
                        @elseif($order->payment_status == 'Partial')
                            <span class="badge bg-warning text-dark">Partial</span>
                        @else
                            <span class="badge bg-danger">Unpaid</span>
                        @endif
                    </td>
                    <td>
                        @if($order->order_status == 'Completed')
                            <span class="badge bg-success">Completed</span>
                        @else
                            <span class="badge bg-secondary">{{ $order->order_status }}</span>
                        @endif
                    </td>
                    <td class="d-flex gap-1">
                        <a href="{{ route('diagnostic-orders.edit', $order->id) }}" class="btn btn-sm btn-warning" title="Edit"><i class="fa-solid fa-pen"></i></a>
                        <form action="{{ route('diagnostic-orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this order?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" title="Delete"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted">No lab orders found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $orders->links() }}
    </div>
</div>
@endsection
