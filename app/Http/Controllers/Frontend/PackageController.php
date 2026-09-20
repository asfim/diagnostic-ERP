<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\TestPackage;
use App\Models\Department;
use App\Models\Doctor;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $packages = TestPackage::where('status', 'active')
                               ->orderBy('sort_order')
                               ->get();

        return view('frontend.packages.index', compact('packages'));
    }

    public function show($id)
    {
        $package  = TestPackage::with('tests.department')->findOrFail($id);
        $related  = TestPackage::where('id', '!=', $id)
                               ->where('status', 'active')
                               ->limit(3)->get();

        return view('frontend.packages.show', compact('package', 'related'));
    }
}
