<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use App\Models\Area;

class CleanupAreas extends Command
{
    protected $signature = 'areas:cleanup';
    protected $description = 'Delete all areas and their related files';

    public function handle()
    {
        if ($this->confirm('This will delete ALL areas and their related files. Are you sure?')) {
            $this->info('Starting cleanup process...');

            try {
                // Delete all areas from database
                $count = Area::count();
                Area::truncate();
                $this->info("Deleted {$count} areas from database");

                // Delete all thumbnail files
                $thumbnailPath = 'areas/thumbnails';
                if (Storage::disk('public')->exists($thumbnailPath)) {
                    $files = Storage::disk('public')->files($thumbnailPath);
                    Storage::disk('public')->delete($files);
                    $this->info("Deleted " . count($files) . " thumbnail files");
                }

                // Delete all banner files
                $bannerPath = 'areas/banners';
                if (Storage::disk('public')->exists($bannerPath)) {
                    $files = Storage::disk('public')->files($bannerPath);
                    Storage::disk('public')->delete($files);
                    $this->info("Deleted " . count($files) . " banner files");
                }

                $this->info('Cleanup completed successfully!');
            } catch (\Exception $e) {
                $this->error('An error occurred during cleanup:');
                $this->error($e->getMessage());
                $this->error($e->getTraceAsString());
            }
        } else {
            $this->info('Cleanup cancelled.');
        }
    }
} 