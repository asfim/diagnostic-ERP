<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\TestResult;
use App\Models\DiagnosticOrder;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('frontend.reports');
    }

    public function search(Request $request)
    {
        $request->validate([
            'searchType' => 'required|in:typeInvoice,typePatient',
            'id_number' => 'required|string',
            'mobile' => 'required|string'
        ]);

        // First find patient by mobile
        // Strip any spaces or country code from the input
        $mobile = $request->mobile;
        
        $patient = Patient::where('mobile', 'LIKE', '%' . $mobile . '%')->first();

        if (!$patient) {
            return back()->withInput()->with('error', 'No patient found with this mobile number.');
        }

        $results = collect();

        if ($request->searchType === 'typePatient') {
            if (trim($patient->patient_id) !== trim($request->id_number)) {
                return back()->withInput()->with('error', 'Patient ID does not match the mobile number.');
            }
            $results = TestResult::with(['test', 'diagnosticOrder'])
                ->where('patient_id', $patient->id)
                ->where('status', 'Completed')
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $order = DiagnosticOrder::where('order_id', trim($request->id_number))
                ->where('patient_id', $patient->id)
                ->first();
                
            if (!$order) {
                return back()->withInput()->with('error', 'Invoice ID not found or does not match this mobile number.');
            }

            $results = TestResult::with(['test', 'diagnosticOrder'])
                ->where('diagnostic_order_id', $order->id)
                ->where('status', 'Completed')
                ->orderBy('created_at', 'desc')
                ->get();
        }

        // Store patient and results in session so they persist if page is refreshed, 
        // but for now compacting to view is fine since it's a POST request.
        // If we want it to survive a refresh, we should flash to session. But passing to view is okay.
        return view('frontend.reports', compact('results', 'patient'));
    }

    public function download($id)
    {
        $result = TestResult::with(['test', 'patient', 'diagnosticOrder'])->findOrFail($id);
        
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('frontend.pdf.report', compact('result'));
        
        return $pdf->download('Test_Report_' . $result->diagnosticOrder->order_id . '.pdf');
    }
}
