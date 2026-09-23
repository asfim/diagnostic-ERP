@extends('layouts.admin')

@section('title', 'About Page')

@section('content')
<div class="page-header-premium"><div><h4><i class="fa-solid fa-circle-info me-2"></i>About Page</h4><p>Manage every editable section of the public About page</p></div></div>

@if(session('success'))<div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>@endif
@if($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif

<form action="{{ route('about-page.update') }}" method="POST" enctype="multipart/form-data">
@csrf @method('PUT')
<div class="card card-premium mb-4"><div class="card-header bg-white pt-4 border-0"><h6 class="fw-bold text-primary">Main About Section</h6></div><div class="card-body"><div class="row g-3">
    <div class="col-md-6"><label class="form-label">Label</label><input name="label" class="form-control" value="{{ old('label', $about['label']) }}" required></div>
    <div class="col-md-6"><label class="form-label">Title</label><input name="title" class="form-control" value="{{ old('title', $about['title']) }}" required></div>
    <div class="col-12"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="3" required>{{ old('description', $about['description']) }}</textarea></div>
    <div class="col-12"><label class="form-label">Quote Highlight</label><input name="quote" class="form-control" value="{{ old('quote', $about['quote'] ?? '') }}" placeholder="Quote / Highlight text"></div>
    <div class="col-md-3"><label class="form-label">Years Number</label><input name="years_number" class="form-control" value="{{ old('years_number', $about['years_number']) }}" required></div>
    <div class="col-md-3"><label class="form-label">Years Text</label><input name="years_text" class="form-control" value="{{ old('years_text', $about['years_text']) }}" required></div>
    <div class="col-md-3"><label class="form-label">Button Text</label><input name="button_text" class="form-control" value="{{ old('button_text', $about['button_text']) }}"></div>
    <div class="col-md-3"><label class="form-label">Button Link</label><input name="button_link" class="form-control" value="{{ old('button_link', $about['button_link']) }}"></div>
    <div class="col-md-6"><label class="form-label">About Image</label>@if(!empty($about['about_image']))<img src="{{ asset('storage/'.$about['about_image']) }}" class="d-block mb-2 rounded" style="width:120px;height:70px;object-fit:cover;"><label class="form-check mb-2"><input type="checkbox" name="remove_about_image" value="1" class="form-check-input"> Remove image</label>@endif<input type="file" name="about_image" class="form-control" accept="image/*"></div>
    <div class="col-md-6"><label class="form-label">Key Features</label>@for($i=0;$i<4;$i++)<input name="features[]" class="form-control mb-2" value="{{ old('features.'.$i, $about['features'][$i] ?? '') }}" placeholder="Feature {{ $i + 1 }}">@endfor</div>
</div></div></div>

<div class="row g-4"><div class="col-md-6"><div class="card card-premium h-100"><div class="card-header bg-white pt-4 border-0"><h6 class="fw-bold text-primary">Mission</h6></div><div class="card-body"><input name="mission_title" class="form-control mb-3" value="{{ old('mission_title', $about['mission_title']) }}" required><textarea name="mission_text" class="form-control" rows="5" required>{{ old('mission_text', $about['mission_text']) }}</textarea></div></div></div><div class="col-md-6"><div class="card card-premium h-100"><div class="card-header bg-white pt-4 border-0"><h6 class="fw-bold text-success">Vision</h6></div><div class="card-body"><input name="vision_title" class="form-control mb-3" value="{{ old('vision_title', $about['vision_title']) }}" required><textarea name="vision_text" class="form-control" rows="5" required>{{ old('vision_text', $about['vision_text']) }}</textarea></div></div></div></div>

<div class="card card-premium my-4"><div class="card-header bg-white pt-4 border-0"><h6 class="fw-bold text-secondary">Core Values</h6></div><div class="card-body"><div class="row g-3">@for($i=0;$i<4;$i++)<div class="col-md-6"><div class="border rounded p-3"><input name="values[{{ $i }}][title]" class="form-control mb-2" value="{{ old('values.'.$i.'.title', $about['values'][$i]['title'] ?? '') }}" placeholder="Value title" required><textarea name="values[{{ $i }}][description]" class="form-control mb-2" rows="2" required>{{ old('values.'.$i.'.description', $about['values'][$i]['description'] ?? '') }}</textarea><div class="row g-2"><div class="col-6"><input name="values[{{ $i }}][icon]" class="form-control" value="{{ old('values.'.$i.'.icon', $about['values'][$i]['icon'] ?? 'bi-star') }}" placeholder="bi-star" required></div><div class="col-6"><input name="values[{{ $i }}][color]" class="form-control" value="{{ old('values.'.$i.'.color', $about['values'][$i]['color'] ?? 'primary') }}" placeholder="primary" required></div></div></div></div>@endfor</div></div></div>

<div class="card card-premium mb-4"><div class="card-header bg-white pt-4 border-0"><h6 class="fw-bold text-danger">Infrastructure</h6></div><div class="card-body"><div class="row g-3"><div class="col-md-6"><input name="infrastructure_title" class="form-control mb-3" value="{{ old('infrastructure_title', $about['infrastructure_title']) }}" required><textarea name="infrastructure_text" class="form-control mb-3" rows="4" required>{{ old('infrastructure_text', $about['infrastructure_text']) }}</textarea>@for($i=0;$i<4;$i++)<input name="infrastructure_points[]" class="form-control mb-2" value="{{ old('infrastructure_points.'.$i, $about['infrastructure_points'][$i] ?? '') }}" required>@endfor</div><div class="col-md-6"><label class="form-label">Infrastructure Image</label>@if(!empty($about['infrastructure_image']))<img src="{{ asset('storage/'.$about['infrastructure_image']) }}" class="d-block mb-2 rounded" style="width:160px;height:90px;object-fit:cover;"><label class="form-check mb-2"><input type="checkbox" name="remove_infrastructure_image" value="1" class="form-check-input"> Remove image</label>@endif<input type="file" name="infrastructure_image" class="form-control" accept="image/*"></div></div></div></div>

<div class="text-end mb-4"><button class="btn btn-primary"><i class="fa-solid fa-save me-1"></i>Save About Page</button></div>
</form>
@endsection
