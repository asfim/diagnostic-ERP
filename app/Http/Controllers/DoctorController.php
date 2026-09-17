<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::latest()->paginate(10);
        return view('doctors.index', compact('doctors'));
    }

    public function create()
    {
        return view('doctors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'             => 'required|string|max:255',
            'specialization'   => 'required|string|max:255',
            'mobile'           => 'required|string|max:20',
            'email'            => 'nullable|email',
            'consultation_fee' => 'required|numeric|min:0',
            'create_account'   => 'nullable',
            'login_email'      => 'nullable|email|unique:users,email|required_if:create_account,1',
            'password'         => 'nullable|string|min:8|required_if:create_account,1',
        ]);
        
        $userId = null;

        // If requested, create a user login account for the doctor
        if ($request->filled('create_account') && $request->filled('login_email')) {
            $user = \App\Models\User::create([
                'name'     => $validated['name'],
                'email'    => $validated['login_email'],
                'password' => \Illuminate\Support\Facades\Hash::make($validated['password']),
            ]);

            // Assign Doctor role (must exist in roles table)
            if (\Spatie\Permission\Models\Role::where('name', 'Doctor')->exists()) {
                $user->assignRole('Doctor');
            }

            $userId = $user->id;
        }

        // Auto-generate Doctor ID: DR-XXXX
        $lastDoc = Doctor::latest('id')->first();
        $nextId  = $lastDoc ? $lastDoc->id + 1 : 1;

        Doctor::create([
            'doctor_id'        => 'DR-' . str_pad($nextId, 4, '0', STR_PAD_LEFT),
            'user_id'          => $userId,
            'name'             => $validated['name'],
            'specialization'   => $validated['specialization'],
            'mobile'           => $validated['mobile'],
            'email'            => $validated['email'] ?? null,
            'consultation_fee' => $validated['consultation_fee'],
        ]);

        return redirect()->route('doctors.index')->with('success', 'Doctor added successfully!');
    }

    public function show(Doctor $doctor)
    {
        return view('doctors.show', compact('doctor'));
    }

    public function edit(Doctor $doctor)
    {
        return view('doctors.edit', compact('doctor'));
    }

    public function update(Request $request, Doctor $doctor)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'specialization' => 'required|string|max:255',
            'mobile' => 'required|string|max:20',
            'email' => 'nullable|email',
            'consultation_fee' => 'required|numeric|min:0',
        ]);
        
        $doctor->update($data);
        return redirect()->route('doctors.index')->with('success', 'Doctor updated successfully!');
    }

    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
        return redirect()->route('doctors.index')->with('success', 'Doctor removed.');
    }
}
