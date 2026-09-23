@extends('layouts.admin')

@section('title', 'Master Tests')

@section('content')

{{-- Page Header --}}
<div class="page-header-premium d-flex justify-content-between align-items-center">
    <div>
        <h4><i class="fa-solid fa-microscope me-2"></i>Master Tests</h4>
        <p>Manage all laboratory tests, pricing, and configurations</p>
    </div>
    <a href="{{ route('tests.create') }}" class="btn btn-premium-new">
        <i class="fa-solid fa-plus me-2"></i>Add New Test
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
                    <th>Test Code</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Specimen</th>
                    <th>Price (৳)</th>
                    <th>Status</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tests as $test)
                <tr>
                    <td><span class="id-badge">{{ $test->test_code }}</span></td>
                    <td><span class="fw-semibold text-dark">{{ $test->name }}</span></td>
                    <td>{{ $test->department->name ?? 'N/A' }}</td>
                    <td>{{ $test->specimen_type }}</td>
                    <td class="fw-bold text-success">৳ {{ number_format($test->price, 2) }}</td>
                    <td>
                        @if($test->status)
                            <span class="status-pill pill-success"><i class="fa-solid fa-check-circle"></i> Active</span>
                        @else
                            <span class="status-pill pill-danger"><i class="fa-solid fa-xmark-circle"></i> Inactive</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('tests.edit', $test->id) }}" class="action-btn action-btn-edit" title="Edit Test">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <form action="{{ route('tests.destroy', $test->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this test?');" class="d-inline">
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
                    <td colspan="7">
                        <div class="empty-state">
                            <i class="fa-solid fa-flask"></i>
                            <strong>No tests configured</strong>
                            <p class="mt-2 mb-0 small">Add a new lab test to your catalog.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($tests->hasPages())
        <div class="px-4 py-3 border-top">
            {{ $tests->links() }}
        </div>
    @endif
</div>
@endsection
