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
        $all = Faq::with('posts')->orderBy('group_name')->orderBy('sort_order')->orderByDesc('id')->get();
        $grouped = $all->groupBy(fn($f) => $f->group_name ?: '');
        return view('admin.faqs.index', compact('grouped'));
    }

    public function editGroup(string $group)
    {
        $groupName = $group === '__ungrouped__' ? null : $group;
        $faqs = Faq::with('posts')
            ->where('group_name', $groupName)
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->get();

        if ($faqs->isEmpty()) {
            return redirect()->route('admin.faqs.index')->with('status', 'Group not found.');
        }

        $posts = Post::orderBy('title')->get(['id', 'title']);
        // All FAQs in a group share the same post mapping — use first FAQ's posts as default
        $selectedPostIds = $faqs->first()->posts()->pluck('posts.id')->toArray();

        return view('admin.faqs.edit-group', compact('faqs', 'groupName', 'group', 'posts', 'selectedPostIds'));
    }

    public function updateGroup(Request $request, string $group)
    {
        $validated = $request->validate([
            'group_name'         => 'nullable|string|max:200',
            'faqs'               => 'required|array|min:1',
            'faqs.*.id'          => 'required|exists:faqs,id',
            'faqs.*.question'    => 'required|string|max:500',
            'faqs.*.answer'      => 'required|string',
            'faqs.*.sort_order'  => 'nullable|integer|min:0',
            'post_ids'           => 'nullable|array',
            'post_ids.*'         => 'exists:posts,id',
        ]);

        $newGroupName = $validated['group_name'] ?? null;
        $postIds      = $validated['post_ids'] ?? [];

        foreach ($validated['faqs'] as $entry) {
            $faq = Faq::find($entry['id']);
            $faq->update([
                'question'   => $entry['question'],
                'answer'     => $entry['answer'],
                'sort_order' => $entry['sort_order'] ?? 0,
                'group_name' => $newGroupName,
            ]);
            $faq->posts()->sync($postIds);
        }

        return redirect()->route('admin.faqs.index')->with('status', 'Group updated.');
    }

    public function destroyGroup(string $group)
    {
        $groupName = $group === '__ungrouped__' ? null : $group;
        Faq::where('group_name', $groupName)->delete();
        return redirect()->route('admin.faqs.index')->with('status', 'Group deleted.');
    }

    public function create()
    {
        $posts = Post::orderBy('title')->get(['id', 'title']);
        return view('admin.faqs.create', compact('posts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'group_name'         => 'nullable|string|max:200',
            'faqs'               => 'required|array|min:1',
            'faqs.*.question'    => 'required|string|max:500',
            'faqs.*.answer'      => 'required|string',
            'faqs.*.sort_order'  => 'nullable|integer|min:0',
            'post_ids'           => 'nullable|array',
            'post_ids.*'         => 'exists:posts,id',
        ]);

        $postIds   = $validated['post_ids'] ?? [];
        $groupName = $validated['group_name'] ?? null;

        foreach ($validated['faqs'] as $entry) {
            $faq = Faq::create([
                'question'   => $entry['question'],
                'answer'     => $entry['answer'],
                'sort_order' => $entry['sort_order'] ?? 0,
                'group_name' => $groupName,
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
            'group_name' => 'nullable|string|max:200',
            'post_ids'   => 'nullable|array',
            'post_ids.*' => 'exists:posts,id',
        ]);

        $faq->update([
            'question'   => $validated['question'],
            'answer'     => $validated['answer'],
            'sort_order' => $validated['sort_order'] ?? 0,
            'group_name' => $validated['group_name'] ?? null,
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
