<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Test;
use App\Models\TestPackage;
use App\Models\DoctorSchedule;
use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AppointmentController extends Controller
{
    public function index()
    {
        $departments = Department::get();
        $doctors     = Doctor::where('status', 'active')->get();
        $tests       = Test::where('status', 'active')->get();
        $packages    = TestPackage::where('status', 'active')->get();

        return view('frontend.appointment', compact('departments', 'doctors', 'tests', 'packages'));
    }

    public function getDoctorsByDepartment(Request $request)
    {
        $doctors = Doctor::where('department_id', $request->department_id)
                         ->where('status', 'active')
                         ->get(['id', 'name', 'specialization', 'consultation_fee']);

        return response()->json($doctors);
    }

    public function getAvailableSlots(Request $request)
    {
        $schedules = DoctorSchedule::where('doctor_id', $request->doctor_id)->get();
        return response()->json($schedules);
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_name'  => 'required|string|max:255',
            'mobile'        => 'required|string|max:20',
            'doctor_id'     => 'required|exists:doctors,id',
            'date'          => 'required|date|after_or_equal:today',
            'time'          => 'required|string',
            'appointment_type' => 'required|in:consultation,followup,diagnostic',
        ]);

        // Find or create patient
        $patient = Patient::firstOrCreate(
            ['mobile' => $request->mobile],
            [
                'patient_id' => 'PAT-' . strtoupper(Str::random(6)),
                'name'       => $request->patient_name,
                'mobile'     => $request->mobile,
                'email'      => $request->email,
                'gender'     => $request->gender ?? 'unknown',
                'dob'        => $request->dob,
                'address'    => $request->address,
            ]
        );

        $doctor = Doctor::findOrFail($request->doctor_id);

        $appointment = Appointment::create([
            'appointment_id'   => 'APT-' . strtoupper(Str::random(8)),
            'patient_id'       => $patient->id,
            'doctor_id'        => $request->doctor_id,
            'date'             => $request->date,
            'time'             => $request->time,
            'token'            => rand(100, 999),
            'appointment_type' => $request->appointment_type,
            'consultation_fee' => $doctor->consultation_fee,
            'status'           => 'scheduled',
            'notes'            => $request->notes,
        ]);

        return redirect()->route('frontend.appointment.confirmation', $appointment->id)
                         ->with('success', 'Appointment booked successfully!');
    }

    public function confirmation($id)
    {
        $appointment = Appointment::with(['patient', 'doctor.department'])->findOrFail($id);
        return view('frontend.appointment-confirmation', compact('appointment'));
    }
}
