@extends('layouts.admin')

@section('title', 'Master Tests')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h4>All Master Tests</h4>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('tests.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add New Test</a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Test Code</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Specimen</th>
                    <th>Price (৳)</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tests as $test)
                <tr>
                    <td>{{ $test->test_code }}</td>
                    <td>{{ $test->name }}</td>
                    <td>{{ $test->department->name ?? 'N/A' }}</td>
                    <td>{{ $test->specimen_type }}</td>
                    <td>{{ number_format($test->price, 2) }}</td>
                    <td>
                        @if($test->status)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-danger">Inactive</span>
                        @endif
                    </td>
                    <td class="d-flex gap-1">
                        <a href="{{ route('tests.edit', $test->id) }}" class="btn btn-sm btn-warning" title="Edit"><i class="fa-solid fa-pen"></i></a>
                        <form action="{{ route('tests.destroy', $test->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this test?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" title="Delete"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">No tests configured.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $tests->links() }}
    </div>
</div>
@endsection
