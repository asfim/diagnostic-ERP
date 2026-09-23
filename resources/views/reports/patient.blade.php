@extends('layouts.admin')

@section('title', 'Patient Report')

@section('content')

{{-- Page Header --}}
<div class="page-header-premium d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4><i class="fa-solid fa-users me-2"></i>Patient Report</h4>
        <p>Analyze patient demographics and registration statistics</p>
    </div>
</div>

<div class="card-premium card mb-4 d-print-none">
    <div class="card-body">
        <form action="{{ route('reports.patient') }}" method="GET" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label text-muted small fw-bold text-uppercase">Start Date</label>
                <input type="date" name="start_date" class="form-control" value="{{ $startDate }}">
            </div>
            <div class="col-md-4">
                <label class="form-label text-muted small fw-bold text-uppercase">End Date</label>
                <input type="date" name="end_date" class="form-control" value="{{ $endDate }}">
            </div>
            <div class="col-md-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-filter me-2"></i>Generate</button>
                <button type="button" class="btn btn-secondary" onclick="window.print()"><i class="fa-solid fa-print me-2"></i>Print</button>
            </div>
        </form>
    </div>
</div>

<div class="card-premium card">
    <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
        <h6 class="mb-0 fw-bold text-primary"><i class="fa-solid fa-chart-pie me-2"></i>Patient Demographics ({{ date('d M, Y', strtotime($startDate)) }} to {{ date('d M, Y', strtotime($endDate)) }})</h6>
    </div>
    <div class="card-body">
        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="d-flex align-items-center bg-light p-3 rounded-3 border">
                    <div class="me-3">
                        <div class="rounded-circle bg-info bg-opacity-10 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                            <i class="fa-solid fa-users text-info fs-4"></i>
                        </div>
                    </div>
                    <div>
                        <span class="text-muted small fw-bold text-uppercase">New Patients</span>
                        <h4 class="text-info mb-0 fw-bold">{{ $patients->count() }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex align-items-center bg-light p-3 rounded-3 border">
                    <div class="me-3">
                        <div class="rounded-circle bg-success bg-opacity-10 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                            <i class="fa-solid fa-person text-success fs-4"></i>
                        </div>
                    </div>
                    <div>
                        <span class="text-muted small fw-bold text-uppercase">Male</span>
                        <h4 class="text-success mb-0 fw-bold">{{ $maleCount }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex align-items-center bg-light p-3 rounded-3 border">
                    <div class="me-3">
                        <div class="rounded-circle bg-warning bg-opacity-10 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                            <i class="fa-solid fa-person-dress text-warning fs-4"></i>
                        </div>
                    </div>
                    <div>
                        <span class="text-muted small fw-bold text-uppercase">Female</span>
                        <h4 class="text-warning mb-0 fw-bold">{{ $femaleCount }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-premium mb-0">
                <thead>
                    <tr>
                        <th>Patient ID</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Registration Date</th>
                    </tr>
                </thead>
                <tbody id="patient-table-body">
                    @forelse($patients as $index => $patient)
                    <tr class="patient-row" style="{{ $index >= 10 ? 'display: none;' : '' }}">
                        <td><span class="id-badge">{{ $patient->patient_id }}</span></td>
                        <td><span class="fw-semibold text-dark">{{ $patient->name }}</span></td>
                        <td>{{ $patient->age }}</td>
                        <td>
                            @if($patient->gender == 'Male')
                                <span class="status-pill pill-success"><i class="fa-solid fa-mars"></i> Male</span>
                            @else
                                <span class="status-pill pill-warning"><i class="fa-solid fa-venus"></i> Female</span>
                            @endif
                        </td>
                        <td><span class="text-muted">{{ date('d M, Y', strtotime($patient->created_at)) }}</span></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                <i class="fa-solid fa-user-xmark"></i>
                                <strong>No patients registered</strong>
                                <p class="mt-2 mb-0 small">No patient records found for the selected date range.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($patients->count() > 10)
        <div class="text-center mt-4 d-print-none" id="load-more-container">
            <button id="load-more-btn" class="btn btn-outline-primary px-4 py-2" style="border-radius: 8px; font-weight: 600;">
                <i class="fa-solid fa-spinner me-2"></i>Load More
            </button>
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let currentVisible = 10;
        const totalRows = {{ $patients->count() }};
        const loadMoreBtn = document.getElementById('load-more-btn');
        const rows = document.querySelectorAll('.patient-row');

        if (loadMoreBtn) {
            loadMoreBtn.addEventListener('click', function() {
                // Show next 10 rows
                let limit = currentVisible + 10;
                
                for (let i = currentVisible; i < limit && i < totalRows; i++) {
                    if (rows[i]) {
                        rows[i].style.display = 'table-row';
                    }
                }
                
                currentVisible += 10;
                
                // Hide button if all rows are visible
                if (currentVisible >= totalRows) {
                    document.getElementById('load-more-container').style.display = 'none';
                }
            });
        }
    });
</script>
@endpush
