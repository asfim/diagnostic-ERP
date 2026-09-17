<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\Invoice;
use App\Models\DiagnosticOrder;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user->hasRole('Doctor')) {
            $doctor = Doctor::where('user_id', $user->id)->first();
            
            if (!$doctor) {
                // Fallback if no doctor record is linked to this user
                return view('admin.dashboard', $this->getAdminData());
            }

            $data = [
                'total_appointments' => Appointment::where('doctor_id', $doctor->id)->count(),
                'today_appointments_count' => Appointment::where('doctor_id', $doctor->id)->whereDate('date', today())->count(),
                'upcoming_appointments' => Appointment::with('patient')
                                            ->where('doctor_id', $doctor->id)
                                            ->whereIn('status', ['Scheduled', 'Confirmed'])
                                            ->whereDate('date', '>=', today())
                                            ->orderBy('date')
                                            ->orderBy('time')
                                            ->take(5)
                                            ->get(),
                'today_appointments' => Appointment::with('patient')
                                            ->where('doctor_id', $doctor->id)
                                            ->whereDate('date', today())
                                            ->orderBy('time')
                                            ->get(),
            ];

            return view('doctor.dashboard', $data);
        }

        // Default Admin / Receptionist Dashboard
        return view('admin.dashboard', $this->getAdminData());
    }

    private function getAdminData()
    {
        return [
            'total_patients' => Patient::count(),
            'total_doctors' => Doctor::count(),
            'total_appointments' => Appointment::count(),
            'total_invoices' => Invoice::count(),
            'total_revenue' => Invoice::sum('paid'),
            'total_lab_orders' => DiagnosticOrder::count(),
            'recent_patients' => Patient::latest()->take(5)->get(),
            'recent_appointments' => Appointment::with(['patient', 'doctor'])->latest()->take(5)->get(),
        ];
    }
}
