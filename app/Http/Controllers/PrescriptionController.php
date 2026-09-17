<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use App\Models\Prescription;
use App\Models\PrescriptionItem;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    public function form($visit_id)
    {
        $visit = Visit::with(['patient', 'doctor', 'prescription.items'])->findOrFail($visit_id);
        $prescription = $visit->prescription;

        return view('prescriptions.form', compact('visit', 'prescription'));
    }

    public function save(Request $request, $visit_id)
    {
        $visit = Visit::findOrFail($visit_id);

        $request->validate([
            'symptoms' => 'nullable|string',
            'blood_pressure' => 'nullable|string',
            'weight' => 'nullable|string',
            'temperature' => 'nullable|string',
            'notes' => 'nullable|string',
            'advice' => 'nullable|string',
            'next_visit_date' => 'nullable|date',
            'medicines' => 'nullable|array',
            'medicines.*.medicine_name' => 'required|string',
            'medicines.*.dosage' => 'required|string',
            'medicines.*.duration' => 'required|string',
            'medicines.*.instruction' => 'nullable|string',
        ]);

        $visit->update([
            'symptoms' => $request->symptoms,
            'blood_pressure' => $request->blood_pressure,
            'weight' => $request->weight,
            'temperature' => $request->temperature,
            'notes' => $request->notes,
        ]);

        $prescription = Prescription::firstOrCreate(
            ['visit_id' => $visit->id],
            [
                'prescription_id' => 'RX-' . $visit->visit_id . '-' . rand(100, 999),
                'patient_id' => $visit->patient_id,
                'doctor_id' => $visit->doctor_id,
            ]
        );

        $prescription->update([
            'advice' => $request->advice,
            'next_visit_date' => $request->next_visit_date,
        ]);

        // Delete old items and insert new ones
        $prescription->items()->delete();

        if ($request->has('medicines') && count($request->medicines) > 0) {
            $items = [];
            foreach ($request->medicines as $med) {
                $items[] = new PrescriptionItem([
                    'medicine_name' => $med['medicine_name'],
                    'dosage' => $med['dosage'],
                    'duration' => $med['duration'],
                    'instruction' => $med['instruction'] ?? null,
                ]);
            }
            $prescription->items()->saveMany($items);
        }

        return redirect()->route('consultations.show', $visit->id)
            ->with('success', 'Prescription saved successfully!');
    }
}
