@extends('layouts.admin')

@section('title', 'Enter Lab Result')

@section('content')
<div class="card">
    <div class="card-header bg-white">
        <h5 class="mb-0">Test Result Entry</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('test-results.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Select Pending Order <span class="text-danger">*</span></label>
                    <select name="diagnostic_order_id" class="form-select" required>
                        <option value="">-- Select Lab Order --</option>
                        @foreach($orders as $order)
                            <option value="{{ $order->id }}">{{ $order->order_id }} - {{ $order->patient->name ?? 'Unknown' }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Select Test <span class="text-danger">*</span></label>
                    <select name="test_id" class="form-select" required>
                        <option value="">-- Select Master Test --</option>
                        @foreach($tests as $test)
                            <option value="{{ $test->id }}">{{ $test->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <hr class="mt-4">
                
                <div class="col-md-12">
                    <label class="form-label">Result Value <span class="text-danger">*</span></label>
                    <input type="text" name="result_value" class="form-control" placeholder="e.g. 14.5 g/dL" required>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Remarks / Interpretation</label>
                    <textarea name="remarks" class="form-control" rows="3" placeholder="Normal, High, Low..."></textarea>
                </div>
            </div>
            
            <div class="mt-4 text-end">
                <a href="{{ route('test-results.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Save Result</button>
            </div>
        </form>
    </div>
</div>
@endsection
