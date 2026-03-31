<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Post;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::with('posts')->orderBy('sort_order')->orderByDesc('id')->paginate(20);
        return view('admin.faqs.index', compact('faqs'));
    }

    public function create()
    {
        $posts = Post::orderBy('title')->get(['id', 'title']);
        return view('admin.faqs.create', compact('posts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'faqs'               => 'required|array|min:1',
            'faqs.*.question'    => 'required|string|max:500',
            'faqs.*.answer'      => 'required|string',
            'faqs.*.sort_order'  => 'nullable|integer|min:0',
            'post_ids'           => 'nullable|array',
            'post_ids.*'         => 'exists:posts,id',
        ]);

        $postIds = $validated['post_ids'] ?? [];

        foreach ($validated['faqs'] as $entry) {
            $faq = Faq::create([
                'question'   => $entry['question'],
                'answer'     => $entry['answer'],
                'sort_order' => $entry['sort_order'] ?? 0,
            ]);
            $faq->posts()->sync($postIds);
        }

        $count = count($validated['faqs']);
        return redirect()->route('admin.faqs.index')->with('status', $count === 1 ? 'FAQ created.' : "{$count} FAQs created.");
    }

    public function edit(Faq $faq)
    {
        $posts = Post::orderBy('title')->get(['id', 'title']);
        $selectedPostIds = $faq->posts()->pluck('posts.id')->toArray();
        return view('admin.faqs.edit', compact('faq', 'posts', 'selectedPostIds'));
    }

    public function update(Request $request, Faq $faq)
    {
        $validated = $request->validate([
            'question'   => 'required|string|max:500',
            'answer'     => 'required|string',
            'sort_order' => 'nullable|integer|min:0',
            'post_ids'   => 'nullable|array',
            'post_ids.*' => 'exists:posts,id',
        ]);

        $faq->update([
            'question'   => $validated['question'],
            'answer'     => $validated['answer'],
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        $faq->posts()->sync($validated['post_ids'] ?? []);

        return back()->with('status', 'FAQ updated.');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('admin.faqs.index')->with('status', 'FAQ deleted.');
    }
}
