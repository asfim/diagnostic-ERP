@extends('layouts.admin')

@section('title', 'Blogs')

@section('content')
<div class="page-header-premium d-flex justify-content-between align-items-center">
    <div>
        <h4><i class="fa-solid fa-newspaper me-2"></i>Blogs</h4>
        <p>Manage the health articles shown on the homepage</p>
    </div>
    <a href="{{ route('blogs.create') }}" class="btn btn-premium-new"><i class="fa-solid fa-plus me-2"></i>Add Blog</a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
        <i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card-premium card">
    <div class="table-responsive">
        <table class="table table-premium mb-0">
            <thead><tr><th>Image</th><th>Title</th><th>Category</th><th>Published</th><th>Status</th><th class="text-center">Actions</th></tr></thead>
            <tbody>
                @forelse($blogs as $blog)
                <tr>
                    <td>
                        @if($blog->image)
                            <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" style="width:80px;height:52px;object-fit:cover;border-radius:8px;">
                        @else
                            <div class="bg-light text-primary d-flex align-items-center justify-content-center" style="width:80px;height:52px;border-radius:8px;"><i class="fa-solid fa-newspaper"></i></div>
                        @endif
                    </td>
                    <td><span class="fw-semibold text-dark">{{ $blog->title }}</span><br><small class="text-muted">{{ Str::limit($blog->excerpt, 80) }}</small></td>
                    <td>{{ $blog->category }}</td>
                    <td>{{ $blog->published_at?->format('M d, Y') ?: 'Not scheduled' }}</td>
                    <td><span class="status-pill {{ $blog->status ? 'pill-success' : 'pill-danger' }}"><i class="fa-solid {{ $blog->status ? 'fa-check-circle' : 'fa-xmark-circle' }}"></i> {{ $blog->status ? 'Active' : 'Inactive' }}</span></td>
                    <td><div class="d-flex justify-content-center gap-2">
                        <a href="{{ route('blogs.edit', $blog) }}" class="action-btn action-btn-edit" title="Edit Blog"><i class="fa-solid fa-pen"></i></a>
                        <form action="{{ route('blogs.destroy', $blog) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this blog?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="action-btn action-btn-del" title="Delete"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </div></td>
                </tr>
                @empty
                <tr><td colspan="6"><div class="empty-state"><i class="fa-solid fa-newspaper"></i><strong>No blogs found</strong><p class="mt-2 mb-0 small">Add a blog to show it on the homepage.</p></div></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($blogs->hasPages())<div class="px-4 py-3 border-top">{{ $blogs->links() }}</div>@endif
</div>
@endsection
