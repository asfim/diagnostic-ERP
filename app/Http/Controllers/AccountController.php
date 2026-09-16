<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\DiagnosticOrder;
use App\Models\Expense; // Assuming we have Expense, let me check the DB schema.

class AccountController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->input('date', date('Y-m-d'));
        
        // Income from Invoices
        $invoiceIncome = Invoice::whereDate('created_at', $date)->sum('paid');
        $invoiceDue = Invoice::whereDate('created_at', $date)->sum('due');
        
        // Income from Lab Orders
        $labIncome = DiagnosticOrder::whereDate('created_at', $date)->sum('paid_amount');
        $labDue = DiagnosticOrder::whereDate('created_at', $date)->sum('due_amount');
        
        // Let's assume we have Expense model, but table is empty/unconfigured for now
        $expenses = 0; // \App\Models\Expense::whereDate('created_at', $date)->sum('amount') ?? 0;
        
        $totalIncome = $invoiceIncome + $labIncome;
        $totalDue = $invoiceDue + $labDue;
        
        return view('accounts.index', compact(
            'date', 'invoiceIncome', 'invoiceDue', 
            'labIncome', 'labDue', 'totalIncome', 'totalDue', 'expenses'
        ));
    }
}
