@extends('layouts.admin')
@section('title', 'Frontend CMS (Home Page)')

@section('content')
<div class="container-fluid px-0">
    {{-- Page Header --}}
    <div class="page-header-premium d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4><i class="fas fa-desktop me-2"></i>Frontend CMS</h4>
            <p>Manage the content of your public-facing landing page</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row g-4">
        {{-- Hero Section Form --}}
        <div class="col-lg-6">
            <div class="card card-premium h-100">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                    <h6 class="mb-0 fw-bold text-primary"><i class="fas fa-image me-2"></i>Hero Section (Top Banner)</h6>
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

                        <button type="submit" class="btn btn-primary w-100 fw-bold"><i class="fas fa-save me-2"></i>Save Hero Section</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Stats Section Form --}}
        <div class="col-lg-6">
            <div class="card card-premium h-100">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                    <h6 class="mb-0 fw-bold text-success"><i class="fas fa-chart-bar me-2"></i>Statistics Section (Array Data)</h6>
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
    <div class="row g-4 mt-1">
        {{-- Quick Actions Section Form --}}
        <div class="col-12">
            <div class="card card-premium">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                    <h6 class="mb-0 fw-bold text-info"><i class="fas fa-bolt me-2"></i>Quick Actions (Features Cards)</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('cms.quick_actions.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row g-4">
                            @foreach($quickActions as $index => $action)
                            <div class="col-md-4">
                                <div class="border rounded-3 p-3 bg-light-soft">
                                    <h6 class="fw-bold mb-3">Card {{ $index + 1 }}</h6>
                                    
                                    <div class="mb-2">
                                        <label class="form-label small fw-semibold">Title</label>
                                        <input type="text" name="quick_actions[{{ $index }}][title]" class="form-control form-control-sm" value="{{ $action['title'] ?? '' }}" required>
                                    </div>
                                    
                                    <div class="mb-2">
                                        <label class="form-label small fw-semibold">Description</label>
                                        <textarea name="quick_actions[{{ $index }}][description]" class="form-control form-control-sm" rows="2" required>{{ $action['description'] ?? '' }}</textarea>
                                    </div>
                                    
                                    <div class="row g-2 mb-2">
                                        <div class="col-6">
                                            <label class="form-label small fw-semibold">Icon (Bootstrap)</label>
                                            <input type="text" name="quick_actions[{{ $index }}][icon]" class="form-control form-control-sm" value="{{ $action['icon'] ?? '' }}" placeholder="e.g. bi-star" required>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label small fw-semibold">Color Theme</label>
                                            <select name="quick_actions[{{ $index }}][color]" class="form-select form-select-sm" required>
                                                <option value="primary" {{ ($action['color'] ?? '') == 'primary' ? 'selected' : '' }}>Primary (Blue)</option>
                                                <option value="success" {{ ($action['color'] ?? '') == 'success' ? 'selected' : '' }}>Success (Green)</option>
                                                <option value="danger" {{ ($action['color'] ?? '') == 'danger' ? 'selected' : '' }}>Danger (Red)</option>
                                                <option value="warning" {{ ($action['color'] ?? '') == 'warning' ? 'selected' : '' }}>Warning (Yellow)</option>
                                                <option value="info" {{ ($action['color'] ?? '') == 'info' ? 'selected' : '' }}>Info (Light Blue)</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <label class="form-label small fw-semibold">Button Text</label>
                                            <input type="text" name="quick_actions[{{ $index }}][button_text]" class="form-control form-control-sm" value="{{ $action['button_text'] ?? '' }}" required>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label small fw-semibold">Link (URL)</label>
                                            <input type="text" name="quick_actions[{{ $index }}][link]" class="form-control form-control-sm" value="{{ $action['link'] ?? '' }}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-info text-white w-100 fw-bold"><i class="fas fa-save me-2"></i>Save Quick Actions</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- About Section Form --}}
    <div class="row g-4 mt-1">
        <div class="col-12">
            <div class="card card-premium">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                    <h6 class="mb-0 fw-bold text-primary"><i class="fas fa-info-circle me-2"></i>About Section</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('cms.about.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Label <span class="text-danger">*</span></label>
                                    <input type="text" name="label" class="form-control" value="{{ old('label', $about['label'] ?? '') }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title" class="form-control" value="{{ old('title', $about['title'] ?? '') }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Description <span class="text-danger">*</span></label>
                                    <textarea name="description" class="form-control" rows="4" required>{{ old('description', $about['description'] ?? '') }}</textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Button Text <span class="text-danger">*</span></label>
                                        <input type="text" name="button_text" class="form-control" value="{{ old('button_text', $about['button_text'] ?? '') }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Button Link <span class="text-danger">*</span></label>
                                        <input type="text" name="button_link" class="form-control" value="{{ old('button_link', $about['button_link'] ?? '') }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Years Number <span class="text-danger">*</span></label>
                                        <input type="text" name="years_number" class="form-control" value="{{ old('years_number', $about['years_number'] ?? '') }}" placeholder="e.g. 15+" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Years Text <span class="text-danger">*</span></label>
                                        <textarea name="years_text" class="form-control" rows="2" placeholder="e.g. Years of Excellence" required>{{ old('years_text', $about['years_text'] ?? '') }}</textarea>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Key Features (Up to 4) <span class="text-danger">*</span></label>
                                    @for($i=0; $i<4; $i++)
                                        <input type="text" name="features[]" class="form-control mb-2" value="{{ old('features.'.$i, $about['features'][$i] ?? '') }}" placeholder="Feature {{ $i+1 }}">
                                    @endfor
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Side Image (Optional)</label>
                                    @if(isset($about['image']) && $about['image'])
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/' . $about['image']) }}" alt="About Image" class="img-thumbnail" style="max-height: 100px;">
                                            <div class="form-check mt-1">
                                                <input class="form-check-input" type="checkbox" name="remove_image" value="1" id="removeAboutImage">
                                                <label class="form-check-label text-danger" for="removeAboutImage"><small>Remove Image</small></label>
                                            </div>
                                        </div>
                                    @endif
                                    <input type="file" name="image" class="form-control" accept="image/*">
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary w-100 fw-bold"><i class="fas fa-save me-2"></i>Save About Section</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
