@extends('layouts.frontend')
@section('title', 'Medical Blog & Health Tips - MediDiag')
@section('content')

<x-frontend.page-banner title="Health & Wellness Blog" :breadcrumbs="['Home' => url('/'), 'Blog' => url('/blog')]" />

<section class="section-padding bg-white">
    <div class="container">
        <div class="section-header centered" data-aos="fade-up">
            <span class="label">Latest News</span>
            <h2>Medical Insights & Health Tips</h2>
            <p>Stay updated with the latest medical research, health tips, and news from our expert doctors.</p>
        </div>

        <div class="row g-4">
            @forelse($blogs as $i => $blog)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ (($i % 3) + 1) * 100 }}">
                    <article class="blog-card h-100">
                        <div class="overflow-hidden">
                            @if($blog->image)
                                <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}">
                            @else
                                <div class="d-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary" style="height:210px;"><i class="bi bi-newspaper fs-1"></i></div>
                            @endif
                        </div>
                        <div class="blog-body">
                            <div class="blog-meta d-flex gap-3">
                                <span><i class="bi bi-tag-fill"></i> {{ $blog->category }}</span>
                                <span><i class="bi bi-calendar3"></i> {{ $blog->published_at?->format('M d, Y') ?: 'Latest' }}</span>
                            </div>
                            <h5 class="fw-bold mb-2">{{ $blog->title }}</h5>
                            <p class="mb-3">{{ $blog->excerpt }}</p>
                            <a href="{{ route('frontend.blog.show', $blog) }}" class="text-primary fw-bold text-decoration-none">Read More <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </article>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="bi bi-newspaper text-primary" style="font-size:3rem;"></i>
                    <h4 class="mt-3">No articles available yet</h4>
                    <p class="text-muted mb-0">New health articles will appear here soon.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

@endsection
