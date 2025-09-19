<?php

namespace App\Http\Controllers;

use App\Models\Post;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::where('status', 'published')->paginate(9);
        return view('blog.index', compact('posts'));
    }

    public function show(string $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $post->increment('views');
        return view('blog.show', compact('post'));
    }
}


