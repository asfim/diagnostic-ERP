@extends('layouts.admin')

@section('title', 'Edit Test')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h4>Edit Test: {{ $test->name }}</h4>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('tests.index') }}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Back to List</a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('tests.update', $test->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label">Test Code <span class="text-danger">*</span></label>
                    <input type="text" name="test_code" class="form-control" required value="{{ $test->test_code }}">
                </div>
                <div class="col-md-8">
                    <label class="form-label">Test Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" required value="{{ $test->name }}">
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label">Department</label>
                    <select name="department_id" class="form-select">
                        <option value="">Select Department</option>
                        @foreach(\App\Models\Department::all() as $dept)
                            <option value="{{ $dept->id }}" {{ $test->department_id == $dept->id ? 'selected' : '' }}>{{ $dept->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Category</label>
                    <select name="test_category_id" class="form-select">
                        <option value="">Select Category</option>
                        @foreach(\App\Models\TestCategory::all() as $cat)
                            <option value="{{ $cat->id }}" {{ $test->test_category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Specimen Type</label>
                    <input type="text" name="specimen_type" class="form-control" placeholder="e.g. Blood, Urine" value="{{ $test->specimen_type }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label">Price (৳) <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" name="price" class="form-control" required value="{{ $test->price }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Cost (৳)</label>
                    <input type="number" step="0.01" name="cost" class="form-control" value="{{ $test->cost }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="1" {{ $test->status ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ !$test->status ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Update Test</button>
            </div>
        </form>
    </div>
</div>
@endsection
