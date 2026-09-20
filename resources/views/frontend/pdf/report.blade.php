<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Diagnostic Report - {{ $result->diagnosticOrder->order_id }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Helvetica', Arial, sans-serif;
            color: #2d3748;
            line-height: 1.5;
            background: #fff;
        }

        /* ── Top Color Band ── */
        .top-band {
            background: linear-gradient(135deg, #0b5ed7 0%, #20c997 100%);
            height: 8px;
            width: 100%;
        }

        /* ── Header ── */
        .header {
            padding: 25px 40px;
            border-bottom: 2px solid #e2e8f0;
        }
        .header-inner {
            width: 100%;
        }
        .header-inner td {
            vertical-align: middle;
        }
        .logo-area h1 {
            font-size: 30px;
            color: #0b5ed7;
            letter-spacing: -0.5px;
            margin-bottom: 2px;
        }
        .logo-area .subtitle {
            font-size: 11px;
            color: #718096;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .contact-area {
            text-align: right;
            font-size: 11px;
            color: #718096;
            line-height: 1.8;
        }

        /* ── Report Title Bar ── */
        .report-title-bar {
            background: linear-gradient(135deg, #0b5ed7 0%, #1a73e8 100%);
            padding: 12px 40px;
            color: #fff;
        }
        .report-title-bar h2 {
            font-size: 16px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .report-title-bar .order-id {
            float: right;
            font-size: 13px;
            opacity: 0.9;
            padding-top: 2px;
        }

        /* ── Patient Info ── */
        .patient-section {
            padding: 20px 40px;
            background: #f7fafc;
            border-bottom: 1px solid #e2e8f0;
        }
        .patient-table {
            width: 100%;
            border-collapse: collapse;
        }
        .patient-table td {
            padding: 4px 0;
            font-size: 12px;
        }
        .patient-table .label {
            color: #718096;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 10px;
            letter-spacing: 0.5px;
            width: 100px;
            padding-right: 8px;
        }
        .patient-table .value {
            color: #2d3748;
            font-weight: 500;
        }
        .patient-table .divider {
            width: 40px;
        }

        /* ── Test Result ── */
        .result-section {
            padding: 25px 40px;
        }
        .test-name-bar {
            background: #edf2f7;
            border-left: 4px solid #0b5ed7;
            padding: 10px 16px;
            margin-bottom: 20px;
        }
        .test-name-bar h3 {
            font-size: 15px;
            color: #1a202c;
        }
        .test-name-bar .test-category {
            font-size: 11px;
            color: #718096;
            margin-top: 2px;
        }

        /* ── Result Table ── */
        .result-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .result-table thead th {
            background: #2d3748;
            color: #fff;
            padding: 10px 14px;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            font-weight: 600;
            text-align: left;
        }
        .result-table thead th:first-child {
            border-radius: 4px 0 0 0;
        }
        .result-table thead th:last-child {
            border-radius: 0 4px 0 0;
        }
        .result-table tbody td {
            padding: 12px 14px;
            border-bottom: 1px solid #edf2f7;
            font-size: 12px;
        }
        .result-table tbody tr:nth-child(even) {
            background: #f7fafc;
        }
        .result-table .status-badge {
            display: inline-block;
            background: #c6f6d5;
            color: #276749;
            padding: 3px 12px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* ── Remarks ── */
        .remarks-box {
            background: #fffbeb;
            border: 1px solid #fefcbf;
            border-left: 4px solid #ecc94b;
            padding: 12px 16px;
            margin-bottom: 20px;
            border-radius: 0 4px 4px 0;
        }
        .remarks-box .remarks-title {
            font-size: 11px;
            font-weight: 700;
            color: #975a16;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }
        .remarks-box p {
            font-size: 12px;
            color: #744210;
        }

        /* ── Signature ── */
        .signature-section {
            padding: 30px 40px 10px;
        }
        .signature-table {
            width: 100%;
        }
        .signature-table td {
            vertical-align: bottom;
            padding: 0;
        }
        .sig-box {
            text-align: center;
            width: 200px;
        }
        .sig-line {
            border-bottom: 1.5px solid #2d3748;
            height: 40px;
            margin-bottom: 6px;
        }
        .sig-name {
            font-size: 11px;
            font-weight: 700;
            color: #2d3748;
        }
        .sig-title {
            font-size: 10px;
            color: #718096;
        }

        /* ── Footer ── */
        .footer {
            margin-top: 20px;
            padding: 15px 40px;
            background: #f7fafc;
            border-top: 1px solid #e2e8f0;
        }
        .footer-inner {
            width: 100%;
        }
        .footer-inner td {
            font-size: 10px;
            color: #a0aec0;
            vertical-align: middle;
        }
        .footer .qr-area {
            text-align: right;
        }
        .footer .disclaimer {
            font-style: italic;
            line-height: 1.6;
        }

        /* ── Bottom Band ── */
        .bottom-band {
            background: linear-gradient(135deg, #0b5ed7 0%, #20c997 100%);
            height: 6px;
            width: 100%;
        }
    </style>
</head>
<body>

    <!-- Top Gradient Band -->
    <div class="top-band"></div>

    <!-- Header -->
    <div class="header">
        <table class="header-inner" cellpadding="0" cellspacing="0">
            <tr>
                <td class="logo-area">
                    @if(!empty($siteSettings['site_logo']))
                        <img src="{{ public_path('storage/' . $siteSettings['site_logo']) }}" style="height: 50px; margin-bottom: 5px;"><br>
                    @endif
                    <h1>{{ $siteSettings['site_name'] ?? 'MediDiag' }}</h1>
                    <div class="subtitle">{{ $siteSettings['site_tagline'] ?? 'Advanced Diagnostic Care & Clinic' }}</div>
                </td>
                <td class="contact-area">
                    {{ $siteSettings['site_address'] ?? '123 Health Avenue, Dhaka' }}<br>
                    Phone: {{ $siteSettings['site_phone'] ?? '+880 1711 000 000' }} | Email: {{ $siteSettings['site_email'] ?? 'info@medidiag.com' }}
                </td>
            </tr>
        </table>
    </div>

    <!-- Report Title Bar -->
    <div class="report-title-bar">
        <span class="order-id">Invoice: {{ $result->diagnosticOrder->order_id }}</span>
        <h2>Diagnostic Test Report</h2>
    </div>

    <!-- Patient Information -->
    <div class="patient-section">
        <table class="patient-table" cellpadding="0" cellspacing="0">
            <tr>
                <td class="label">Patient Name</td>
                <td class="value">{{ $result->patient->name }}</td>
                <td class="divider"></td>
                <td class="label">Patient ID</td>
                <td class="value">{{ $result->patient->patient_id }}</td>
            </tr>
            <tr>
                <td class="label">Age / Gender</td>
                <td class="value">{{ $result->patient->age }} Years / {{ ucfirst($result->patient->gender) }}</td>
                <td class="divider"></td>
                <td class="label">Blood Group</td>
                <td class="value">{{ $result->patient->blood_group ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="label">Mobile</td>
                <td class="value">{{ $result->patient->mobile }}</td>
                <td class="divider"></td>
                <td class="label">Report Date</td>
                <td class="value">{{ $result->created_at->format('d M, Y &mdash; h:i A') }}</td>
            </tr>
            <tr>
                <td class="label">Address</td>
                <td class="value" colspan="4">{{ $result->patient->address ?? 'N/A' }}</td>
            </tr>
        </table>
    </div>

    <!-- Test Result Section -->
    <div class="result-section">

        <div class="test-name-bar">
            <h3>{{ $result->test->name }}</h3>
            <div class="test-category">Department: {{ $result->test->department->name ?? 'General' }}</div>
        </div>

        <table class="result-table">
            <thead>
                <tr>
                    <th style="width:35%;">Parameter</th>
                    <th style="width:30%;">Result</th>
                    <th style="width:20%;">Status</th>
                    <th style="width:15%;">Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="font-weight:600;">{{ $result->test->name }}</td>
                    <td style="font-weight:700; color:#1a202c;">{{ $result->result_value }}</td>
                    <td>
                        <span class="status-badge">{{ $result->status }}</span>
                    </td>
                    <td>{{ $result->created_at->format('d M, Y') }}</td>
                </tr>
            </tbody>
        </table>

        @if($result->remarks)
        <div class="remarks-box">
            <div class="remarks-title">&#9888; Clinical Remarks</div>
            <p>{{ $result->remarks }}</p>
        </div>
        @endif
    </div>

    <!-- Signature -->
    <div class="signature-section">
        <table class="signature-table" cellpadding="0" cellspacing="0">
            <tr>
                <td>&nbsp;</td>
                <td style="text-align:right;">
                    <div class="sig-box" style="display:inline-block;">
                        <div class="sig-line"></div>
                        <div class="sig-name">Authorized Signatory</div>
                        <div class="sig-title">Consultant Pathologist</div>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <!-- Footer -->
    <div class="footer">
        <table class="footer-inner" cellpadding="0" cellspacing="0">
            <tr>
                <td class="disclaimer" style="width:70%;">
                    This is a computer-generated report and does not require a physical signature.<br>
                    For queries or discrepancies, please contact the laboratory within 48 hours.<br>
                    Generated on: {{ date('d M, Y &mdash; h:i A') }}
                </td>
                <td class="qr-area">
                    <strong style="color:#718096;">Report ID:</strong><br>
                    <span style="font-size:12px; color:#4a5568; font-weight:700;">{{ strtoupper(substr(md5($result->id . $result->created_at), 0, 12)) }}</span>
                </td>
            </tr>
        </table>
    </div>

    <!-- Bottom Gradient Band -->
    <div class="bottom-band"></div>

</body>
</html>
