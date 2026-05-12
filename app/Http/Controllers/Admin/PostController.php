<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::query()->orderByDesc('created_at');
        if ($request->filled('status')) {
            $query->where('status', $request->string('status'));
        }
        if ($request->filled('q')) {
            $q = $request->string('q');
            $query->where(function ($sub) use ($q) {
                $sub->where('title', 'like', "%{$q}%")
                    ->orWhere('excerpt', 'like', "%{$q}%");
            });
        }
        $posts = $query->paginate(20)->withQueryString();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Determine the scheduled_at and published_at dates based on status and input
     * Returns array with both values
     * 
     * CUSTOM APPROACH: Storing in app timezone (Asia/Kolkata) instead of UTC
     * This requires special handling in queries
     */
    private function determinePublishDates(array $validated, ?Post $post = null): array
    {
        $scheduledAt = null;
        $publishedAt = null;

        // If user provided a date, treat it as being in the application timezone
        if (!empty($validated['published_at'])) {
            $appTimezone = app_timezone(); // Get from database settings
            $datetime = \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $validated['published_at'], $appTimezone);
            
            // Store in app timezone (from database settings)
            $datetimeInAppTz = $datetime->format('Y-m-d H:i:s');
            if ($validated['status'] === 'scheduled') {
                // For scheduled posts, store in scheduled_at, published_at stays null
                $scheduledAt = $datetimeInAppTz;
                $publishedAt = $post ? $post->published_at : null;
            } else {
                // For published posts, store in published_at
                $publishedAt = $datetimeInAppTz;
                $scheduledAt = null;
            }
        } else {
            // No date provided
            if ($validated['status'] === 'published') {
                // Set to now in app timezone (from database settings)
                $publishedAt = $post && $post->published_at ? $post->published_at : current_time_in_app_timezone();
            } else {
                // Keep existing values
                $publishedAt = $post ? $post->published_at : null;
                $scheduledAt = $post ? $post->scheduled_at : null;
            }
        }

        return [
            'scheduled_at' => $scheduledAt,
            'published_at' => $publishedAt,
        ];
    }

    public function create()
    {
        $post = new Post();
        return view('admin.posts.create', compact('post'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|max:4096',
            'status' => 'required|in:draft,published,scheduled,archived',
            'published_at' => 'nullable|string', // Changed from 'date' to 'string' to accept datetime-local format
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
            'canonical_url' => 'nullable|url|max:255',
            'schema_markup' => 'nullable|string',
        ]);

        // Validate scheduled posts have a publish date
        if ($validated['status'] === 'scheduled' && empty($validated['published_at'])) {
            return back()->withErrors(['published_at' => 'Publish date is required for scheduled posts.'])->withInput();
        }

        $slugInput = $validated['slug'] ?? null;
        $slug = $slugInput ? Post::generateUniqueSlug($slugInput) : Post::generateUniqueSlug($validated['title']);

        $path = null;
        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('posts', 'public');
        }

        $publishDates = $this->determinePublishDates($validated);

        $post = Post::create([
            'author_id' => Auth::id(),
            'title' => $validated['title'],
            'slug' => $slug,
            'excerpt' => $validated['excerpt'] ?? null,
            'content' => $validated['content'],
            'featured_image' => $path,
            'status' => $validated['status'],
            'scheduled_at' => $publishDates['scheduled_at'],
            'published_at' => $publishDates['published_at'],
            'meta_title' => $validated['meta_title'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,
            'meta_keywords' => $validated['meta_keywords'] ?? null,
            'canonical_url' => $validated['canonical_url'] ?? null,
            'schema_markup' => $validated['schema_markup'] ?? null,
        ]);

        return redirect()->route('admin.posts.edit', $post)->with('status', 'Post created.');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|max:4096',
            'remove_featured_image' => 'nullable|boolean',
            'status' => 'required|in:draft,published,scheduled,archived',
            'published_at' => 'nullable|string', // Changed from 'date' to 'string' to accept datetime-local format
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
            'canonical_url' => 'nullable|url|max:255',
            'schema_markup' => 'nullable|string',
        ]);

        // Validate scheduled posts have a publish date
        if ($validated['status'] === 'scheduled' && empty($validated['published_at'])) {
            return back()->withErrors(['published_at' => 'Publish date is required for scheduled posts.'])->withInput();
        }

        $slugInput = $validated['slug'] ?? null;
        $slug = $slugInput ? Post::generateUniqueSlug($slugInput, $post->id) : Post::generateUniqueSlug($validated['title'], $post->id);

        $path = $post->featured_image;
        if ($request->boolean('remove_featured_image') && $path) {
            Storage::disk('public')->delete($path);
            $path = null;
        }
        if ($request->hasFile('featured_image')) {
            if ($path) { Storage::disk('public')->delete($path); }
            $path = $request->file('featured_image')->store('posts', 'public');
        }

        $publishDates = $this->determinePublishDates($validated, $post);

        $post->update([
            'title' => $validated['title'],
            'slug' => $slug,
            'excerpt' => $validated['excerpt'] ?? null,
            'content' => $validated['content'],
            'featured_image' => $path,
            'status' => $validated['status'],
            'scheduled_at' => $publishDates['scheduled_at'],
            'published_at' => $publishDates['published_at'],
            'meta_title' => $validated['meta_title'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,
            'meta_keywords' => $validated['meta_keywords'] ?? null,
            'canonical_url' => $validated['canonical_url'] ?? null,
            'schema_markup' => $validated['schema_markup'] ?? null,
        ]);

        return back()->with('status', 'Post updated.');
    }

    public function duplicate(Post $post)
    {
        $newPost = $post->replicate();
        $newPost->title = $post->title . ' (Copy)';
        $newPost->slug = Post::generateUniqueSlug($post->slug . '-copy');
        $newPost->status = 'draft';
        $newPost->scheduled_at = null;
        $newPost->published_at = null;
        $newPost->save();

        return redirect()->route('admin.posts.edit', $newPost)->with('status', 'Post duplicated.');
    }

    public function destroy(Post $post)
    {
        if ($post->featured_image) {
            Storage::disk('public')->delete($post->featured_image);
        }
        $post->delete();
        return redirect()->route('admin.posts.index')->with('status', 'Post deleted.');
    }
}


