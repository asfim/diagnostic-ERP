@extends('layouts.frontend')
@section('title', $doctor->name . ' - MediDiag')
@section('content')

<x-frontend.page-banner :title="$doctor->name"
    :breadcrumbs="['Doctors' => url('/doctors'), $doctor->name => '#']" />

<section class="section-padding">
    <div class="container">
        <div class="row g-5">

            {{-- Doctor Info --}}
            <div class="col-lg-4" data-aos="fade-right">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden text-center sticky-top" style="top:90px;">
                    @if($doctor->photo)
                    <img src="{{ asset('storage/'.$doctor->photo) }}" class="w-100" alt="{{ $doctor->name }}" style="height:320px;object-fit:cover;">
                    @else
                    <img src="https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?auto=format&fit=crop&w=600&q=80"
                         class="w-100" style="height:320px;object-fit:cover;" alt="{{ $doctor->name }}">
                    @endif
                    <div class="p-4">
                        <h3 class="fw-bold mb-1">{{ $doctor->name }}</h3>
                        <p class="text-secondary fw-bold mb-1">{{ $doctor->specialization }}</p>
                        <p class="text-muted small mb-3">{{ $doctor->qualification }}</p>
                        @if($doctor->department)
                        <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill mb-3">{{ $doctor->department->name }}</span>
                        @endif
                        @if($doctor->consultation_fee)
                        <div class="bg-light-soft p-3 rounded-3 mb-4">
                            <p class="text-muted small mb-1">Consultation Fee</p>
                            <h4 class="fw-bold text-primary mb-0">৳ {{ number_format($doctor->consultation_fee) }}</h4>
                        </div>
                        @endif
                        <a href="{{ url('/appointment') }}?doctor={{ $doctor->id }}" class="btn btn-primary rounded-pill w-100 fw-bold py-2">
                            <i class="bi bi-calendar-check me-2"></i>Book Appointment
                        </a>
                    </div>
                </div>
            </div>

            {{-- Details --}}
            <div class="col-lg-8" data-aos="fade-left">
                <div class="card border-0 shadow-sm rounded-4 p-4 p-lg-5 mb-4">
                    <h4 class="fw-bold mb-3">About Doctor</h4>
                    <p class="text-muted">{{ $doctor->name }} is a highly experienced {{ $doctor->specialization }} with expertise in diagnosing and treating a wide range of conditions. With {{ $doctor->qualification }} qualifications, they are committed to delivering the best patient care.</p>

                    <div class="row g-3 mt-2">
                        @if($doctor->bmdc_reg)
                        <div class="col-sm-6">
                            <div class="bg-light-soft p-3 rounded-3">
                                <small class="text-muted d-block">BMDC Reg.</small>
                                <strong>{{ $doctor->bmdc_reg }}</strong>
                            </div>
                        </div>
                        @endif
                        @if($doctor->mobile)
                        <div class="col-sm-6">
                            <div class="bg-light-soft p-3 rounded-3">
                                <small class="text-muted d-block">Contact</small>
                                <strong>{{ $doctor->mobile }}</strong>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Schedule --}}
                @if($schedules->count())
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <h4 class="fw-bold mb-3"><i class="bi bi-calendar3 text-primary me-2"></i>Consultation Schedule</h4>
                    <div class="table-responsive">
                        <table class="table table-borderless align-middle">
                            <thead class="table-primary">
                                <tr><th>Day</th><th>Time</th><th>Room</th></tr>
                            </thead>
                            <tbody>
                                @foreach($schedules as $sch)
                                <tr>
                                    <td class="fw-semibold">{{ $sch->day ?? '—' }}</td>
                                    <td>{{ $sch->start_time ?? '' }} – {{ $sch->end_time ?? '' }}</td>
                                    <td>{{ $sch->room ?? '—' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif

                <div class="text-center mt-4">
                    <a href="{{ url('/appointment') }}?doctor={{ $doctor->id }}" class="btn btn-primary btn-lg rounded-pill px-5 fw-bold">
                        <i class="bi bi-calendar-check me-2"></i>Book an Appointment
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
