<?php

namespace App\Http\Controllers;

use App\Models\Post;

class BlogController extends Controller
{
    public function index()
    {
        // Show only published posts with published_at set
        $posts = Post::where('status', 'published')
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->paginate(9);
        return view('blog.index', compact('posts'));
    }

    public function show(string $slug)
    {
        // Show only published posts with published_at set
        $post = Post::where('slug', $slug)
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->firstOrFail();
        $post->increment('views');
        $faqs = $post->faqs()->orderBy('sort_order')->get();
        return view('blog.show', compact('post', 'faqs'));
    }
}


