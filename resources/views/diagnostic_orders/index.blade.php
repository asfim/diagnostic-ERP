@extends('layouts.admin')

@section('title', 'Lab Orders')

@section('content')

<style>
    .orders-header {
        background: linear-gradient(135deg, #1e3a5f 0%, #2563eb 100%);
        border-radius: 16px;
        padding: 28px 32px;
        margin-bottom: 28px;
        color: white;
        position: relative;
        overflow: hidden;
    }
    .orders-header::before {
        content: '';
        position: absolute;
        top: -40px; right: -40px;
        width: 180px; height: 180px;
        border-radius: 50%;
        background: rgba(255,255,255,0.07);
    }
    .orders-header::after {
        content: '';
        position: absolute;
        bottom: -60px; left: 30%;
        width: 280px; height: 180px;
        border-radius: 50%;
        background: rgba(255,255,255,0.05);
    }
    .orders-header h4 { font-weight: 700; font-size: 1.5rem; margin-bottom: 4px; }
    .orders-header p { opacity: 0.75; margin: 0; font-size: 0.9rem; }

    .btn-new-order {
        background: rgba(255,255,255,0.15);
        border: 1.5px solid rgba(255,255,255,0.35);
        color: #fff;
        backdrop-filter: blur(6px);
        border-radius: 10px;
        padding: 10px 22px;
        font-weight: 600;
        transition: all 0.2s ease;
        position: relative;
        z-index: 1;
    }
    .btn-new-order:hover {
        background: #fff;
        color: #2563eb;
        border-color: #fff;
    }

    .orders-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 24px rgba(0,0,0,0.07);
        overflow: hidden;
    }

    .orders-table thead th {
        background: #f8fafd;
        color: #64748b;
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.7px;
        border-bottom: 2px solid #e9eef6;
        padding: 14px 16px;
        white-space: nowrap;
    }
    .orders-table tbody tr {
        transition: background 0.15s ease;
        border-bottom: 1px solid #f1f5f9;
    }
    .orders-table tbody tr:last-child { border-bottom: none; }
    .orders-table tbody tr:hover { background: #f8fafd; }
    .orders-table tbody td {
        padding: 13px 16px;
        vertical-align: middle;
        font-size: 0.875rem;
        color: #334155;
    }

    .order-id-badge {
        font-family: 'Courier New', monospace;
        font-weight: 700;
        background: #eef2ff;
        color: #4f46e5;
        border-radius: 6px;
        padding: 3px 10px;
        font-size: 0.78rem;
        letter-spacing: 0.3px;
    }
    .patient-name {
        font-weight: 600;
        color: #1e293b;
    }
    .patient-date {
        font-size: 0.78rem;
        color: #94a3b8;
    }
    .amount-paid { color: #16a34a; font-weight: 700; }
    .amount-due  { color: #dc2626; font-weight: 700; }
    .amount-zero { color: #94a3b8; font-weight: 600; }

    .status-pill {
        border-radius: 20px;
        padding: 4px 12px;
        font-size: 0.74rem;
        font-weight: 700;
        letter-spacing: 0.3px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    .pill-paid      { background: #dcfce7; color: #15803d; }
    .pill-partial   { background: #fef9c3; color: #92400e; }
    .pill-unpaid    { background: #fee2e2; color: #b91c1c; }
    .pill-completed { background: #dbeafe; color: #1d4ed8; }
    .pill-pending   { background: #f1f5f9; color: #475569; }
    .pill-cancelled { background: #fee2e2; color: #b91c1c; }

    .action-btn {
        width: 32px; height: 32px;
        border-radius: 8px;
        border: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.8rem;
        transition: all 0.18s ease;
        cursor: pointer;
    }
    .action-btn:hover { transform: translateY(-1px); }
    .action-btn-view  { background: #eff6ff; color: #2563eb; }
    .action-btn-view:hover  { background: #2563eb; color: #fff; }
    .action-btn-edit  { background: #fffbeb; color: #d97706; }
    .action-btn-edit:hover  { background: #f59e0b; color: #fff; }
    .action-btn-del   { background: #fff1f2; color: #e11d48; }
    .action-btn-del:hover   { background: #e11d48; color: #fff; }

    .empty-state {
        padding: 60px 20px;
        text-align: center;
        color: #94a3b8;
    }
    .empty-state i { font-size: 3rem; margin-bottom: 16px; opacity: 0.4; display: block; }
</style>

{{-- Page Header --}}
<div class="orders-header d-flex justify-content-between align-items-center">
    <div>
        <h4><i class="fa-solid fa-flask-vial me-2"></i>Lab Orders</h4>
        <p>Manage all diagnostic lab orders and track payment status</p>
    </div>
    <a href="{{ route('diagnostic-orders.create') }}" class="btn btn-new-order">
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
<div class="orders-card card">
    <div class="table-responsive">
        <table class="table orders-table mb-0">
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
                    <td><span class="order-id-badge">{{ $order->order_id }}</span></td>
                    <td>
                        <span class="patient-name">{{ $order->patient->name ?? 'N/A' }}</span>
                    </td>
                    <td>
                        <span class="patient-date">{{ date('d M Y', strtotime($order->order_date)) }}</span>
                    </td>
                    <td>
                        @if($order->paid_amount > 0)
                            <span class="amount-paid">৳ {{ number_format($order->paid_amount, 2) }}</span>
                        @else
                            <span class="amount-zero">৳ 0.00</span>
                        @endif
                    </td>
                    <td>
                        @if($order->due_amount > 0)
                            <span class="amount-due">৳ {{ number_format($order->due_amount, 2) }}</span>
                        @else
                            <span class="amount-zero">৳ 0.00</span>
                        @endif
                    </td>
                    <td>
                        @if($order->payment_status == 'Paid')
                            <span class="status-pill pill-paid"><i class="fa-solid fa-check-circle"></i> Paid</span>
                        @elseif($order->payment_status == 'Partial')
                            <span class="status-pill pill-partial"><i class="fa-solid fa-circle-half-stroke"></i> Partial</span>
                        @else
                            <span class="status-pill pill-unpaid"><i class="fa-solid fa-xmark-circle"></i> Unpaid</span>
                        @endif
                    </td>
                    <td>
                        @if($order->order_status == 'Completed')
                            <span class="status-pill pill-completed"><i class="fa-solid fa-flask-vial"></i> Completed</span>
                        @elseif($order->order_status == 'Cancelled')
                            <span class="status-pill pill-cancelled"><i class="fa-solid fa-ban"></i> Cancelled</span>
                        @else
                            <span class="status-pill pill-pending"><i class="fa-solid fa-clock"></i> {{ $order->order_status }}</span>
                        @endif
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

@endsection
