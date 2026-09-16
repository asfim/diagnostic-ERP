@extends('layouts.admin')

@section('title', 'Appointments')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h4>All Appointments</h4>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('appointments.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Book Appointment</a>
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
                    <th>Apt. ID</th>
                    <th>Date & Time</th>
                    <th>Patient Name</th>
                    <th>Doctor Name</th>
                    <th>Token</th>
                    <th>Due (৳)</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($appointments as $apt)
                <tr>
                    <td>{{ $apt->appointment_id }}</td>
                    <td>{{ $apt->date }} at {{ $apt->time }}</td>
                    <td>{{ $apt->patient->name ?? 'N/A' }}</td>
                    <td>{{ $apt->doctor->name ?? 'N/A' }}</td>
                    <td>{{ $apt->token }}</td>
                    <td>{{ number_format($apt->due, 2) }}</td>
                    <td>
                        @if($apt->status == 'Pending')
                            <span class="badge bg-warning text-dark">{{ $apt->status }}</span>
                        @elseif($apt->status == 'Confirmed')
                            <span class="badge bg-success">{{ $apt->status }}</span>
                        @else
                            <span class="badge bg-secondary">{{ $apt->status }}</span>
                        @endif
                    </td>
                    <td class="d-flex gap-1">
                        <a href="{{ route('appointments.edit', $apt->id) }}" class="btn btn-sm btn-warning" title="Edit"><i class="fa-solid fa-pen"></i></a>
                        <form action="{{ route('appointments.destroy', $apt->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this appointment?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" title="Delete"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted">No appointments found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $appointments->links() }}
    </div>
</div>
@endsection
