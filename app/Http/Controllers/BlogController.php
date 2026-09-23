<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(): View
    {
        $blogs = Blog::latest('published_at')->latest()->paginate(10);

        return view('blogs.index', compact('blogs'));
    }

    public function create(): View
    {
        return view('blogs.create');
    }

    public function store(BlogRequest $request): RedirectResponse
    {
        $data = $request->validated();
        unset($data['image'], $data['remove_image']);
        $data['status'] = $request->boolean('status');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('blogs', 'public');
        }

        Blog::create($data);

        return redirect()->route('blogs.index')->with('success', 'Blog added successfully!');
    }

    public function edit(Blog $blog): View
    {
        return view('blogs.edit', compact('blog'));
    }

    public function update(BlogRequest $request, Blog $blog): RedirectResponse
    {
        $data = $request->validated();
        unset($data['image'], $data['remove_image']);
        $data['status'] = $request->boolean('status');

        if ($request->hasFile('image')) {
            $this->deleteImage($blog);
            $data['image'] = $request->file('image')->store('blogs', 'public');
        } elseif ($request->boolean('remove_image')) {
            $this->deleteImage($blog);
            $data['image'] = null;
        }

        $blog->update($data);

        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully!');
    }

    public function destroy(Blog $blog): RedirectResponse
    {
        $this->deleteImage($blog);
        $blog->delete();

        return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully!');
    }

    private function deleteImage(Blog $blog): void
    {
        if ($blog->image) {
            Storage::disk('public')->delete($blog->image);
        }
    }
}
