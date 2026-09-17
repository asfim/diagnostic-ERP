<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Doctor;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        
        $query = Appointment::with(['patient', 'doctor'])->latest();

        if ($user->hasRole('Doctor')) {
            $doctor = Doctor::where('user_id', $user->id)->first();
            if ($doctor) {
                $query->where('doctor_id', $doctor->id);
            }
        }

        $appointments = $query->paginate(10);
        return view('appointments.index', compact('appointments'));
    }

    public function create()
    {
        $patients = Patient::all();
        $doctors = Doctor::where('status', true)->get();
        return view('appointments.create', compact('patients', 'doctors'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'date' => 'required|date',
            'time' => 'required',
            'appointment_type' => 'required|string',
            'consultation_fee' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'paid' => 'required|numeric|min:0',
            'due' => 'nullable|numeric|min:0',
        ]);
        
        if (!isset($data['due'])) {
            $data['due'] = $data['consultation_fee'] - ($data['discount'] ?? 0) - $data['paid'];
            if ($data['due'] < 0) {
                $data['due'] = 0;
            }
        }
        
        $lastAppt = Appointment::latest('id')->first();
        $nextId = $lastAppt ? $lastAppt->id + 1 : 1;
        $data['appointment_id'] = 'APT-' . date('ymd') . '-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);
        $data['token'] = $nextId; // Simple token generation
        
        Appointment::create($data);

        return redirect()->route('appointments.index')->with('success', 'Appointment booked successfully!');
    }

    public function show(Appointment $appointment)
    {
        return view('appointments.show', compact('appointment'));
    }

    public function edit(Appointment $appointment)
    {
        $patients = Patient::all();
        $doctors = Doctor::where('status', true)->get();
        return view('appointments.edit', compact('appointment', 'patients', 'doctors'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $data = $request->validate([
            'date' => 'required|date',
            'time' => 'required',
            'status' => 'required|string|in:Pending,Confirmed,Cancelled',
            'consultation_fee' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'paid' => 'required|numeric|min:0',
            'due' => 'nullable|numeric|min:0',
        ]);
        
        if (!isset($data['due'])) {
            $data['due'] = $data['consultation_fee'] - ($data['discount'] ?? 0) - $data['paid'];
            if ($data['due'] < 0) {
                $data['due'] = 0;
            }
        }

        $appointment->update($data);

        if ($data['status'] === 'Confirmed') {
            $this->createVisitIfNotExists($appointment);
        }

        return redirect()->route('appointments.index')->with('success', 'Appointment updated successfully!');
    }

    public function updateStatus(Request $request, Appointment $appointment)
    {
        $request->validate([
            'status' => 'required|string|in:Pending,Confirmed,Cancelled'
        ]);

        $appointment->update(['status' => $request->status]);

        if ($request->status === 'Confirmed') {
            $this->createVisitIfNotExists($appointment);
        }

        return response()->json(['success' => true, 'message' => 'Status updated successfully']);
    }

    private function createVisitIfNotExists(Appointment $appointment)
    {
        $existingVisit = \App\Models\Visit::where('appointment_id', $appointment->id)->first();
        if (!$existingVisit) {
            $lastVisit = \App\Models\Visit::latest('id')->first();
            $nextId = $lastVisit ? $lastVisit->id + 1 : 1;
            
            \App\Models\Visit::create([
                'visit_id' => 'VST-' . date('ymd') . '-' . str_pad($nextId, 4, '0', STR_PAD_LEFT),
                'patient_id' => $appointment->patient_id,
                'doctor_id' => $appointment->doctor_id,
                'appointment_id' => $appointment->id,
                'visit_date' => $appointment->date,
                'status' => 'Pending'
            ]);
        }
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('appointments.index')->with('success', 'Appointment cancelled.');
    }
}
