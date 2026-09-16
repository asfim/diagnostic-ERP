<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class StaffController extends Controller
{
    public function __construct()
    {
        // Add middleware for basic security check
        // $this->middleware('permission:manage staff');
    }

    public function index()
    {
        $staffs = Staff::with('user.roles')->get();
        return view('staff.index', compact('staffs'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('staff.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'designation' => 'required|string',
            'phone' => 'nullable|string',
            'role' => 'required|exists:roles,name',
        ]);
        
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        
        $user->assignRole($data['role']);
        
        Staff::create([
            'user_id' => $user->id,
            'name' => $data['name'],
            'designation' => $data['designation'],
            'phone' => $data['phone'],
            'status' => 'Active',
        ]);

        return redirect()->route('staff.index')->with('success', 'Staff created successfully!');
    }
}
