<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class BranchController extends Controller
{
    public function index(): View
    {
        $branches = Branch::orderBy('sort_order', 'asc')->orderBy('id', 'asc')->get();
        return view('admin.branches.index', compact('branches'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'address' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:100'],
            'badge' => ['nullable', 'string', 'max:50'],
            'opening_hours' => ['nullable', 'string', 'max:100'],
            'map_link' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:3072'],
            'status' => ['nullable', 'boolean'],
            'is_upcoming' => ['nullable', 'boolean'],
        ]);

        $data = $validated;
        $data['status'] = $request->has('status');
        $data['is_upcoming'] = $request->has('is_upcoming');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('branches', 'public');
        }

        Branch::create($data);

        return redirect()->route('branches.index')->with('success', 'Branch created successfully!');
    }

    public function update(Request $request, Branch $branch): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'address' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:100'],
            'badge' => ['nullable', 'string', 'max:50'],
            'opening_hours' => ['nullable', 'string', 'max:100'],
            'map_link' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:3072'],
            'status' => ['nullable', 'boolean'],
            'is_upcoming' => ['nullable', 'boolean'],
        ]);

        $data = $validated;
        $data['status'] = $request->has('status');
        $data['is_upcoming'] = $request->has('is_upcoming');

        if ($request->hasFile('image')) {
            if ($branch->image && Storage::disk('public')->exists($branch->image)) {
                Storage::disk('public')->delete($branch->image);
            }
            $data['image'] = $request->file('image')->store('branches', 'public');
        }

        $branch->update($data);

        return redirect()->route('branches.index')->with('success', 'Branch updated successfully!');
    }

    public function destroy(Branch $branch): RedirectResponse
    {
        if ($branch->image && Storage::disk('public')->exists($branch->image)) {
            Storage::disk('public')->delete($branch->image);
        }

        $branch->delete();

        return redirect()->route('branches.index')->with('success', 'Branch deleted successfully!');
    }
}
