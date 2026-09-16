@extends('layouts.admin')

@section('title', 'OPD Consultations')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h4>Patient Visits (OPD)</h4>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('consultations.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Record Visit</a>
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
                    <th>Visit ID</th>
                    <th>Date</th>
                    <th>Patient Name</th>
                    <th>Doctor Name</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($visits as $visit)
                <tr>
                    <td>{{ $visit->visit_id }}</td>
                    <td>{{ $visit->visit_date }}</td>
                    <td>{{ $visit->patient->name ?? 'N/A' }}</td>
                    <td>{{ $visit->doctor->name ?? 'N/A' }}</td>
                    <td>
                        @if($visit->status == 'Completed')
                            <span class="badge bg-success">Completed</span>
                        @else
                            <span class="badge bg-warning text-dark">{{ $visit->status }}</span>
                        @endif
                    </td>
                    <td>
                        <a href="#" class="btn btn-sm btn-info" title="View"><i class="fa-solid fa-eye"></i></a>
                        <a href="#" class="btn btn-sm btn-success" title="Prescription"><i class="fa-solid fa-prescription"></i> Write</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">No visits recorded.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $visits->links() }}
    </div>
</div>
@endsection
