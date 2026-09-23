@extends('layouts.admin')

@section('title', 'Lab Results Entry')

@section('content')

{{-- Page Header --}}
<div class="page-header-premium d-flex justify-content-between align-items-center">
    <div>
        <h4><i class="fa-solid fa-file-medical me-2"></i>Lab Test Results</h4>
        <p>Manage and enter results for diagnostic lab orders</p>
    </div>
    <a href="{{ route('test-results.create') }}" class="btn btn-premium-new">
        <i class="fa-solid fa-plus me-2"></i>Enter New Result
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
        <i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card-premium card">
    <div class="table-responsive">
        <table class="table table-premium mb-0">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Patient Name</th>
                    <th>Test Name</th>
                    <th>Result Value</th>
                    <th>Status</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($results as $result)
                <tr>
                    <td><span class="id-badge">{{ $result->diagnosticOrder->order_id ?? $result->diagnostic_order_id }}</span></td>
                    <td><span class="fw-semibold text-dark">{{ $result->patient->name ?? 'N/A' }}</span></td>
                    <td><span class="text-muted fw-medium">{{ $result->test->name ?? 'N/A' }}</span></td>
                    <td><strong class="text-dark">{{ Str::limit($result->result_value, 30) }}</strong></td>
                    <td>
                        @if($result->status == 'Completed')
                            <span class="status-pill pill-success"><i class="fa-solid fa-check-circle"></i> Completed</span>
                        @else
                            <span class="status-pill pill-warning"><i class="fa-solid fa-clock"></i> {{ $result->status }}</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('test-results.show', $result->id) }}" class="action-btn action-btn-view" title="Print Report">
                                <i class="fa-solid fa-print"></i>
                            </a>
                            <a href="{{ route('test-results.edit', $result->id) }}" class="action-btn action-btn-edit" title="Edit Result">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <form action="{{ route('test-results.destroy', $result->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this result?');" class="d-inline">
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
                    <td colspan="6">
                        <div class="empty-state">
                            <i class="fa-solid fa-file-waveform"></i>
                            <strong>No test results entered yet</strong>
                            <p class="mt-2 mb-0 small">Enter results for pending lab orders.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($results->hasPages())
        <div class="px-4 py-3 border-top">
            {{ $results->links() }}
        </div>
    @endif
</div>
@endsection
