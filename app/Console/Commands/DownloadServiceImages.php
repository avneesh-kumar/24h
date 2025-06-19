<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\Service;

class DownloadServiceImages extends Command
{
    protected $signature = 'services:download-images';
    protected $description = 'Download sample images for services from Freepik';

    private $freepikApiKey = 'FPSX40475ee818f422b38aa308e18d32fa29';

    public function handle()
    {
        $this->info('Starting service image download...');

        // Test API connection
        try {
            $response = Http::withHeaders([
                'X-Freepik-API-Key' => $this->freepikApiKey
            ])->get('https://api.freepik.com/v1/resources', [
                'term' => 'security guard',
                'limit' => 1,
                'page' => 1,
                'format' => 'json',
                'language' => 'en',
                'filter[content_type]' => 'photo',
                'filter[orientation]' => 'landscape',
                'filter[size]' => 'large'
            ]);

            if ($response->successful()) {
                $this->info('Freepik API connection successful!');
            } else {
                $this->error('Freepik API connection failed!');
                $this->error('Status: ' . $response->status());
                $this->error('Response: ' . $response->body());
                return;
            }
        } catch (\Exception $e) {
            $this->error('Error connecting to Freepik API:');
            $this->error($e->getMessage());
            return;
        }

        // Create directories if they don't exist
        Storage::disk('public')->makeDirectory('services/thumbnails');
        Storage::disk('public')->makeDirectory('services/banners');

        // Define image queries for each service
        $serviceQueries = [
            'Property Management Security' => [
                'thumbnail' => 'security guard building entrance',
                'banner' => 'security guard commercial building'
            ],
            'Industrial Facilities Security' => [
                'thumbnail' => 'security guard factory',
                'banner' => 'industrial security guard warehouse'
            ],
            'Event Security Services' => [
                'thumbnail' => 'event security guard',
                'banner' => 'crowd control security event'
            ],
            'Corporate Security Solutions' => [
                'thumbnail' => 'corporate security guard',
                'banner' => 'office building security guard'
            ],
            'Retail Security Services' => [
                'thumbnail' => 'retail security guard',
                'banner' => 'shopping mall security guard'
            ],
            'Healthcare Facility Security' => [
                'thumbnail' => 'hospital security guard',
                'banner' => 'medical facility security guard'
            ],
            'Educational Institution Security' => [
                'thumbnail' => 'school security guard',
                'banner' => 'campus security guard'
            ],
            'Construction Site Security' => [
                'thumbnail' => 'construction site security guard',
                'banner' => 'building site security guard'
            ],
            'Residential Community Security' => [
                'thumbnail' => 'residential security guard',
                'banner' => 'apartment security guard'
            ],
            'Specialized Security Services' => [
                'thumbnail' => 'professional security guard',
                'banner' => 'elite security guard'
            ],
        ];

        foreach ($serviceQueries as $serviceTitle => $queries) {
            $service = Service::where('title', $serviceTitle)->first();
            if (!$service) {
                $this->warn("Service not found: {$serviceTitle}");
                continue;
            }

            $this->info("Processing {$serviceTitle}...");

            // Download thumbnail
            try {
                $thumbnailUrl = $this->getFreepikImage($queries['thumbnail']);
                if ($thumbnailUrl) {
                    $thumbnailPath = "services/thumbnails/{$service->slug}.jpg";
                    $this->downloadAndResizeImage($thumbnailUrl, $thumbnailPath, 400, 300);
                    $service->update(['thumbnail' => $thumbnailPath]);
                    $this->info("Thumbnail downloaded for {$serviceTitle}");
                }
            } catch (\Exception $e) {
                $this->error("Failed to download thumbnail for {$serviceTitle}: " . $e->getMessage());
            }

            // Download banner
            try {
                $bannerUrl = $this->getFreepikImage($queries['banner']);
                if ($bannerUrl) {
                    $bannerPath = "services/banners/{$service->slug}-banner.jpg";
                    $this->downloadAndResizeImage($bannerUrl, $bannerPath, 1920, 600);
                    $service->update(['banner' => $bannerPath]);
                    $this->info("Banner downloaded for {$serviceTitle}");
                }
            } catch (\Exception $e) {
                $this->error("Failed to download banner for {$serviceTitle}: " . $e->getMessage());
            }

            // Add delay to avoid rate limiting
            sleep(2);
        }

        $this->info('Service image download completed!');
    }

    private function getFreepikImage($query)
    {
        $response = Http::withHeaders([
            'X-Freepik-API-Key' => $this->freepikApiKey
        ])->get('https://api.freepik.com/v1/resources', [
            'term' => $query,
            'limit' => 1,
            'page' => 1,
            'format' => 'json',
            'language' => 'en',
            'filter[content_type]' => 'photo',
            'filter[orientation]' => 'landscape',
            'filter[size]' => 'large'
        ]);

        if ($response->successful()) {
            $data = $response->json();
            if (!empty($data['data'])) {
                return $data['data'][0]['image']['source']['url'];
            }
        }

        return null;
    }

    private function downloadAndResizeImage($url, $path, $width, $height)
    {
        $response = Http::get($url);
        if (!$response->successful()) {
            throw new \Exception("Failed to download image: " . $response->status());
        }

        $image = imagecreatefromstring($response->body());
        if (!$image) {
            throw new \Exception("Failed to create image from response");
        }

        $resized = imagecreatetruecolor($width, $height);
        imagecopyresampled($resized, $image, 0, 0, 0, 0, $width, $height, imagesx($image), imagesy($image));

        ob_start();
        imagejpeg($resized, null, 90);
        $resizedImage = ob_get_clean();

        Storage::disk('public')->put($path, $resizedImage);

        imagedestroy($image);
        imagedestroy($resized);
    }
} 