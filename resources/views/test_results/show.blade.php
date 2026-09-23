@extends('layouts.admin')

@section('title', 'Lab Report')

@push('styles')
<style>
    /* ── Screen-only action bar ── */
    .report-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
    }

    /* ── Report wrapper ── */
    #lab-report {
        max-width: 860px;
        margin: 0 auto;
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 8px 40px rgba(0,0,0,.12);
        font-family: 'Inter', sans-serif;
        color: #1e293b;
    }

    /* ── Gradient header ── */
    .report-header {
        background: linear-gradient(135deg, #1e3a5f 0%, #2563eb 100%);
        padding: 32px 40px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
    }

    .report-header .logo-area {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .report-header .logo-icon {
        width: 62px;
        height: 62px;
        background: rgba(255,255,255,.15);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        color: #fff;
        border: 2px solid rgba(255,255,255,.25);
        flex-shrink: 0;
        overflow: hidden;
    }

    .report-header .logo-icon img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .report-header .clinic-name {
        font-size: 1.45rem;
        font-weight: 700;
        color: #fff;
        line-height: 1.2;
    }

    .report-header .clinic-tagline {
        font-size: 0.78rem;
        color: rgba(255,255,255,.7);
        margin-top: 3px;
        letter-spacing: 0.5px;
    }

    .report-header .clinic-meta {
        text-align: right;
        font-size: 0.78rem;
        color: rgba(255,255,255,.75);
        line-height: 1.7;
    }

    /* ── Red accent bar ── */
    .report-accent-bar {
        height: 5px;
        background: linear-gradient(90deg, #f97316, #ef4444, #ec4899);
    }

    /* ── Title ribbon ── */
    .report-title-ribbon {
        background: #f1f5f9;
        border-bottom: 1px solid #e2e8f0;
        padding: 14px 40px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .report-title-ribbon .ribbon-label {
        font-size: 1.05rem;
        font-weight: 700;
        letter-spacing: 2.5px;
        text-transform: uppercase;
        color: #1e3a5f;
    }

    .report-title-ribbon .ribbon-meta {
        font-size: 0.8rem;
        color: #64748b;
    }

    .ribbon-meta span {
        font-weight: 600;
        color: #1e293b;
    }

    /* ── Patient info grid ── */
    .report-body {
        padding: 30px 40px;
    }

    .patient-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        overflow: hidden;
        margin-bottom: 28px;
    }

    .patient-cell {
        padding: 12px 18px;
        border-bottom: 1px solid #e2e8f0;
        font-size: 0.88rem;
    }

    .patient-cell:nth-child(odd) { border-right: 1px solid #e2e8f0; }
    .patient-cell:nth-last-child(-n+2) { border-bottom: none; }

    .patient-cell .cell-label {
        font-size: 0.72rem;
        font-weight: 600;
        letter-spacing: 0.8px;
        text-transform: uppercase;
        color: #94a3b8;
        margin-bottom: 3px;
    }

    .patient-cell .cell-value {
        font-weight: 600;
        color: #1e293b;
    }

    /* ── Section heading ── */
    .section-heading {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 14px;
    }

    .section-heading .sh-line {
        flex: 1;
        height: 2px;
        background: linear-gradient(90deg, #2563eb, transparent);
        border-radius: 2px;
    }

    .section-heading .sh-text {
        font-size: 0.78rem;
        font-weight: 700;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        color: #2563eb;
        white-space: nowrap;
    }

    /* ── Results table ── */
    .results-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.88rem;
        margin-bottom: 28px;
    }

    .results-table thead tr {
        background: linear-gradient(135deg, #1e3a5f, #2563eb);
        color: #fff;
    }

    .results-table thead th {
        padding: 12px 16px;
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 0.8px;
        text-transform: uppercase;
    }

    .results-table tbody tr {
        border-bottom: 1px solid #e2e8f0;
        transition: background .15s;
    }

    .results-table tbody tr:last-child { border-bottom: none; }
    .results-table tbody tr:hover { background: #f8fafc; }

    .results-table tbody td {
        padding: 13px 16px;
        color: #334155;
    }

    .results-table tbody td:first-child {
        font-weight: 600;
        color: #1e293b;
    }

    .result-badge {
        display: inline-block;
        padding: 3px 12px;
        border-radius: 20px;
        font-size: 0.78rem;
        font-weight: 600;
        background: #dcfce7;
        color: #15803d;
        border: 1px solid #bbf7d0;
    }

    /* ── Signature row ── */
    .signature-row {
        display: flex;
        justify-content: space-between;
        margin-top: 40px;
        padding-top: 20px;
        border-top: 1px dashed #cbd5e1;
    }

    .sig-block { text-align: center; }

    .sig-line {
        width: 140px;
        border-top: 2px solid #334155;
        margin: 0 auto 8px;
    }

    .sig-title {
        font-size: 0.8rem;
        font-weight: 700;
        color: #1e293b;
    }

    .sig-sub {
        font-size: 0.72rem;
        color: #94a3b8;
        margin-top: 2px;
    }

    /* ── Footer ── */
    .report-footer {
        background: #f1f5f9;
        border-top: 1px solid #e2e8f0;
        padding: 14px 40px;
        text-align: center;
        font-size: 0.72rem;
        color: #94a3b8;
    }

    /* ── PRINT STYLES ── */
    @media print {
        body { background: #fff !important; }

        .sidebar, .top-navbar, .d-print-none, .report-actions {
            display: none !important;
        }

        .main-content {
            margin-left: 0 !important;
        }

        .content-body {
            padding: 0 !important;
        }

        #lab-report {
            max-width: 100%;
            box-shadow: none;
            border-radius: 0;
        }

        .report-header {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .results-table thead tr {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .report-accent-bar {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
    }
</style>
@endpush

@section('content')

{{-- Action Bar (hidden on print) --}}
<div class="report-actions d-print-none">
    <a href="{{ route('test-results.index') }}" class="btn btn-secondary">
        <i class="fa-solid fa-arrow-left me-1"></i> Back
    </a>
    <button onclick="window.print()" class="btn btn-primary px-4">
        <i class="fa-solid fa-print me-2"></i> Print Report
    </button>
</div>

{{-- Lab Report Card --}}
<div id="lab-report">

    {{-- Gradient Header with Logo --}}
    <div class="report-header">
        <div class="logo-area">
            <div class="logo-icon">
                @if(!empty($settings['site_logo']))
                    <img src="{{ asset('storage/' . $settings['site_logo']) }}" alt="Logo">
                @else
                    <i class="fa-solid fa-hospital-user"></i>
                @endif
            </div>
            <div>
                <div class="clinic-name">{{ $settings['site_name'] ?? config('app.name') }}</div>
                <div class="clinic-tagline">{{ $settings['site_tagline'] ?? 'Diagnostic & Clinic' }}</div>
            </div>
        </div>
        <div class="clinic-meta">
            @if(!empty($settings['site_address']))
                <div><i class="fa-solid fa-location-dot me-1" style="opacity:.7"></i>{{ $settings['site_address'] }}</div>
            @endif
            @if(!empty($settings['site_phone']))
                <div><i class="fa-solid fa-phone me-1" style="opacity:.7"></i>{{ $settings['site_phone'] }}</div>
            @endif
            @if(!empty($settings['site_email']))
                <div><i class="fa-solid fa-envelope me-1" style="opacity:.7"></i>{{ $settings['site_email'] }}</div>
            @endif
        </div>
    </div>

    {{-- Color Accent Bar --}}
    <div class="report-accent-bar"></div>

    {{-- Title Ribbon --}}
    <div class="report-title-ribbon">
        <div class="ribbon-label">
            <i class="fa-solid fa-flask-vial me-2" style="color:#2563eb"></i>Laboratory Report
        </div>
        <div class="ribbon-meta">
            Report Date: <span>{{ date('d M, Y') }}</span> &nbsp;|&nbsp;
            Report No: <span>#TR-{{ str_pad($result->id, 5, '0', STR_PAD_LEFT) }}</span>
        </div>
    </div>

    {{-- Body --}}
    <div class="report-body">

        {{-- Patient Info Grid --}}
        <div class="section-heading">
            <div class="sh-text">Patient Information</div>
            <div class="sh-line"></div>
        </div>

        <div class="patient-grid">
            <div class="patient-cell">
                <div class="cell-label">Patient Name</div>
                <div class="cell-value">{{ $result->patient->name ?? 'N/A' }}</div>
            </div>
            <div class="patient-cell">
                <div class="cell-label">Patient ID</div>
                <div class="cell-value">{{ $result->patient->patient_id ?? 'N/A' }}</div>
            </div>
            <div class="patient-cell">
                <div class="cell-label">Age / Sex</div>
                <div class="cell-value">{{ $result->patient->age ?? '-' }} yrs / {{ ucfirst($result->patient->gender ?? '-') }}</div>
            </div>
            <div class="patient-cell">
                <div class="cell-label">Order ID</div>
                <div class="cell-value">
                    @if($result->diagnosticOrder)
                        {{ $result->diagnosticOrder->order_id ?? '#' . $result->diagnostic_order_id }}
                    @else
                        #{{ $result->diagnostic_order_id }}
                    @endif
                </div>
            </div>
            <div class="patient-cell" style="grid-column: span 2; border-bottom: none;">
                <div class="cell-label">Sample Collected</div>
                <div class="cell-value">{{ date('d M, Y  H:i A', strtotime($result->created_at)) }}</div>
            </div>
        </div>

        {{-- Test Results Section --}}
        <div class="section-heading">
            <div class="sh-text">Test Results</div>
            <div class="sh-line"></div>
        </div>

        @if($result->values && $result->values->count() > 0)
        <table class="results-table">
            <thead>
                <tr>
                    <th style="width:35%">Parameter Name</th>
                    <th style="width:20%">Result</th>
                    <th style="width:25%">Reference Range</th>
                    <th style="width:20%">Unit</th>
                </tr>
            </thead>
            <tbody>
                @foreach($result->values as $val)
                <tr>
                    <td>{{ $val->parameter->name ?? 'N/A' }}</td>
                    <td>
                        <span class="result-badge fw-bold" style="background:transparent; border:none; color:inherit; padding:0;">{{ $val->value }}</span>
                    </td>
                    <td style="color:#64748b; font-size:0.83rem;">
                        {{ $val->parameter->reference_range ?? '-' }}
                    </td>
                    <td style="color:#64748b; font-size:0.83rem;">
                        {{ $val->parameter->unit ?? '-' }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="mb-4">
            <strong>Remarks / Interpretation:</strong><br>
            <span style="color:#64748b; font-size:0.9rem;">{{ $result->remarks ?? '—' }}</span>
        </div>
        @else
        <table class="results-table">
            <thead>
                <tr>
                    <th style="width:35%">Test Name</th>
                    <th style="width:20%">Result</th>
                    <th style="width:25%">Reference Range</th>
                    <th style="width:20%">Remarks</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $result->test->name ?? 'Unknown Test' }}</td>
                    <td>
                        <span class="result-badge">{{ $result->result_value }}</span>
                    </td>
                    <td style="color:#64748b; font-size:0.83rem;">
                        {{ $result->test->reference_range ?? 'As per standard range' }}
                    </td>
                    <td style="color:#64748b; font-size:0.83rem;">
                        {{ $result->remarks ?? '—' }}
                    </td>
                </tr>
            </tbody>
        </table>
        @endif

        {{-- Signature Row --}}
        <div class="signature-row">
            <div class="sig-block">
                <div class="sig-line"></div>
                <div class="sig-title">Prepared By</div>
                <div class="sig-sub">Medical Technologist</div>
            </div>
            <div class="sig-block">
                <div class="sig-line"></div>
                <div class="sig-title">Authorized By</div>
                <div class="sig-sub">Laboratory In-charge</div>
            </div>
            <div class="sig-block">
                <div class="sig-line"></div>
                <div class="sig-title">Verified By</div>
                <div class="sig-sub">Pathologist / Consultant</div>
            </div>
        </div>

    </div>{{-- /report-body --}}

    {{-- Footer --}}
    <div class="report-footer">
        <i class="fa-solid fa-circle-info me-1"></i>
        This report is system-generated by <strong>{{ $settings['site_name'] ?? config('app.name') }}</strong> and is valid only with authorized signatures. For queries call {{ $settings['site_phone'] ?? '' }}.
    </div>

</div>{{-- /#lab-report --}}

@endsection
