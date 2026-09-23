@extends('layouts.admin')

@section('title', 'Edit Testimonial')

@section('content')
<div class="card card-premium">
    <div class="card-header bg-white border-bottom-0 pt-4"><h5 class="mb-0">Edit Patient Testimonial</h5></div>
    <div class="card-body">
        @include('testimonials.form', compact('testimonial'))
    </div>
</div>
@endsection
