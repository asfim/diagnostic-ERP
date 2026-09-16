<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use App\Models\Patient;
use App\Models\Doctor;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    public function index()
    {
        $visits = Visit::with(['patient', 'doctor'])->latest()->paginate(10);
        return view('consultations.index', compact('visits'));
    }

    public function create()
    {
        $patients = Patient::all();
        $doctors = Doctor::where('status', true)->get();
        return view('consultations.create', compact('patients', 'doctors'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'visit_date' => 'required|date',
            'symptoms' => 'nullable|string',
            'blood_pressure' => 'nullable|string',
            'weight' => 'nullable|string',
            'temperature' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);
        
        $lastVisit = Visit::latest('id')->first();
        $nextId = $lastVisit ? $lastVisit->id + 1 : 1;
        $data['visit_id'] = 'VST-' . date('ymd') . '-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);
        
        Visit::create($data);

        return redirect()->route('consultations.index')->with('success', 'Visit recorded successfully!');
    }

    public function show($id)
    {
        $visit = Visit::findOrFail($id);
        return view('consultations.show', compact('visit'));
    }

    public function edit($id)
    {
        $visit = Visit::findOrFail($id);
        $patients = Patient::all();
        $doctors = Doctor::where('status', true)->get();
        return view('consultations.edit', compact('visit', 'patients', 'doctors'));
    }

    public function update(Request $request, $id)
    {
        $visit = Visit::findOrFail($id);
        $data = $request->validate([
            'symptoms' => 'nullable|string',
            'blood_pressure' => 'nullable|string',
            'weight' => 'nullable|string',
            'temperature' => 'nullable|string',
            'notes' => 'nullable|string',
            'status' => 'required|string',
        ]);
        
        $visit->update($data);
        return redirect()->route('consultations.index')->with('success', 'Visit updated successfully!');
    }

    public function destroy($id)
    {
        $visit = Visit::findOrFail($id);
        $visit->delete();
        return redirect()->route('consultations.index')->with('success', 'Visit deleted.');
    }
}
