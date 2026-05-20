<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;

class TestScheduledPosts extends Command
{
    protected $signature = 'posts:test-scheduled';
    protected $description = 'Test and debug scheduled posts';

    public function handle()
    {
        $this->info('=== Scheduled Posts Debug ===');
        
        // Show all scheduled posts
        $scheduled = Post::where('status', 'scheduled')->get();
        $this->info("\nScheduled Posts: " . $scheduled->count());
        foreach ($scheduled as $post) {
            $this->line("- {$post->title}");
            $this->line("  Published At: {$post->published_at}");
            $this->line("  Current Time: " . now());
            $this->line("  Should Publish: " . ($post->published_at <= now() ? 'YES' : 'NO'));
        }

        // Show all published posts
        $published = Post::where('status', 'published')->get();
        $this->info("\nPublished Posts: " . $published->count());
        foreach ($published as $post) {
            $this->line("- {$post->title}");
            $this->line("  Published At: " . ($post->published_at ?? 'NULL'));
        }

        // Try to publish scheduled posts
        $this->info("\n=== Attempting to Publish Scheduled Posts ===");
        $count = Post::where('status', 'scheduled')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->update(['status' => 'published']);
        
        $this->info("Published {$count} post(s).");
        
        return 0;
    }
}
