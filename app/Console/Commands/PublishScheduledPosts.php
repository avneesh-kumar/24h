<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;

class PublishScheduledPosts extends Command
{
    protected $signature = 'posts:publish-scheduled';
    protected $description = 'Publish scheduled posts that have reached their publish time';

    public function handle()
    {
        // Compare using app timezone from database settings
        $currentTimeInAppTz = current_time_in_app_timezone();
        
        // Find posts that are scheduled and whose scheduled_at time has passed
        $posts = Post::where('status', 'scheduled')
            ->whereNotNull('scheduled_at')
            ->where('scheduled_at', '<=', $currentTimeInAppTz)
            ->get();

        $count = 0;
        foreach ($posts as $post) {
            $post->update([
                'status' => 'published',
                'published_at' => $currentTimeInAppTz, // Set actual publish time in app timezone
                'scheduled_at' => null, // Clear schedule
            ]);
            $count++;
        }

        $this->info("Published {$count} scheduled post(s).");
        $this->info("Timezone: " . app_timezone());
        return 0;
    }
}
