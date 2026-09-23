@extends('layouts.admin')

@section('title', 'Doctor Report')

@section('content')

{{-- Page Header --}}
<div class="page-header-premium d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4><i class="fa-solid fa-user-doctor me-2"></i>Doctor Report</h4>
        <p>Analyze doctor performance and appointment statistics</p>
    </div>
</div>

<div class="card-premium card mb-4 d-print-none">
    <div class="card-body">
        <form action="{{ route('reports.doctor') }}" method="GET" class="row g-3 align-items-end">
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
        <h6 class="mb-0 fw-bold text-primary"><i class="fa-solid fa-stethoscope me-2"></i>Doctor Performance & Appointments ({{ date('d M, Y', strtotime($startDate)) }} to {{ date('d M, Y', strtotime($endDate)) }})</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-premium mb-0">
                <thead>
                    <tr>
                        <th>Doctor Name</th>
                        <th>Department</th>
                        <th class="text-center">Total Appointments</th>
                    </tr>
                </thead>
                <tbody id="doctor-table-body">
                    @forelse($doctors as $index => $doctor)
                    <tr class="doctor-row" style="{{ $index >= 10 ? 'display: none;' : '' }}">
                        <td><span class="fw-semibold text-dark"><i class="fa-solid fa-user-doctor text-muted me-2"></i>{{ $doctor->name }}</span></td>
                        <td><span class="text-muted">{{ $doctor->department->name ?? 'General' }}</span></td>
                        <td class="text-center">
                            @if($doctor->appointments_count > 0)
                                <span class="status-pill pill-success">{{ $doctor->appointments_count }}</span>
                            @else
                                <span class="status-pill pill-secondary">0</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3">
                            <div class="empty-state">
                                <i class="fa-solid fa-calendar-xmark"></i>
                                <strong>No records found</strong>
                                <p class="mt-2 mb-0 small">No appointments scheduled for doctors in this period.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($doctors->count() > 10)
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
        const totalRows = {{ $doctors->count() }};
        const loadMoreBtn = document.getElementById('load-more-btn');
        const rows = document.querySelectorAll('.doctor-row');

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
