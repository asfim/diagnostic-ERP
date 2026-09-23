<?php

namespace App\Http\Controllers;

use App\Http\Requests\PackageRequest;
use App\Models\Test;
use App\Models\TestPackage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PackageController extends Controller
{
    public function index(): View
    {
        $packages = TestPackage::withCount('tests')->orderBy('sort_order')->latest()->paginate(10);

        return view('admin-packages.index', compact('packages'));
    }

    public function create(): View
    {
        $tests = Test::where('status', true)->orderBy('name')->get();

        return view('admin-packages.create', compact('tests'));
    }

    public function store(PackageRequest $request): RedirectResponse
    {
        $data = $request->validated();
        unset($data['image'], $data['remove_image'], $data['tests']);
        $data['slug'] = $this->uniqueSlug($data['name']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('packages', 'public');
        }

        $package = TestPackage::create($data);
        $package->tests()->sync($request->input('tests', []));

        return redirect()->route('admin-packages.index')->with('success', 'Package added successfully!');
    }

    public function edit(TestPackage $admin_package): View
    {
        $tests = Test::where('status', true)->orderBy('name')->get();
        $selectedTests = $admin_package->tests()->pluck('tests.id')->all();
        $package = $admin_package;

        return view('admin-packages.edit', compact('package', 'tests', 'selectedTests'));
    }

    public function update(PackageRequest $request, TestPackage $admin_package): RedirectResponse
    {
        $data = $request->validated();
        unset($data['image'], $data['remove_image'], $data['tests']);
        $data['slug'] = $this->uniqueSlug($data['name'], $admin_package->id);

        if ($request->hasFile('image')) {
            $this->deleteImage($admin_package);
            $data['image'] = $request->file('image')->store('packages', 'public');
        } elseif ($request->boolean('remove_image')) {
            $this->deleteImage($admin_package);
            $data['image'] = null;
        }

        $admin_package->update($data);
        $admin_package->tests()->sync($request->input('tests', []));

        return redirect()->route('admin-packages.index')->with('success', 'Package updated successfully!');
    }

    public function destroy(TestPackage $admin_package): RedirectResponse
    {
        $this->deleteImage($admin_package);
        $admin_package->delete();

        return redirect()->route('admin-packages.index')->with('success', 'Package deleted successfully!');
    }

    private function uniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $slug = Str::slug($name);
        $query = TestPackage::where('slug', $slug);
        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        return $query->exists() ? $slug . '-' . Str::lower(Str::random(5)) : $slug;
    }

    private function deleteImage(TestPackage $package): void
    {
        if ($package->image) {
            Storage::disk('public')->delete($package->image);
        }
    }
}
