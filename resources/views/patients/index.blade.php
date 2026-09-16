@extends('layouts.admin')

@section('title', 'Patient Management')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h4>All Patients</h4>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('patients.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> New Patient</a>
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
                    <th>Patient ID</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($patients as $patient)
                <tr>
                    <td>{{ $patient->patient_id }}</td>
                    <td>{{ $patient->name }}</td>
                    <td>{{ $patient->mobile }}</td>
                    <td>{{ $patient->age }}</td>
                    <td>{{ $patient->gender }}</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-info" title="View"><i class="fa-solid fa-eye"></i></a>
                        <a href="#" class="btn btn-sm btn-warning" title="Edit"><i class="fa-solid fa-pen"></i></a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">No patients found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $patients->links() }}
    </div>
</div>
@endsection
