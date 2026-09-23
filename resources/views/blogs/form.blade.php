@php($editing = isset($blog) && $blog)
<form action="{{ $editing ? route('blogs.update', $blog) : route('blogs.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if($editing) @method('PUT') @endif
    @if($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif

    <div class="row g-3">
        <div class="col-md-8"><label class="form-label">Title <span class="text-danger">*</span></label><input type="text" name="title" class="form-control" value="{{ old('title', $blog->title ?? '') }}" required></div>
        <div class="col-md-4"><label class="form-label">Category <span class="text-danger">*</span></label><input type="text" name="category" class="form-control" value="{{ old('category', $blog->category ?? 'Health Tips') }}" required></div>
        <div class="col-12"><label class="form-label">Short Description <span class="text-danger">*</span></label><textarea name="excerpt" class="form-control" rows="3" maxlength="500" required>{{ old('excerpt', $blog->excerpt ?? '') }}</textarea></div>
        <div class="col-12"><label class="form-label">Full Content</label><textarea name="content" class="form-control" rows="7">{{ old('content', $blog->content ?? '') }}</textarea></div>
        <div class="col-md-5"><label class="form-label">Publish Date</label><input type="date" name="published_at" class="form-control" value="{{ old('published_at', isset($blog->published_at) && $blog->published_at ? $blog->published_at->format('Y-m-d') : now()->format('Y-m-d')) }}"></div>
        <div class="col-md-7"><label class="form-label">Cover Image</label>
            @if($editing && $blog->image)<div class="mb-2 d-flex align-items-center gap-3"><img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" style="width:100px;height:65px;object-fit:cover;border-radius:8px;"><label class="form-check"><input type="checkbox" name="remove_image" value="1" class="form-check-input"> Remove current image</label></div>@endif
            <input type="file" name="image" class="form-control" accept="image/jpeg,image/png,image/jpg,image/webp">
        </div>
        <div class="col-12"><div class="form-check form-switch"><input type="checkbox" name="status" value="1" class="form-check-input" id="blogStatus" @checked(old('status', $blog->status ?? true))><label class="form-check-label" for="blogStatus">Show this blog on the homepage</label></div></div>
    </div>
    <div class="mt-4 text-end"><a href="{{ route('blogs.index') }}" class="btn btn-secondary">Cancel</a> <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save me-1"></i>{{ $editing ? 'Update Blog' : 'Save Blog' }}</button></div>
</form>
