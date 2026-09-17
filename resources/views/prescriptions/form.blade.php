@extends('layouts.admin')

@section('title', 'Write Prescription')

@section('content')
<div class="row mb-3">
    <div class="col-md-6">
        <h4>Write Prescription</h4>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('consultations.index') }}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Back to Visits</a>
    </div>
</div>

<div class="card mb-4 border-0 shadow-sm">
    <div class="card-body bg-light rounded">
        <div class="row mb-3">
            <div class="col-md-3"><strong>Patient:</strong> {{ $visit->patient->name ?? 'N/A' }}</div>
            <div class="col-md-3"><strong>Doctor:</strong> {{ $visit->doctor->name ?? 'N/A' }}</div>
            <div class="col-md-3"><strong>Visit ID:</strong> {{ $visit->visit_id }}</div>
            <div class="col-md-3"><strong>Date:</strong> {{ $visit->visit_date }}</div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="{{ route('prescriptions.save', $visit->id) }}" method="POST">
            @csrf

            <h5 class="mb-3 border-bottom pb-2 text-primary">Clinical Details</h5>
            <div class="row g-3 mb-4">
                <div class="col-md-12">
                    <label class="form-label">Symptoms / Chief Complaints</label>
                    <textarea name="symptoms" class="form-control" rows="2" placeholder="e.g. Fever, Headache">{{ $visit->symptoms }}</textarea>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Blood Pressure</label>
                    <input type="text" name="blood_pressure" class="form-control" placeholder="e.g. 120/80" value="{{ $visit->blood_pressure }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Weight (kg)</label>
                    <input type="text" name="weight" class="form-control" placeholder="e.g. 65" value="{{ $visit->weight }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Temperature (°F)</label>
                    <input type="text" name="temperature" class="form-control" placeholder="e.g. 98.6" value="{{ $visit->temperature }}">
                </div>
                <div class="col-md-12">
                    <label class="form-label">General Notes / History</label>
                    <textarea name="notes" class="form-control" rows="2">{{ $visit->notes }}</textarea>
                </div>
            </div>
            
            <h5 class="mb-3 border-bottom pb-2 text-primary">Medicines (Rx)</h5>
            <div class="table-responsive">
                <table class="table table-bordered align-middle" id="medicinesTable">
                    <thead class="table-light">
                        <tr>
                            <th width="35%">Medicine Name</th>
                            <th width="15%">Dosage</th>
                            <th width="15%">Duration</th>
                            <th width="25%">Instruction</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($prescription && $prescription->items->count() > 0)
                            @foreach($prescription->items as $index => $item)
                            <tr>
                                <td><input type="text" name="medicines[{{ $index }}][medicine_name]" class="form-control" value="{{ $item->medicine_name }}" required></td>
                                <td><input type="text" name="medicines[{{ $index }}][dosage]" class="form-control" value="{{ $item->dosage }}" placeholder="e.g. 1+0+1" required></td>
                                <td><input type="text" name="medicines[{{ $index }}][duration]" class="form-control" value="{{ $item->duration }}" placeholder="e.g. 7 Days" required></td>
                                <td><input type="text" name="medicines[{{ $index }}][instruction]" class="form-control" value="{{ $item->instruction }}" placeholder="e.g. After meal"></td>
                                <td><button type="button" class="btn btn-sm btn-danger remove-row"><i class="fa-solid fa-trash"></i></button></td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td><input type="text" name="medicines[0][medicine_name]" class="form-control" placeholder="Medicine Name" required></td>
                                <td><input type="text" name="medicines[0][dosage]" class="form-control" placeholder="e.g. 1+0+1" required></td>
                                <td><input type="text" name="medicines[0][duration]" class="form-control" placeholder="e.g. 7 Days" required></td>
                                <td><input type="text" name="medicines[0][instruction]" class="form-control" placeholder="e.g. After meal"></td>
                                <td><button type="button" class="btn btn-sm btn-danger remove-row"><i class="fa-solid fa-trash"></i></button></td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <button type="button" class="btn btn-sm btn-success mt-2" id="addMedicineBtn"><i class="fa-solid fa-plus"></i> Add Another Medicine</button>
            </div>

            <hr class="my-4">

            <h5 class="mb-3 border-bottom pb-2 text-primary">Advice & Follow-up</h5>
            <div class="row g-3">
                <div class="col-md-8">
                    <label class="form-label">General Advice</label>
                    <textarea name="advice" class="form-control" rows="3" placeholder="Enter advice...">{{ $prescription->advice ?? '' }}</textarea>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Next Visit Date</label>
                    <input type="date" name="next_visit_date" class="form-control" value="{{ $prescription->next_visit_date ?? '' }}">
                </div>
            </div>

            <div class="mt-4 text-end">
                <button type="submit" class="btn btn-primary btn-lg"><i class="fa-solid fa-save"></i> Save Prescription</button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tableBody = document.querySelector('#medicinesTable tbody');
    const addBtn = document.getElementById('addMedicineBtn');
    let rowCount = {{ $prescription ? $prescription->items->count() : 1 }};

    addBtn.addEventListener('click', function() {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td><input type="text" name="medicines[${rowCount}][medicine_name]" class="form-control" placeholder="Medicine Name" required></td>
            <td><input type="text" name="medicines[${rowCount}][dosage]" class="form-control" placeholder="e.g. 1+0+1" required></td>
            <td><input type="text" name="medicines[${rowCount}][duration]" class="form-control" placeholder="e.g. 7 Days" required></td>
            <td><input type="text" name="medicines[${rowCount}][instruction]" class="form-control" placeholder="e.g. After meal"></td>
            <td><button type="button" class="btn btn-sm btn-danger remove-row"><i class="fa-solid fa-trash"></i></button></td>
        `;
        tableBody.appendChild(tr);
        rowCount++;
    });

    tableBody.addEventListener('click', function(e) {
        if (e.target.closest('.remove-row')) {
            if (tableBody.querySelectorAll('tr').length > 1) {
                e.target.closest('tr').remove();
            } else {
                alert('At least one row must be present.');
            }
        }
    });
});
</script>
@endsection
