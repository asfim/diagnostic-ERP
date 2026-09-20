@extends('layouts.admin')
@section('title', 'Frontend CMS (Home Page)')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 fw-bold"><i class="fas fa-desktop me-2"></i>Frontend CMS</h4>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row g-4">
        {{-- Hero Section Form --}}
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-bottom py-3">
                    <h6 class="mb-0 fw-bold"><i class="fas fa-image me-2 text-primary"></i>Hero Section (Top Banner)</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('cms.hero.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Main Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" value="{{ old('title', $hero->title ?? '') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Subtitle <span class="text-danger">*</span></label>
                            <textarea name="subtitle" class="form-control" rows="3" required>{{ old('subtitle', $hero->subtitle ?? '') }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Button Text</label>
                                <input type="text" name="button_text" class="form-control" value="{{ old('button_text', $hero->button_text ?? '') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Button Link</label>
                                <input type="text" name="button_link" class="form-control" value="{{ old('button_link', $hero->button_link ?? '') }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-semibold">Background Image (Optional)</label>
                                @if(isset($hero->bg_image) && $hero->bg_image)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $hero->bg_image) }}" alt="Background Image" class="img-thumbnail" style="max-height: 100px;">
                                        <div class="form-check mt-1">
                                            <input class="form-check-input" type="checkbox" name="remove_bg_image" value="1" id="removeBgImage">
                                            <label class="form-check-label text-danger" for="removeBgImage"><small>Remove Image</small></label>
                                        </div>
                                    </div>
                                @endif
                                <input type="file" name="bg_image" class="form-control" accept="image/*">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Overlay Color (RGBA)</label>
                            <input type="text" name="overlay_color" class="form-control" value="{{ old('overlay_color', $hero->overlay_color ?? 'rgba(11, 94, 215, 0.85)') }}" placeholder="e.g. rgba(11, 94, 215, 0.85)">
                            <small class="text-muted">Used if background image is uploaded to darken the image.</small>
                        </div>

                        <div class="form-check form-switch mb-4">
                            <input class="form-check-input" type="checkbox" name="status" value="1" id="heroStatus" {{ (isset($hero) && $hero->status) ? 'checked' : '' }}>
                            <label class="form-check-label" for="heroStatus">Show Hero Section</label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 fw-bold"><i class="fas fa-save me-2"></i>Save Hero Section</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Stats Section Form --}}
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-bottom py-3">
                    <h6 class="mb-0 fw-bold"><i class="fas fa-chart-bar me-2 text-success"></i>Statistics Section (Array Data)</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('cms.stats.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Expert Doctors Count</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user-md"></i></span>
                                    <input type="text" name="stats[doctors]" class="form-control" value="{{ old('stats.doctors', $stats['doctors'] ?? '') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Diagnostic Tests Count</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-microscope"></i></span>
                                    <input type="text" name="stats[tests]" class="form-control" value="{{ old('stats.tests', $stats['tests'] ?? '') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Happy Patients Count</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-users"></i></span>
                                    <input type="text" name="stats[patients]" class="form-control" value="{{ old('stats.patients', $stats['patients'] ?? '') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Emergency Support</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-headset"></i></span>
                                    <input type="text" name="stats[support]" class="form-control" value="{{ old('stats.support', $stats['support'] ?? '') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-success w-100 fw-bold"><i class="fas fa-save me-2"></i>Save Statistics</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
