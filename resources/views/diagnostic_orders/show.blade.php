@extends('layouts.admin')

@section('title', 'Invoice — ' . $order->order_id)

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

    .invoice-wrapper { font-family: 'Inter', sans-serif; }

    /* Top action bar */
    .invoice-topbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
    }
    .invoice-topbar h5 {
        font-weight: 700;
        color: #1e293b;
        font-size: 1.1rem;
        margin: 0;
    }
    .invoice-topbar .breadcrumb-txt {
        font-size: 0.8rem;
        color: #94a3b8;
        margin-top: 2px;
    }
    .btn-back {
        background: #f1f5f9;
        border: none;
        color: #475569;
        border-radius: 10px;
        padding: 9px 18px;
        font-size: 0.85rem;
        font-weight: 600;
        transition: all 0.2s;
        text-decoration: none;
    }
    .btn-back:hover { background: #e2e8f0; color: #1e293b; }
    .btn-print {
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        border: none;
        color: #fff;
        border-radius: 10px;
        padding: 9px 22px;
        font-size: 0.85rem;
        font-weight: 600;
        box-shadow: 0 4px 12px rgba(37,99,235,0.25);
        transition: all 0.2s;
        cursor: pointer;
    }
    .btn-print:hover { transform: translateY(-1px); box-shadow: 0 6px 16px rgba(37,99,235,0.35); }

    /* Main invoice card */
    .invoice-card {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 8px 40px rgba(0,0,0,0.09);
        overflow: hidden;
        border: none;
    }

    /* Header gradient */
    .invoice-header {
        background: linear-gradient(135deg, #0f172a 0%, #1e40af 60%, #2563eb 100%);
        padding: 36px 40px;
        position: relative;
        overflow: hidden;
    }
    .invoice-header::before {
        content: '';
        position: absolute;
        top: -60px; right: -60px;
        width: 220px; height: 220px;
        border-radius: 50%;
        background: rgba(255,255,255,0.05);
    }
    .invoice-header::after {
        content: '';
        position: absolute;
        bottom: -80px; left: 25%;
        width: 300px; height: 200px;
        border-radius: 50%;
        background: rgba(255,255,255,0.04);
    }
    .hospital-logo-wrap {
        width: 68px; height: 68px;
        background: rgba(255,255,255,0.15);
        border: 2px solid rgba(255,255,255,0.25);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        color: #fff;
        backdrop-filter: blur(8px);
        flex-shrink: 0;
        overflow: hidden;
    }
    .hospital-logo-wrap img { width: 100%; height: 100%; object-fit: contain; border-radius: 14px; }
    .hospital-name { font-size: 1.35rem; font-weight: 800; color: #fff; margin-bottom: 4px; }
    .hospital-info { font-size: 0.8rem; color: rgba(255,255,255,0.6); margin: 0; line-height: 1.6; }
    .invoice-title-area { text-align: right; position: relative; z-index: 1; }
    .invoice-title-area .big-label {
        font-size: 2rem;
        font-weight: 900;
        color: rgba(255,255,255,0.18);
        letter-spacing: 6px;
        text-transform: uppercase;
        display: block;
        line-height: 1;
    }
    .invoice-title-area .order-num {
        font-family: 'Courier New', monospace;
        font-size: 0.9rem;
        font-weight: 700;
        color: rgba(255,255,255,0.75);
        background: rgba(255,255,255,0.1);
        border-radius: 8px;
        padding: 4px 12px;
        display: inline-block;
        margin-top: 6px;
    }
    .invoice-title-area .order-date {
        font-size: 0.75rem;
        color: rgba(255,255,255,0.5);
        margin-top: 4px;
        display: block;
    }

    /* Status strip */
    .status-strip {
        background: #f8fafd;
        border-bottom: 1px solid #e9eef6;
        padding: 14px 40px;
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }
    .strip-pill {
        border-radius: 20px;
        padding: 4px 14px;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.3px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    .strip-pill-success { background: #dcfce7; color: #15803d; }
    .strip-pill-warning { background: #fef9c3; color: #854d0e; }
    .strip-pill-danger  { background: #fee2e2; color: #b91c1c; }
    .strip-pill-blue    { background: #dbeafe; color: #1d4ed8; }
    .strip-pill-gray    { background: #f1f5f9; color: #475569; }

    /* Invoice body */
    .invoice-body { padding: 40px; }

    /* Patient & order info */
    .info-label {
        font-size: 0.68rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #94a3b8;
        margin-bottom: 10px;
    }
    .patient-name-big { font-size: 1.15rem; font-weight: 800; color: #0f172a; margin-bottom: 6px; }
    .patient-detail { font-size: 0.83rem; color: #64748b; margin-bottom: 3px; }
    .patient-detail i { width: 16px; color: #94a3b8; }

    .order-meta-table { font-size: 0.84rem; }
    .order-meta-table td { padding: 4px 0; color: #64748b; }
    .order-meta-table td:last-child { color: #1e293b; font-weight: 600; padding-left: 16px; text-align: right; }

    /* Divider */
    .invoice-divider { height: 1px; background: #e9eef6; margin: 32px 0; }

    /* Test table */
    .test-table { border-radius: 12px; overflow: hidden; border: 1px solid #e9eef6; }
    .test-table thead th {
        background: #f8fafd;
        font-size: 0.71rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.7px;
        color: #64748b;
        border: none;
        border-bottom: 1px solid #e9eef6;
        padding: 13px 18px;
    }
    .test-table tbody td {
        padding: 14px 18px;
        vertical-align: middle;
        border: none;
        border-bottom: 1px solid #f1f5f9;
        font-size: 0.875rem;
        color: #334155;
    }
    .test-table tbody tr:last-child td { border-bottom: none; }
    .test-table tbody tr:hover td { background: #f8fafd; }
    .test-code-badge {
        display: inline-block;
        background: #f1f5f9;
        color: #475569;
        border-radius: 6px;
        padding: 2px 8px;
        font-size: 0.72rem;
        font-weight: 600;
        font-family: 'Courier New', monospace;
    }

    /* Financial summary box */
    .summary-box {
        background: linear-gradient(135deg, #f8fafd 0%, #eef2ff 100%);
        border: 1px solid #e0e7ff;
        border-radius: 16px;
        padding: 24px 28px;
    }
    .summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 7px 0;
        font-size: 0.875rem;
        color: #64748b;
        border-bottom: 1px solid rgba(0,0,0,0.04);
    }
    .summary-row:last-child { border-bottom: none; }
    .summary-row .label { font-weight: 500; }
    .summary-row .value { font-weight: 700; color: #1e293b; }
    .summary-row.discount .value { color: #dc2626; }
    .summary-row.net-payable { padding: 10px 0; border-top: 1px solid #c7d2fe; border-bottom: 1px solid #c7d2fe; }
    .summary-row.net-payable .label { font-weight: 700; color: #1e293b; font-size: 0.95rem; }
    .summary-row.net-payable .value { font-size: 1rem; }
    .summary-row.paid .value { color: #16a34a; }
    .summary-total {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #fff;
        border: 1.5px solid #e0e7ff;
        border-radius: 12px;
        padding: 14px 20px;
        margin-top: 16px;
    }
    .summary-total .label { font-size: 0.9rem; font-weight: 700; color: #475569; }
    .summary-total .value { font-size: 1.4rem; font-weight: 900; color: #dc2626; }
    .summary-total.paid-full .value { color: #16a34a; }

    /* Footer note */
    .invoice-footer-note {
        text-align: center;
        padding: 24px 40px;
        background: #f8fafd;
        border-top: 1px solid #e9eef6;
        font-size: 0.8rem;
        color: #94a3b8;
    }

    /* Print styles */
    @media print {
        body { background: #fff !important; }
        body * { visibility: hidden; }
        .invoice-wrapper, .invoice-wrapper * { visibility: visible; }
        .invoice-topbar { display: none !important; }
        .invoice-wrapper {
            position: absolute;
            top: 0; left: 0; width: 100%;
        }
        .invoice-header {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .summary-box {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
    }
</style>

<div class="invoice-wrapper">
    {{-- Top bar --}}
    <div class="invoice-topbar d-print-none">
        <div>
            <h5><i class="fa-solid fa-file-invoice me-2 text-primary"></i>Invoice Details</h5>
            <div class="breadcrumb-txt">Lab Orders / {{ $order->order_id }}</div>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('diagnostic-orders.index') }}" class="btn-back"><i class="fa-solid fa-arrow-left me-1"></i> Back</a>
            <a href="{{ route('diagnostic-orders.edit', $order->id) }}" class="btn-back"><i class="fa-solid fa-pen me-1"></i> Edit</a>
            <button class="btn-print" onclick="window.print()"><i class="fa-solid fa-print me-2"></i>Print Invoice</button>
        </div>
    </div>

    {{-- Invoice Card --}}
    <div class="invoice-card">

        {{-- Gradient Header --}}
        <div class="invoice-header">
            <div class="d-flex justify-content-between align-items-start" style="position:relative;z-index:1;">
                <div class="d-flex align-items-center gap-3">
                    <div class="hospital-logo-wrap">
                        @if(isset($settings['hospital_logo']))
                            <img src="{{ asset('storage/' . $settings['hospital_logo']) }}" alt="Logo">
                        @else
                            <i class="fa-solid fa-hospital"></i>
                        @endif
                    </div>
                    <div>
                        <div class="hospital-name">{{ $settings['hospital_name'] ?? 'Diagnostic Center' }}</div>
                        <p class="hospital-info">
                            <i class="fa-solid fa-location-dot"></i> {{ $settings['hospital_address'] ?? '123 Medical Street' }}<br>
                            <i class="fa-solid fa-phone"></i> {{ $settings['hospital_phone'] ?? '+880 000 000 0000' }}
                        </p>
                    </div>
                </div>
                <div class="invoice-title-area">
                    <span class="big-label">Invoice</span>
                    <div class="order-num">{{ $order->order_id }}</div>
                    <span class="order-date">{{ date('d F Y', strtotime($order->order_date)) }}</span>
                </div>
            </div>
        </div>

        {{-- Status Strip --}}
        <div class="status-strip">
            <span class="text-muted small me-1">Status:</span>
            {{-- Order Status --}}
            @if($order->order_status == 'Completed')
                <span class="strip-pill strip-pill-blue"><i class="fa-solid fa-flask-vial"></i> Completed</span>
            @elseif($order->order_status == 'Cancelled')
                <span class="strip-pill strip-pill-danger"><i class="fa-solid fa-ban"></i> Cancelled</span>
            @else
                <span class="strip-pill strip-pill-gray"><i class="fa-solid fa-clock"></i> {{ $order->order_status }}</span>
            @endif
            {{-- Payment Status --}}
            @if($order->payment_status == 'Paid')
                <span class="strip-pill strip-pill-success"><i class="fa-solid fa-circle-check"></i> Fully Paid</span>
            @elseif($order->payment_status == 'Partial')
                <span class="strip-pill strip-pill-warning"><i class="fa-solid fa-circle-half-stroke"></i> Partial Payment</span>
            @else
                <span class="strip-pill strip-pill-danger"><i class="fa-solid fa-circle-xmark"></i> Unpaid</span>
            @endif
        </div>

        {{-- Invoice Body --}}
        <div class="invoice-body">
            {{-- Patient & Order Info --}}
            <div class="row">
                <div class="col-md-6 mb-4 mb-md-0">
                    <div class="info-label">Billed To</div>
                    <div class="patient-name-big">{{ $order->patient->name ?? 'N/A' }}</div>
                    <div class="patient-detail"><i class="fa-solid fa-id-card"></i> Patient ID: <strong>{{ $order->patient->patient_id ?? 'N/A' }}</strong></div>
                    <div class="patient-detail"><i class="fa-solid fa-user"></i> {{ $order->patient->age ?? 'N/A' }} yrs / {{ $order->patient->gender ?? 'N/A' }}</div>
                    <div class="patient-detail"><i class="fa-solid fa-phone"></i> {{ $order->patient->phone ?? 'N/A' }}</div>
                </div>
                <div class="col-md-6">
                    <div class="info-label">Invoice Information</div>
                    <table class="order-meta-table w-100">
                        <tr>
                            <td><i class="fa-regular fa-calendar me-1"></i> Invoice Date</td>
                            <td>{{ date('d M Y', strtotime($order->order_date)) }}</td>
                        </tr>
                        <tr>
                            <td><i class="fa-solid fa-hashtag me-1"></i> Reference</td>
                            <td>{{ $order->order_id }}</td>
                        </tr>
                        <tr>
                            <td><i class="fa-solid fa-user-doctor me-1"></i> Doctor</td>
                            <td>{{ $order->doctor ?? 'Self Referred' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="invoice-divider"></div>

            {{-- Tests --}}
            <div class="info-label mb-3">Tests Ordered</div>
            <div class="test-table">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Test Name</th>
                            <th>Code</th>
                            <th class="text-end">Price (৳)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($order->items as $i => $item)
                        <tr>
                            <td class="text-muted fw-bold" style="width:40px;">{{ $i + 1 }}</td>
                            <td class="fw-semibold">{{ $item->test->name ?? 'N/A' }}</td>
                            <td><span class="test-code-badge">{{ $item->test->test_code ?? 'N/A' }}</span></td>
                            <td class="text-end fw-bold text-dark">{{ number_format($item->price, 2) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">
                                <i class="fa-solid fa-clipboard-list fs-2 d-block mb-2 opacity-30"></i>
                                No tests recorded.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="invoice-divider"></div>

            {{-- Summary --}}
            <div class="row justify-content-end">
                <div class="col-md-6 col-lg-5">
                    <div class="summary-box">
                        <div class="info-label mb-3">Payment Summary</div>
                        <div class="summary-row">
                            <span class="label">Subtotal</span>
                            <span class="value">৳ {{ number_format($order->total_amount, 2) }}</span>
                        </div>
                        <div class="summary-row discount">
                            <span class="label"><i class="fa-solid fa-tag me-1"></i>Discount</span>
                            <span class="value">− ৳ {{ number_format($order->discount, 2) }}</span>
                        </div>
                        <div class="summary-row net-payable">
                            <span class="label">Net Payable</span>
                            <span class="value">৳ {{ number_format($order->total_amount - $order->discount, 2) }}</span>
                        </div>
                        <div class="summary-row paid">
                            <span class="label"><i class="fa-solid fa-circle-check me-1"></i>Paid</span>
                            <span class="value">৳ {{ number_format($order->paid_amount, 2) }}</span>
                        </div>
                        <div class="summary-total {{ $order->due_amount <= 0 ? 'paid-full' : '' }}">
                            <span class="label">{{ $order->due_amount <= 0 ? '✓ Fully Paid' : 'Balance Due' }}</span>
                            <span class="value">৳ {{ number_format(abs($order->due_amount), 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <div class="invoice-footer-note">
            <i class="fa-solid fa-circle-info me-1"></i>
            Thank you for choosing <strong>{{ $settings['hospital_name'] ?? 'our center' }}</strong>.
            This is a computer-generated invoice and does not require a physical signature.
        </div>
    </div>
</div>

@endsection
