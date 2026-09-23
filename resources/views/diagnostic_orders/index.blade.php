@extends('layouts.admin')

@section('title', 'Lab Orders')

@section('content')

{{-- Page Header --}}
<div class="page-header-premium d-flex justify-content-between align-items-center">
    <div>
        <h4><i class="fa-solid fa-flask-vial me-2"></i>Lab Orders</h4>
        <p>Manage all diagnostic lab orders and track payment status</p>
    </div>
    <a href="{{ route('diagnostic-orders.create') }}" class="btn btn-premium-new">
        <i class="fa-solid fa-plus me-2"></i>New Order
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
        <i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

{{-- Orders Table --}}
<div class="card-premium card">
    <div class="table-responsive">
        <table class="table table-premium mb-0">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Patient</th>
                    <th>Date</th>
                    <th>Paid (৳)</th>
                    <th>Due (৳)</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td><span class="id-badge">{{ $order->order_id }}</span></td>
                    <td>
                        <span class="fw-semibold text-dark">{{ $order->patient->name ?? 'N/A' }}</span>
                    </td>
                    <td>
                        <span class="text-muted small">{{ date('d M Y', strtotime($order->order_date)) }}</span>
                    </td>
                    <td>
                        @if($order->paid_amount > 0)
                            <span class="fw-bold text-success">৳ {{ number_format($order->paid_amount, 2) }}</span>
                        @else
                            <span class="fw-semibold text-muted">৳ 0.00</span>
                        @endif
                    </td>
                    <td>
                        @if($order->due_amount > 0)
                            <span class="fw-bold text-danger">৳ {{ number_format($order->due_amount, 2) }}</span>
                        @else
                            <span class="fw-semibold text-muted">৳ 0.00</span>
                        @endif
                    </td>
                    <td>
                        @if($order->payment_status == 'Paid')
                            <span class="status-pill pill-success"><i class="fa-solid fa-check-circle"></i> Paid</span>
                        @elseif($order->payment_status == 'Partial')
                            <span class="status-pill pill-warning"><i class="fa-solid fa-circle-half-stroke"></i> Partial</span>
                        @else
                            <span class="status-pill pill-danger"><i class="fa-solid fa-xmark-circle"></i> Unpaid</span>
                        @endif
                    </td>
                    <td>
                        <select class="form-select form-select-sm status-dropdown shadow-sm {{ $order->order_status == 'Pending' ? 'bg-warning text-dark' : ($order->order_status == 'Completed' ? 'bg-success text-white' : ($order->order_status == 'Delivered' ? 'bg-info text-white' : 'bg-secondary text-white')) }}" data-id="{{ $order->id }}">
                            <option value="Pending" {{ $order->order_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Completed" {{ $order->order_status == 'Completed' ? 'selected' : '' }}>Completed</option>
                            <option value="Delivered" {{ $order->order_status == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                            <option value="Cancelled" {{ $order->order_status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('diagnostic-orders.show', $order->id) }}" class="action-btn action-btn-view" title="View Invoice">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="{{ route('diagnostic-orders.edit', $order->id) }}" class="action-btn action-btn-edit" title="Edit Order">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <form action="{{ route('diagnostic-orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Delete this order?');" class="d-inline">
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
                            <i class="fa-solid fa-folder-open"></i>
                            <strong>No lab orders found</strong>
                            <p class="mt-2 mb-0 small">Create a new lab order to get started.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($orders->hasPages())
        <div class="px-4 py-3 border-top">
            {{ $orders->links() }}
        </div>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const dropdowns = document.querySelectorAll('.status-dropdown');
    dropdowns.forEach(dropdown => {
        dropdown.addEventListener('change', function() {
            const orderId = this.dataset.id;
            const newStatus = this.value;
            const selectElement = this;

            fetch(`/diagnostic-orders/${orderId}/status`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ order_status: newStatus })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    selectElement.className = 'form-select form-select-sm status-dropdown shadow-sm';
                    if (newStatus === 'Pending') selectElement.classList.add('bg-warning', 'text-dark');
                    else if (newStatus === 'Completed') selectElement.classList.add('bg-success', 'text-white');
                    else if (newStatus === 'Delivered') selectElement.classList.add('bg-info', 'text-white');
                    else selectElement.classList.add('bg-secondary', 'text-white');
                } else {
                    alert('Failed to update status.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while updating status.');
            });
        });
    });
});
</script>

@endsection
