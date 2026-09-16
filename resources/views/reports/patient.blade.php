@extends('layouts.admin')

@section('title', 'Patient Report')

@section('content')
<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('reports.patient') }}" method="GET" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label">Start Date</label>
                <input type="date" name="start_date" class="form-control" value="{{ $startDate }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">End Date</label>
                <input type="date" name="end_date" class="form-control" value="{{ $endDate }}">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-filter"></i> Generate Report</button>
                <button type="button" class="btn btn-secondary" onclick="window.print()"><i class="fa-solid fa-print"></i> Print</button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header bg-white">
        <h5 class="mb-0">Patient Demographics ({{ date('d M, Y', strtotime($startDate)) }} to {{ date('d M, Y', strtotime($endDate)) }})</h5>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="alert alert-info text-center">
                    <h6>Total New Patients</h6>
                    <h3>{{ $patients->count() }}</h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="alert alert-success text-center">
                    <h6>Male Patients</h6>
                    <h3>{{ $maleCount }}</h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="alert alert-warning text-center">
                    <h6>Female Patients</h6>
                    <h3>{{ $femaleCount }}</h3>
                </div>
            </div>
        </div>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Patient ID</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Registration Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($patients as $patient)
                <tr>
                    <td>{{ $patient->patient_id }}</td>
                    <td>{{ $patient->name }}</td>
                    <td>{{ $patient->age }}</td>
                    <td>{{ $patient->gender }}</td>
                    <td>{{ date('d M, Y', strtotime($patient->created_at)) }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">No patients registered in this period.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
