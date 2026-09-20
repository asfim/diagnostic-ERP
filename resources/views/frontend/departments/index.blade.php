@extends('layouts.frontend')
@section('title', 'Our Departments - MediDiag')
@section('content')

<x-frontend.page-banner title="Our Departments" :breadcrumbs="['Departments' => url('/departments')]" />

<section class="section-padding">
    <div class="container">
        <div class="section-header centered mb-5" data-aos="fade-up">
            <span class="label">Specialties</span>
            <h2>Medical Departments</h2>
            <p class="mt-2">We offer specialized services across multiple departments with expert doctors and state-of-the-art equipment.</p>
        </div>

        @php
        $icons = [
            'Pathology' => 'bi-lungs', 'Radiology' => 'bi-broadcast', 'Cardiology' => 'bi-heart-pulse',
            'Neurology' => 'bi-moisture', 'Gynecology' => 'bi-gender-female', 'Orthopedics' => 'bi-person-standing',
            'Medicine' => 'bi-capsule', 'Dental' => 'bi-emoji-smile', 'Physiotherapy' => 'bi-activity',
            'default' => 'bi-hospital',
        ];
        @endphp

        @if($departments->isEmpty())
        <div class="text-center py-5">
            <i class="bi bi-building text-muted" style="font-size:4rem;"></i>
            <h4 class="mt-3 text-muted">No departments configured yet.</h4>
        </div>
        @else
        <div class="row g-4">
            @foreach($departments as $i => $dept)
            @php $icon = $icons[$dept->name] ?? $icons['default']; @endphp
            <div class="col-lg-3 col-md-4 col-6" data-aos="zoom-in" data-aos-delay="{{ ($i % 4) * 80 }}">
                <a href="{{ url('/departments/'.$dept->id) }}" class="dept-card">
                    <i class="bi {{ $icon }} dept-icon"></i>
                    <h5>{{ $dept->name }}</h5>
                    <div class="d-flex justify-content-center gap-3 mt-2">
                        @if(isset($dept->doctors_count))
                        <small class="text-muted">{{ $dept->doctors_count }} Doctors</small>
                        @endif
                        @if(isset($dept->tests_count))
                        <small class="text-muted">{{ $dept->tests_count }} Tests</small>
                        @endif
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>

@endsection
