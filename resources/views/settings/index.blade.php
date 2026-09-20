@extends('layouts.admin')
@section('title', 'Site Settings')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 fw-bold"><i class="fas fa-cog me-2"></i>Site Settings</h4>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-4">
            {{-- General Settings --}}
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom">
                        <h6 class="mb-0 fw-bold"><i class="fas fa-building me-2 text-primary"></i>General Information</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Site Name <span class="text-danger">*</span></label>
                                <input type="text" name="site_name" class="form-control @error('site_name') is-invalid @enderror"
                                       value="{{ old('site_name', $settings['site_name']) }}" required>
                                @error('site_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Tagline</label>
                                <input type="text" name="site_tagline" class="form-control @error('site_tagline') is-invalid @enderror"
                                       value="{{ old('site_tagline', $settings['site_tagline']) }}" placeholder="e.g., Diagnostic & Clinic">
                                @error('site_tagline') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Phone Number</label>
                                <input type="text" name="site_phone" class="form-control @error('site_phone') is-invalid @enderror"
                                       value="{{ old('site_phone', $settings['site_phone']) }}" placeholder="+880 1711 000 000">
                                @error('site_phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Email</label>
                                <input type="email" name="site_email" class="form-control @error('site_email') is-invalid @enderror"
                                       value="{{ old('site_email', $settings['site_email']) }}" placeholder="info@example.com">
                                @error('site_email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Address</label>
                                <textarea name="site_address" class="form-control @error('site_address') is-invalid @enderror"
                                          rows="2" placeholder="Full address">{{ old('site_address', $settings['site_address']) }}</textarea>
                                @error('site_address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Logo & Favicon --}}
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom">
                        <h6 class="mb-0 fw-bold"><i class="fas fa-image me-2 text-success"></i>Logo</h6>
                    </div>
                    <div class="card-body text-center">
                        @if($settings['site_logo'])
                            <img src="{{ asset('storage/' . $settings['site_logo']) }}" alt="Logo"
                                 class="img-fluid mb-3 rounded border p-2" style="max-height: 80px;">
                        @else
                            <div class="bg-light rounded p-4 mb-3 text-muted">
                                <i class="fas fa-image fa-3x"></i>
                                <p class="mt-2 mb-0 small">No logo uploaded</p>
                            </div>
                        @endif
                        <input type="file" name="site_logo" class="form-control form-control-sm @error('site_logo') is-invalid @enderror" accept="image/*">
                        @error('site_logo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <small class="text-muted">PNG, JPG, SVG. Max 2MB.</small>
                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom">
                        <h6 class="mb-0 fw-bold"><i class="fas fa-star me-2 text-warning"></i>Favicon</h6>
                    </div>
                    <div class="card-body text-center">
                        @if($settings['site_favicon'])
                            <img src="{{ asset('storage/' . $settings['site_favicon']) }}" alt="Favicon"
                                 class="img-fluid mb-3 rounded border p-2" style="max-height: 48px;">
                        @else
                            <div class="bg-light rounded p-4 mb-3 text-muted">
                                <i class="fas fa-star fa-2x"></i>
                                <p class="mt-2 mb-0 small">No favicon uploaded</p>
                            </div>
                        @endif
                        <input type="file" name="site_favicon" class="form-control form-control-sm @error('site_favicon') is-invalid @enderror" accept="image/*">
                        @error('site_favicon') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <small class="text-muted">PNG, ICO, SVG. Max 512KB.</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary px-5 fw-bold">
                <i class="fas fa-save me-2"></i>Save Settings
            </button>
        </div>
    </form>
</div>
@endsection
