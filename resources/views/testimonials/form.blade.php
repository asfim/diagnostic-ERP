@php($editing = isset($testimonial) && $testimonial)
<form action="{{ $editing ? route('testimonials.update', $testimonial) : route('testimonials.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if($editing) @method('PUT') @endif

    @if($errors->any())
        <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
    @endif

    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Patient Name <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $testimonial->name ?? '') }}" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Location</label>
            <input type="text" name="location" class="form-control" value="{{ old('location', $testimonial->location ?? '') }}" placeholder="e.g. Dhanmondi, Dhaka">
        </div>
        <div class="col-12">
            <label class="form-label">Review <span class="text-danger">*</span></label>
            <textarea name="review" class="form-control" rows="5" required>{{ old('review', $testimonial->review ?? '') }}</textarea>
        </div>
        <div class="col-md-4">
            <label class="form-label">Rating <span class="text-danger">*</span></label>
            <select name="rating" class="form-select" required>
                @for($rating = 5; $rating >= 1; $rating--)
                    <option value="{{ $rating }}" @selected((int) old('rating', $testimonial->rating ?? 5) === $rating)>{{ $rating }} star{{ $rating > 1 ? 's' : '' }}</option>
                @endfor
            </select>
        </div>
        <div class="col-md-8">
            <label class="form-label">Patient Photo</label>
            @if($editing && $testimonial->photo)
                <div class="mb-2 d-flex align-items-center gap-3">
                    <img src="{{ asset('storage/' . $testimonial->photo) }}" alt="{{ $testimonial->name }}" class="rounded-circle" style="width:50px;height:50px;object-fit:cover;">
                    <label class="form-check"><input type="checkbox" name="remove_photo" value="1" class="form-check-input"> Remove current photo</label>
                </div>
            @endif
            <input type="file" name="photo" class="form-control" accept="image/jpeg,image/png,image/jpg,image/webp">
        </div>
        <div class="col-12">
            <div class="form-check form-switch">
                <input type="checkbox" name="status" value="1" class="form-check-input" id="testimonialStatus" @checked(old('status', $testimonial->status ?? true))>
                <label class="form-check-label" for="testimonialStatus">Show this testimonial on the homepage</label>
            </div>
        </div>
    </div>

    <div class="mt-4 text-end">
        <a href="{{ route('testimonials.index') }}" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save me-1"></i>{{ $editing ? 'Update Testimonial' : 'Save Testimonial' }}</button>
    </div>
</form>
