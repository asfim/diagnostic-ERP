@extends('layouts.frontend')
@section('title', $blog->title . ' - MediDiag')
@section('content')

<x-frontend.page-banner title="Health & Wellness Blog" :breadcrumbs="['Home' => url('/'), 'Blog' => route('frontend.blog.index'), $blog->title => route('frontend.blog.show', $blog)]" />

<section class="section-padding bg-white">
    <div class="container">
        <article class="blog-detail mx-auto" style="max-width: 980px;">
            <header class="blog-detail-header mx-auto">
                <div class="blog-detail-meta d-flex flex-wrap gap-3 align-items-center mb-3">
                <span><i class="bi bi-tag-fill"></i> {{ $blog->category }}</span>
                <span><i class="bi bi-calendar3"></i> {{ $blog->published_at?->format('M d, Y') ?: 'Latest' }}</span>
                </div>

                <h1 class="blog-detail-title">{{ $blog->title }}</h1>
                <p class="blog-detail-excerpt">{{ $blog->excerpt }}</p>
            </header>

            @if($blog->image)
                <figure class="blog-detail-media">
                    <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="blog-detail-image">
                </figure>
            @endif

            @if($blog->content)
                <div class="blog-detail-content">{{ $blog->content }}</div>
            @endif

            <a href="{{ route('frontend.blog.index') }}" class="btn btn-outline-primary mt-4">
                <i class="bi bi-arrow-left me-1"></i> Back to All Blogs
            </a>
        </article>
    </div>
</section>

@endsection
