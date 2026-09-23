<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(): View
    {
        $blogs = Blog::where('status', true)
            ->latest('published_at')
            ->latest()
            ->get();

        return view('frontend.blog', compact('blogs'));
    }

    public function show(Blog $blog): View
    {
        abort_unless($blog->status, 404);

        return view('frontend.blog-show', compact('blog'));
    }
}
