<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\DiagnosticOrder;
use App\Models\Patient;
use App\Models\Doctor;

class ReportController extends Controller
{
    public function account(Request $request)
    {
        $startDate = $request->input('start_date', date('Y-m-01'));
        $endDate = $request->input('end_date', date('Y-m-t'));
        
        $invoices = Invoice::whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])->get();
        $labOrders = DiagnosticOrder::whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])->get();
        
        $totalIncome = $invoices->sum('paid') + $labOrders->sum('paid_amount');
        
        return view('reports.account', compact('startDate', 'endDate', 'invoices', 'labOrders', 'totalIncome'));
    }

    public function patient(Request $request)
    {
        $startDate = $request->input('start_date', date('Y-m-01'));
        $endDate = $request->input('end_date', date('Y-m-t'));
        
        $patients = Patient::whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])->get();
        
        $maleCount = $patients->where('gender', 'Male')->count();
        $femaleCount = $patients->where('gender', 'Female')->count();
        
        return view('reports.patient', compact('startDate', 'endDate', 'patients', 'maleCount', 'femaleCount'));
    }

    public function doctor(Request $request)
    {
        $startDate = $request->input('start_date', date('Y-m-01'));
        $endDate = $request->input('end_date', date('Y-m-t'));
        
        // Count appointments per doctor
        $doctors = Doctor::withCount(['appointments' => function($q) use ($startDate, $endDate) {
            $q->whereBetween('date', [$startDate, $endDate]);
        }])->get();
        
        return view('reports.doctor', compact('startDate', 'endDate', 'doctors'));
    }

    public function labOrder(Request $request)
    {
        $startDate = $request->input('start_date', date('Y-m-01'));
        $endDate = $request->input('end_date', date('Y-m-t'));
        
        $orders = DiagnosticOrder::with('items.test')
            ->whereBetween('order_date', [$startDate, $endDate])
            ->get();
            
        // Process which tests are popular
        $testCounts = [];
        foreach ($orders as $order) {
            foreach ($order->items as $item) {
                if ($item->test) {
                    $name = $item->test->name;
                    if (!isset($testCounts[$name])) {
                        $testCounts[$name] = 0;
                    }
                    $testCounts[$name]++;
                }
            }
        }
        
        arsort($testCounts);
        
        return view('reports.lab_order', compact('startDate', 'endDate', 'orders', 'testCounts'));
    }
}
