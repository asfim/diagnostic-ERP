@extends('layouts.admin')

@section('title', 'Testimonials')

@section('content')
<div class="page-header-premium d-flex justify-content-between align-items-center">
    <div>
        <h4><i class="fa-solid fa-comments me-2"></i>Patient Testimonials</h4>
        <p>Manage the reviews shown in the homepage Patient Reviews section</p>
    </div>
    <a href="{{ route('testimonials.create') }}" class="btn btn-premium-new">
        <i class="fa-solid fa-plus me-2"></i>Add Testimonial
    </a>
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
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Patient</th>
                    <th>Review</th>
                    <th>Rating</th>
                    <th>Status</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($testimonials as $testimonial)
                <tr>
                    <td>
                        @if($testimonial->photo)
                            <img src="{{ asset('storage/' . $testimonial->photo) }}" alt="{{ $testimonial->name }}" class="rounded-circle" style="width:42px;height:42px;object-fit:cover;">
                        @else
                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center text-white fw-bold" style="width:42px;height:42px;">{{ strtoupper(substr($testimonial->name, 0, 1)) }}</div>
                        @endif
                    </td>
                    <td>
                        <div class="fw-semibold text-dark">{{ $testimonial->name }}</div>
                        <small class="text-muted">{{ $testimonial->location ?: 'Location not added' }}</small>
                    </td>
                    <td><span class="d-inline-block text-muted" style="max-width:420px;">{{ Str::limit($testimonial->review, 100) }}</span></td>
                    <td class="text-warning">{{ str_repeat('★', $testimonial->rating) }}<span class="text-muted">{{ str_repeat('★', 5 - $testimonial->rating) }}</span></td>
                    <td>
                        <span class="status-pill {{ $testimonial->status ? 'pill-success' : 'pill-danger' }}">
                            <i class="fa-solid {{ $testimonial->status ? 'fa-check-circle' : 'fa-xmark-circle' }}"></i>
                            {{ $testimonial->status ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('testimonials.edit', $testimonial) }}" class="action-btn action-btn-edit" title="Edit Testimonial"><i class="fa-solid fa-pen"></i></a>
                            <form action="{{ route('testimonials.destroy', $testimonial) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this testimonial?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn action-btn-del" title="Delete"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6"><div class="empty-state"><i class="fa-solid fa-comments"></i><strong>No testimonials found</strong><p class="mt-2 mb-0 small">Add a patient review to show it on the homepage.</p></div></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($testimonials->hasPages())
        <div class="px-4 py-3 border-top">{{ $testimonials->links() }}</div>
    @endif
</div>
@endsection
