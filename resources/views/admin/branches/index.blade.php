@extends('layouts.admin')

@section('title', 'Branch Management')

@section('content')
<div class="page-header-premium d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1"><i class="fa-solid fa-building me-2"></i>Branch Management</h4>
        <p class="text-white opacity-75 mb-0">Manage diagnostic center branches & upcoming centers</p>
    </div>
    <button type="button" class="btn btn-light text-primary rounded-pill px-4 fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#createBranchModal">
        <i class="fa-solid fa-plus me-2"></i>Add New Branch
    </button>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4">
        <i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card card-premium shadow-sm border-0 rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">Image</th>
                        <th>Branch Details</th>
                        <th>Badge</th>
                        <th>Contact & Hours</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Order</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($branches as $branch)
                        <tr>
                            <td class="ps-4">
                                <img src="{{ $branch->image_url }}" class="rounded-3 shadow-sm object-fit-cover" style="width: 70px; height: 50px;" alt="{{ $branch->name }}">
                            </td>
                            <td>
                                <strong class="text-dark d-block mb-1">{{ $branch->name }}</strong>
                                <small class="text-muted"><i class="fa-solid fa-location-dot me-1"></i>{{ $branch->address ?? 'N/A' }}</small>
                            </td>
                            <td>
                                @if($branch->badge)
                                    <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 rounded-pill px-3 py-1">
                                        {{ $branch->badge }}
                                    </span>
                                @else
                                    <span class="text-muted small">-</span>
                                @endif
                            </td>
                            <td>
                                <div class="small text-muted mb-1"><i class="fa-solid fa-phone me-1"></i>{{ $branch->phone ?? 'N/A' }}</div>
                                <div class="small text-muted"><i class="fa-solid fa-clock me-1"></i>{{ $branch->opening_hours ?? 'N/A' }}</div>
                            </td>
                            <td>
                                @if($branch->is_upcoming)
                                    <span class="badge bg-warning text-dark px-3 py-1 rounded-pill">
                                        <i class="fa-solid fa-clock me-1"></i>Upcoming
                                    </span>
                                @else
                                    <span class="badge bg-success px-3 py-1 rounded-pill">
                                        <i class="fa-solid fa-check me-1"></i>Active Branch
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if($branch->status)
                                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1">Enabled</span>
                                @else
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill px-3 py-1">Disabled</span>
                                @endif
                            </td>
                            <td>
                                <span class="fw-bold text-muted">{{ $branch->sort_order }}</span>
                            </td>
                            <td class="text-end pe-4">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-primary rounded-pill me-1" data-bs-toggle="modal" data-bs-target="#editBranchModal{{ $branch->id }}">
                                        <i class="fa-solid fa-pen"></i> Edit
                                    </button>
                                    <form action="{{ route('branches.destroy', $branch) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this branch?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Edit Branch Modal -->
                        <div class="modal fade" id="editBranchModal{{ $branch->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content border-0 shadow rounded-4">
                                    <form action="{{ route('branches.update', $branch) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header border-0 pb-0">
                                            <h5 class="modal-title fw-bold"><i class="fa-solid fa-pen-to-square me-2 text-primary"></i>Edit Branch</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body p-4">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label class="form-label fw-bold">Branch Name <span class="text-danger">*</span></label>
                                                    <input type="text" name="name" class="form-control" value="{{ old('name', $branch->name) }}" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label fw-bold">Badge Text</label>
                                                    <input type="text" name="badge" class="form-control" value="{{ old('badge', $branch->badge) }}" placeholder="e.g. Headquarters, Regional Center, Coming Soon">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label fw-bold">Phone Number</label>
                                                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $branch->phone) }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label fw-bold">Email Address</label>
                                                    <input type="email" name="email" class="form-control" value="{{ old('email', $branch->email) }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label fw-bold">Opening Hours</label>
                                                    <input type="text" name="opening_hours" class="form-control" value="{{ old('opening_hours', $branch->opening_hours) }}" placeholder="e.g. Open 24/7 or 8:00 AM - 10:00 PM">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label fw-bold">Sort Order</label>
                                                    <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $branch->sort_order) }}">
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label fw-bold">Address</label>
                                                    <input type="text" name="address" class="form-control" value="{{ old('address', $branch->address) }}">
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label fw-bold">Google Map Link URL</label>
                                                    <input type="url" name="map_link" class="form-control" value="{{ old('map_link', $branch->map_link) }}" placeholder="https://maps.google.com/...">
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label fw-bold">Description / Announcement (Required for Upcoming Branches)</label>
                                                    <textarea name="description" class="form-control" rows="3" placeholder="Description or opening announcement">{{ old('description', $branch->description) }}</textarea>
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label fw-bold">Branch Image</label>
                                                    @if($branch->image)
                                                        <div class="mb-2">
                                                            <img src="{{ $branch->image_url }}" style="height: 70px;" class="rounded border">
                                                        </div>
                                                    @endif
                                                    <input type="file" name="image" class="form-control" accept="image/*">
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-check form-switch mt-2">
                                                        <input class="form-check-input" type="checkbox" name="is_upcoming" value="1" id="editUpcoming{{ $branch->id }}" {{ $branch->is_upcoming ? 'checked' : '' }}>
                                                        <label class="form-check-label fw-bold ms-2" for="editUpcoming{{ $branch->id }}">
                                                            Mark as Upcoming / Coming Soon Branch
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-check form-switch mt-2">
                                                        <input class="form-check-input" type="checkbox" name="status" value="1" id="editStatus{{ $branch->id }}" {{ $branch->status ? 'checked' : '' }}>
                                                        <label class="form-check-label fw-bold ms-2" for="editStatus{{ $branch->id }}">
                                                            Enable Branch (Active)
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer border-0">
                                            <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary rounded-pill px-4">Update Branch</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                <i class="fa-solid fa-building-circle-xmark fs-1 d-block mb-3 opacity-50"></i>
                                No branches found. Click "Add New Branch" to create one.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Create Branch Modal -->
