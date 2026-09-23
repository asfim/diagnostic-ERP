@extends('layouts.admin')

@section('title', 'Staff Management')

@section('content')

{{-- Page Header --}}
<div class="page-header-premium d-flex justify-content-between align-items-center">
    <div>
        <h4><i class="fa-solid fa-users-gear me-2"></i>Staff List</h4>
        <p>Manage clinic staff, designations, and system roles</p>
    </div>
    @can('create staff')
    <a href="{{ route('staff.create') }}" class="btn btn-premium-new">
        <i class="fa-solid fa-plus me-2"></i>Add New Staff
    </a>
    @endcan
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
                    <th>Name</th>
                    <th>Email</th>
                    <th>Designation</th>
                    <th>Role</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($staffs as $staff)
                <tr>
                    <td><span class="fw-semibold text-dark">{{ $staff->name }}</span></td>
                    <td><span class="text-muted">{{ $staff->user ? $staff->user->email : 'N/A' }}</span></td>
                    <td><span class="text-dark">{{ $staff->designation }}</span></td>
                    <td>
                        @if($staff->user && $staff->user->roles->count() > 0)
                            @foreach($staff->user->roles as $role)
                                <span class="status-pill pill-primary mb-1 d-inline-block">{{ $role->name }}</span>
                            @endforeach
                        @else
                            <span class="status-pill pill-secondary">No Role</span>
                        @endif
                    </td>
                    <td>{{ $staff->phone }}</td>
                    <td>
                        @if($staff->status == 'Active')
                            <span class="status-pill pill-success"><i class="fa-solid fa-check-circle"></i> Active</span>
                        @else
                            <span class="status-pill pill-danger"><i class="fa-solid fa-xmark-circle"></i> {{ $staff->status }}</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            @can('manage staff')
                            <a href="{{ route('staff.edit', $staff->id) }}" class="action-btn action-btn-edit" title="Edit Staff">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <form action="{{ route('staff.destroy', $staff->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this staff?');" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn action-btn-del" title="Delete">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                            @else
                                <span class="text-muted small">N/A</span>
                            @endcan
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7">
                        <div class="empty-state">
                            <i class="fa-solid fa-user-xmark"></i>
                            <strong>No staff found</strong>
                            <p class="mt-2 mb-0 small">Add a new staff member to the system.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
