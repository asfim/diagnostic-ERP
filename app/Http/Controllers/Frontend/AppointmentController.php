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
    public function index(Request $request)
    {
        $departments = Department::get();
        $doctors     = Doctor::where('status', 1)->get();
        $tests       = Test::where('status', 1)->get();
        $packages    = TestPackage::where('status', 'active')->get();

        $selectedTest = $request->query('test') ? Test::find($request->query('test')) : null;
        $selectedDoctor = $request->query('doctor') ? Doctor::find($request->query('doctor')) : null;

        return view('frontend.appointment', compact('departments', 'doctors', 'tests', 'packages', 'selectedTest', 'selectedDoctor'));
    }

    public function getDoctorsByDepartment(Request $request)
    {
        $doctors = Doctor::where('department_id', $request->department_id)
                         ->where('status', 'active')
                         ->get(['id', 'name', 'specialization', 'consultation_fee']);

        return response()->json($doctors);
    }

    public function getTestsByDepartment(Request $request)
    {
        $tests = Test::where('department_id', $request->department_id)
                     ->where('status', 1)
                     ->get(['id', 'name', 'test_code', 'price']);
                     
        return response()->json($tests);
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
            'appointment_type' => 'required|in:consultation,followup,diagnostic',
            'doctor_id'     => 'required_if:appointment_type,consultation,followup|nullable|exists:doctors,id',
            'date'          => 'required|date|after_or_equal:today',
            'time'          => 'required|string',
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

        $doctor = $request->doctor_id ? Doctor::findOrFail($request->doctor_id) : null;

        $notes = $request->notes;
        
        // If a test was selected from the dropdown, append it to notes
        if ($request->filled('test_id')) {
            $test = Test::find($request->test_id);
            if ($test) {
                $notes = $notes ? $notes . "\n" : "";
                $notes .= "Booking for Test: {$test->name} ({$test->test_code})";
            }
        }

        $appointment = Appointment::create([
            'appointment_id'   => 'APT-' . strtoupper(Str::random(8)),
            'patient_id'       => $patient->id,
            'doctor_id'        => $request->doctor_id,
            'date'             => $request->date,
            'time'             => $request->time,
            'token'            => rand(100, 999),
            'appointment_type' => $request->appointment_type,
            'consultation_fee' => $doctor ? $doctor->consultation_fee : 0,
            'status'           => 'scheduled',
            'notes'            => $notes,
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
