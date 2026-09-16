<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::latest()->paginate(10);
        return view('doctors.index', compact('doctors'));
    }

    public function create()
    {
        return view('doctors.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'specialization' => 'required|string|max:255',
            'mobile' => 'required|string|max:20',
            'email' => 'nullable|email',
            'consultation_fee' => 'required|numeric|min:0',
        ]);
        
        // Auto-generate Doctor ID: DR-XXXX
        $lastDoc = Doctor::latest('id')->first();
        $nextId = $lastDoc ? $lastDoc->id + 1 : 1;
        $data['doctor_id'] = 'DR-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);
        
        Doctor::create($data);

        return redirect()->route('doctors.index')->with('success', 'Doctor added successfully!');
    }

    public function show(Doctor $doctor)
    {
        return view('doctors.show', compact('doctor'));
    }

    public function edit(Doctor $doctor)
    {
        return view('doctors.edit', compact('doctor'));
    }

    public function update(Request $request, Doctor $doctor)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'specialization' => 'required|string|max:255',
            'mobile' => 'required|string|max:20',
            'email' => 'nullable|email',
            'consultation_fee' => 'required|numeric|min:0',
        ]);
        
        $doctor->update($data);
        return redirect()->route('doctors.index')->with('success', 'Doctor updated successfully!');
    }

    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
        return redirect()->route('doctors.index')->with('success', 'Doctor removed.');
    }
}
