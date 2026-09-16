@extends('layouts.admin')

@section('title', 'Staff Management')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Staff List</h4>
    @can('create staff')
    <a href="{{ route('staff.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus me-1"></i> Add New Staff</a>
    @endcan
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Designation</th>
                    <th>Role</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($staffs as $staff)
                <tr>
                    <td>{{ $staff->name }}</td>
                    <td>{{ $staff->user ? $staff->user->email : 'N/A' }}</td>
                    <td>{{ $staff->designation }}</td>
                    <td>
                        @if($staff->user && $staff->user->roles->count() > 0)
                            @foreach($staff->user->roles as $role)
                                <span class="badge bg-info text-dark">{{ $role->name }}</span>
                            @endforeach
                        @else
                            <span class="badge bg-secondary">No Role</span>
                        @endif
                    </td>
                    <td>{{ $staff->phone }}</td>
                    <td><span class="badge bg-{{ $staff->status == 'Active' ? 'success' : 'danger' }}">{{ $staff->status }}</span></td>
                    <td>
                        @can('manage staff')
                        <a href="{{ route('staff.edit', $staff->id) }}" class="btn btn-sm btn-info text-white" title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>
                        <form action="{{ route('staff.destroy', $staff->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this staff?')" title="Delete"><i class="fa-solid fa-trash"></i></button>
                        </form>
                        @endcan
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">No staff found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
