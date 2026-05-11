# Scheduled Posts Setup

This document explains how scheduled posts work in the application.

## Overview

The scheduled posts feature allows you to create blog posts that will be automatically published at a future date and time. The system uses two separate fields to handle scheduling:

- **`scheduled_at`**: Stores the intended publish time (when status is 'scheduled')
- **`published_at`**: Stores the actual publication timestamp (set when post is published)

This separation ensures proper timezone handling and prevents scheduled posts from appearing prematurely.

## How It Works

### 1. Creating a Scheduled Post

When you create a post with status "scheduled":
- The datetime you enter is treated as being in your application's timezone (configured in `config/app.php`)
- This datetime is converted to UTC and stored in the `scheduled_at` field
- The `published_at` field remains `null` until the post is actually published
- The post will NOT appear on the public blog until it's published

### 2. Publishing Scheduled Posts

A scheduled post is automatically published when:
- Its `scheduled_at` time has passed (compared in UTC)
- The `posts:publish-scheduled` command runs

When published:
- Status changes from 'scheduled' to 'published'
- `published_at` is set to the current timestamp
- `scheduled_at` is cleared (set to null)

### 3. Timezone Handling

**Important**: All datetime comparisons happen in UTC to ensure consistency.

- User input: Application timezone (e.g., Asia/Kolkata)
- Database storage: UTC
- Display: Application timezone

Example:
- You schedule a post for "2026-05-12 14:00" in Asia/Kolkata timezone
- System converts and stores as "2026-05-12 08:30:00" UTC in `scheduled_at`
- When UTC time reaches 08:30:00, the post is published
- `published_at` is set to the actual publish time in UTC

## Automation Setup

### Cron Job (Recommended for Production)

Add this to your crontab to check every minute:

```bash
* * * * * cd /path/to/your/project && php artisan posts:publish-scheduled >> /dev/null 2>&1
```

Or use Laravel's scheduler by adding to `routes/console.php`:

```php
Schedule::command('posts:publish-scheduled')->everyMinute();
```

Then add this single cron entry:

```bash
* * * * * cd /path/to/your/project && php artisan schedule:run >> /dev/null 2>&1
```

### Manual Testing

Test the command manually:

```bash
php artisan posts:publish-scheduled
```

## Database Schema

The `posts` table includes:

```php
$table->string('status')->default('draft'); // draft, published, scheduled, archived
$table->timestamp('scheduled_at')->nullable()->index(); // When to publish (for scheduled posts)
$table->timestamp('published_at')->nullable()->index(); // When actually published
```

## Querying Posts

### Frontend (Public Blog)

Only show published posts:

```php
Post::where('status', 'published')
    ->whereNotNull('published_at')
    ->where('published_at', '<=', now())
    ->get();
```

Or use the scope:

```php
Post::published()->get();
```

### Admin Panel

Show scheduled posts with their schedule time:

```php
Post::where('status', 'scheduled')
    ->whereNotNull('scheduled_at')
    ->get();
```

## Troubleshooting

### Scheduled posts not publishing

1. **Check the cron job is running**:
   ```bash
   grep CRON /var/log/syslog
   ```

2. **Run the command manually**:
   ```bash
   php artisan posts:publish-scheduled
   ```

3. **Check timezone configuration**:
   - Verify `config/app.php` has correct timezone
   - Ensure database stores times in UTC

4. **Verify scheduled_at is set**:
   ```bash
   php artisan tinker
   >>> Post::where('status', 'scheduled')->get(['id', 'title', 'scheduled_at', 'published_at']);
   ```

### Posts appearing before scheduled time

This should no longer happen with the `scheduled_at` field. If it does:
- Check that frontend queries use `status = 'published'` (not 'scheduled')
- Verify `published_at` is null for scheduled posts
- Ensure the command hasn't run prematurely

## Migration

If upgrading from the old system, run:

```bash
php artisan migrate
```

This adds the `scheduled_at` column. Existing scheduled posts will need manual adjustment if they have `published_at` set.
