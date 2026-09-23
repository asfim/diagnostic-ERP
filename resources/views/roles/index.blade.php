@extends('layouts.admin')

@section('title', 'Roles & Permissions')

@section('content')

{{-- Page Header --}}
<div class="page-header-premium d-flex justify-content-between align-items-center">
    <div>
        <h4><i class="fa-solid fa-user-shield me-2"></i>Roles</h4>
        <p>Manage system roles and their associated permissions</p>
    </div>
    <a href="{{ route('roles.create') }}" class="btn btn-premium-new">
        <i class="fa-solid fa-plus me-2"></i>Add New Role
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
        <i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
        <i class="fa-solid fa-circle-exclamation me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card-premium card">
    <div class="table-responsive">
        <table class="table table-premium mb-0">
            <thead>
                <tr>
                    <th width="200">Role Name</th>
                    <th>Permissions</th>
                    <th class="text-center" width="150">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $role)
                <tr>
                    <td><strong class="text-dark">{{ $role->name }}</strong></td>
                    <td>
                        @foreach($role->permissions as $permission)
                            <span class="status-pill pill-secondary mb-1 d-inline-block fw-normal" style="font-size: 0.7rem; padding: 3px 8px;">
                                {{ $permission->name }}
                            </span>
                        @endforeach
                    </td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('roles.edit', $role->id) }}" class="action-btn action-btn-edit" title="Edit Role">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            @if($role->name !== 'Admin')
                            <form action="{{ route('roles.destroy', $role->id) }}" method="POST" onsubmit="return confirm('Delete this role?');" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn action-btn-del" title="Delete">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                            @else
                                <span class="d-inline-block" style="width: 32px;"></span>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
