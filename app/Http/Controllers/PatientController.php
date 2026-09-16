<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use Illuminate\Support\Str;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::latest()->paginate(10);
        return view('patients.index', compact('patients'));
    }

    public function create()
    {
        return view('patients.create');
    }

    public function store(StorePatientRequest $request)
    {
        $data = $request->validated();
        
        // Auto-generate Patient ID: P-YYYY-XXXXXX
        $lastPatient = Patient::latest('id')->first();
        $nextId = $lastPatient ? $lastPatient->id + 1 : 1;
        $data['patient_id'] = 'P-' . date('Y') . '-' . str_pad($nextId, 6, '0', STR_PAD_LEFT);
        
        Patient::create($data);

        return redirect()->route('patients.index')->with('success', 'Patient registered successfully!');
    }

    public function show(Patient $patient)
    {
        return view('patients.show', compact('patient'));
    }

    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }

    public function update(UpdatePatientRequest $request, Patient $patient)
    {
        $patient->update($request->validated());
        return redirect()->route('patients.index')->with('success', 'Patient updated successfully!');
    }

    public function destroy(Patient $patient)
    {
        // For medical records, we usually soft delete or just disable, but here's basic destroy.
        $patient->delete();
        return redirect()->route('patients.index')->with('success', 'Patient removed.');
    }
}