<div class="modal fade" id="createBranchModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-4">
            <form action="{{ route('branches.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold"><i class="fa-solid fa-building-circle-check me-2 text-primary"></i>Add New Branch</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Branch Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" placeholder="e.g. Dhaka Main Center" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Badge Text</label>
                            <input type="text" name="badge" class="form-control" placeholder="e.g. Headquarters, Regional Center, Coming Soon">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Phone Number</label>
                            <input type="text" name="phone" class="form-control" placeholder="+880 ...">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="branch@medidiag.com">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Opening Hours</label>
                            <input type="text" name="opening_hours" class="form-control" placeholder="e.g. Open 24/7 or 8:00 AM - 10:00 PM">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Sort Order</label>
                            <input type="number" name="sort_order" class="form-control" value="0">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">Address</label>
                            <input type="text" name="address" class="form-control" placeholder="Full branch address">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">Google Map Link URL</label>
                            <input type="url" name="map_link" class="form-control" placeholder="https://maps.google.com/...">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">Description / Announcement (Required for Upcoming Branches)</label>
                            <textarea name="description" class="form-control" rows="3" placeholder="Description or opening announcement"></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">Branch Image</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                        </div>
                        <div class="col-md-6">
                            <div class="form-check form-switch mt-2">
                                <input class="form-check-input" type="checkbox" name="is_upcoming" value="1" id="createUpcoming">
                                <label class="form-check-label fw-bold ms-2" for="createUpcoming">
                                    Mark as Upcoming / Coming Soon Branch
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check form-switch mt-2">
                                <input class="form-check-input" type="checkbox" name="status" value="1" id="createStatus" checked>
                                <label class="form-check-label fw-bold ms-2" for="createStatus">
                                    Enable Branch (Active)
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">Save Branch</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
