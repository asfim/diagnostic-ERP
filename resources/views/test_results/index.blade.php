@extends('layouts.admin')

@section('title', 'Lab Results Entry')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h4>Lab Test Results</h4>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('test-results.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Enter New Result</a>
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
                    <th>Order ID</th>
                    <th>Patient Name</th>
                    <th>Test Name</th>
                    <th>Result Value</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($results as $result)
                <tr>
                    <td>{{ $result->diagnostic_order_id }}</td>
                    <td>{{ $result->patient->name ?? 'N/A' }}</td>
                    <td>{{ $result->test->name ?? 'N/A' }}</td>
                    <td><strong>{{ $result->result_value }}</strong></td>
                    <td>
                        @if($result->status == 'Completed')
                            <span class="badge bg-success">Completed</span>
                        @else
                            <span class="badge bg-warning text-dark">{{ $result->status }}</span>
                        @endif
                    </td>
                    <td>
                        <a href="#" class="btn btn-sm btn-info" title="View"><i class="fa-solid fa-eye"></i></a>
                        <a href="#" class="btn btn-sm btn-primary" title="Print Report"><i class="fa-solid fa-print"></i> Report</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">No test results entered yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $results->links() }}
    </div>
</div>
@endsection
