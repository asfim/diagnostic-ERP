<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\View\View;

class BranchController extends Controller
{
    public function index(): View
    {
        $activeBranches = Branch::where('status', true)
            ->where('is_upcoming', false)
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'asc')
            ->get();

        $upcomingBranches = Branch::where('status', true)
            ->where('is_upcoming', true)
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'asc')
            ->get();

        return view('frontend.branches', compact('activeBranches', 'upcomingBranches'));
    }
}
