@extends('layouts.admin')

@section('title', 'Lab Order Report')

@section('content')

{{-- Page Header --}}
<div class="page-header-premium d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4><i class="fa-solid fa-flask-vial me-2"></i>Lab Order Report</h4>
        <p>Review lab test orders and identify the most prescribed diagnostics</p>
    </div>
</div>

<div class="card-premium card mb-4 d-print-none">
    <div class="card-body">
        <form action="{{ route('reports.labOrder') }}" method="GET" class="row g-3 align-items-end">
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

<div class="row g-4">
    <div class="col-md-7">
        <div class="card-premium card h-100">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                <h6 class="mb-0 fw-bold text-primary"><i class="fa-solid fa-list-check me-2"></i>Lab Orders ({{ date('d M, Y', strtotime($startDate)) }} to {{ date('d M, Y', strtotime($endDate)) }})</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-premium mb-0">
                        <thead>
                            <tr>
                                <th>Order No</th>
                                <th>Date</th>
                                <th>Tests Included</th>
                                <th>Total (৳)</th>
                            </tr>
                        </thead>
                        <tbody id="lab-order-table-body">
                            @forelse($orders as $index => $order)
                            <tr class="lab-order-row" style="{{ $index >= 10 ? 'display: none;' : '' }}">
                                <td><span class="id-badge">{{ $order->order_id }}</span></td>
                                <td><span class="text-muted">{{ date('d M Y', strtotime($order->order_date)) }}</span></td>
                                <td>
                                    @foreach($order->items as $item)
                                        <span class="status-pill pill-secondary mb-1 d-inline-block" style="font-size: 0.7rem; padding: 2px 8px;">{{ $item->test->name ?? 'Unknown' }}</span>
                                    @endforeach
                                </td>
                                <td><strong class="text-dark">৳ {{ number_format($order->total_amount, 2) }}</strong></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4">
                                    <div class="empty-state">
                                        <i class="fa-solid fa-flask text-muted"></i>
                                        <strong>No lab orders found</strong>
                                        <p class="mt-2 mb-0 small">No diagnostic orders placed in this period.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($orders->count() > 10)
                <div class="text-center mt-4 d-print-none" id="load-more-container">
                    <button id="load-more-btn" class="btn btn-outline-primary px-4 py-2" style="border-radius: 8px; font-weight: 600;">
                        <i class="fa-solid fa-spinner me-2"></i>Load More
                    </button>
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card-premium card h-100">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                <h6 class="mb-0 fw-bold text-success"><i class="fa-solid fa-chart-bar me-2"></i>Most Prescribed Tests</h6>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush mt-2 border-top">
                    @forelse($testCounts as $name => $count)
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-3 border-bottom">
                        <span class="fw-semibold text-dark"><i class="fa-solid fa-microscope text-muted me-2"></i>{{ $name }}</span>
                        <span class="status-pill pill-success">{{ $count }} orders</span>
                    </li>
                    @empty
                    <li class="list-group-item text-center text-muted border-0 py-5">
                        <i class="fa-solid fa-chart-line fs-3 text-muted opacity-50 mb-3 d-block"></i>
                        No tests ordered in this period.
                    </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let currentVisible = 10;
        const totalRows = {{ $orders->count() }};
        const loadMoreBtn = document.getElementById('load-more-btn');
        const rows = document.querySelectorAll('.lab-order-row');

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
