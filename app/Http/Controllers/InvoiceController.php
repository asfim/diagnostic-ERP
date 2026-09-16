<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Patient;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with('patient')->latest()->paginate(10);
        return view('invoices.index', compact('invoices'));
    }

    public function create()
    {
        $patients = Patient::all();
        return view('invoices.create', compact('patients'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'date' => 'required|date',
            'subtotal' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'paid' => 'required|numeric|min:0',
            'payment_method' => 'nullable|string',
        ]);
        
        $data['total'] = $data['subtotal'] - ($data['discount'] ?? 0);
        $data['due'] = $data['total'] - $data['paid'];
        
        if ($data['due'] <= 0) {
            $data['payment_status'] = 'Paid';
        } elseif ($data['paid'] > 0) {
            $data['payment_status'] = 'Partial';
        } else {
            $data['payment_status'] = 'Unpaid';
        }
        
        $lastInv = Invoice::latest('id')->first();
        $nextId = $lastInv ? $lastInv->id + 1 : 1;
        $data['invoice_no'] = 'INV-' . date('ymd') . '-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);
        
        Invoice::create($data);

        return redirect()->route('invoices.index')->with('success', 'Invoice generated successfully!');
    }

    public function show(Invoice $invoice)
    {
        return view('invoices.show', compact('invoice'));
    }

    public function edit(Invoice $invoice)
    {
        // Typically invoices shouldn't be fully edited, but we'll allow it for now.
        $patients = Patient::all();
        return view('invoices.edit', compact('invoice', 'patients'));
    }

    public function update(Request $request, Invoice $invoice)
    {
        // Basic update logic
        $data = $request->validate([
            'paid' => 'required|numeric|min:0',
        ]);
        
        $data['due'] = $invoice->total - $data['paid'];
        if ($data['due'] <= 0) $data['payment_status'] = 'Paid';
        elseif ($data['paid'] > 0) $data['payment_status'] = 'Partial';
        else $data['payment_status'] = 'Unpaid';
        
        $invoice->update($data);
        return redirect()->route('invoices.index')->with('success', 'Invoice updated successfully!');
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->route('invoices.index')->with('success', 'Invoice deleted.');
    }
}
