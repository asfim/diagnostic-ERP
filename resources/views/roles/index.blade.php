@extends('layouts.admin')

@section('title', 'Roles & Permissions')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Roles & Permissions</h4>
    @can('manage settings')
    <a href="{{ route('roles.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus me-1"></i> Add New Role</a>
    @endcan
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Role Name</th>
                    <th>Permissions</th>
                    <th width="150">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $role)
                <tr>
                    <td><strong>{{ $role->name }}</strong></td>
                    <td>
                        @foreach($role->permissions as $permission)
                            <span class="badge bg-secondary mb-1">{{ $permission->name }}</span>
                        @endforeach
                    </td>
                    <td>
                        @can('manage settings')
                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-info text-white"><i class="fa-solid fa-pen-to-square"></i></a>
                        @if($role->name !== 'Admin')
                        <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this role?')"><i class="fa-solid fa-trash"></i></button>
                        </form>
                        @endif
                        @endcan
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
