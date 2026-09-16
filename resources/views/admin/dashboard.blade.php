@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="row g-4">
    <div class="col-md-3">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <h5 class="card-title">Today's Patients</h5>
                <p class="card-text fs-2">0</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h5 class="card-title">Today's Appointments</h5>
                <p class="card-text fs-2">0</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <h5 class="card-title">Pending Reports</h5>
                <p class="card-text fs-2">0</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-info">
            <div class="card-body">
                <h5 class="card-title">Today's Collection</h5>
                <p class="card-text fs-2">৳ 0.00</p>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Recent Activities
            </div>
            <div class="card-body">
                <p class="text-muted">No recent activities found.</p>
            </div>
        </div>
    </div>
</div>
@endsection
