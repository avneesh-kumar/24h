<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class DownloadAreaImages extends Command
{
    protected $signature = 'areas:download-images';
    protected $description = 'Download sample images for areas';

    private $freepikApiKey = 'FPSX40475ee818f422b38aa308e18d32fa29';

    public function handle()
    {
        $this->info('Downloading area images...');

        // Create directories if they don't exist
        Storage::disk('public')->makeDirectory('areas/thumbnails');
        Storage::disk('public')->makeDirectory('areas/banners');

        // Test API connection first
        $this->info('Testing Freepik API connection...');
        $testResponse = Http::withHeaders([
            'X-Freepik-API-Key' => $this->freepikApiKey
        ])->get('https://api.freepik.com/v1/resources', [
            'limit' => 1,
            'filters[content_type][photo]' => 1,
            'filters[orientation][landscape]' => 1
        ]);

        if (!$testResponse->successful()) {
            $this->error('Freepik API connection failed!');
            $this->error('Status Code: ' . $testResponse->status());
            $this->error('Response: ' . $testResponse->body());
            return;
        }

        $this->info('Freepik API connection successful!');

        // Area-specific image queries for Freepik
        $areaImages = [
            'los-angeles' => [
                'thumbnail' => 'los angeles city skyline',
                'banner' => 'los angeles downtown night cityscape',
            ],
            'san-francisco' => [
                'thumbnail' => 'san francisco golden gate bridge',
                'banner' => 'san francisco bay area panorama',
            ],
            'new-york' => [
                'thumbnail' => 'new york city skyline',
                'banner' => 'new york times square night',
            ],
            'chicago' => [
                'thumbnail' => 'chicago downtown architecture',
                'banner' => 'chicago lakefront skyline',
            ],
            'miami' => [
                'thumbnail' => 'miami beach palm trees',
                'banner' => 'miami south beach sunset',
            ],
            'las-vegas' => [
                'thumbnail' => 'las vegas strip night',
                'banner' => 'las vegas casino lights',
            ],
            'seattle' => [
                'thumbnail' => 'seattle space needle',
                'banner' => 'seattle waterfront panorama',
            ],
            'boston' => [
                'thumbnail' => 'boston harbor waterfront',
                'banner' => 'boston downtown historic',
            ],
            'austin' => [
                'thumbnail' => 'austin texas capitol',
                'banner' => 'austin downtown night',
            ],
            'denver' => [
                'thumbnail' => 'denver rocky mountains',
                'banner' => 'denver city skyline',
            ],
            'san-diego' => [
                'thumbnail' => 'san diego beach sunset',
                'banner' => 'san diego downtown cityscape',
            ],
            'san-jose' => [
                'thumbnail' => 'san jose tech campus modern',
                'banner' => 'san jose city view',
            ],
            'sacramento' => [
                'thumbnail' => 'sacramento capitol building',
                'banner' => 'sacramento riverfront city',
            ],
            'fresno' => [
                'thumbnail' => 'fresno agriculture fields',
                'banner' => 'fresno downtown city',
            ],
            'long-beach' => [
                'thumbnail' => 'long beach harbor port',
                'banner' => 'long beach waterfront city',
            ],
            'oakland' => [
                'thumbnail' => 'oakland port shipping',
                'banner' => 'oakland city skyline',
            ],
            'anaheim' => [
                'thumbnail' => 'anaheim disneyland castle',
                'banner' => 'anaheim convention center modern',
            ],
            'santa-ana' => [
                'thumbnail' => 'santa ana downtown city',
                'banner' => 'santa ana city hall modern',
            ],
            'riverside' => [
                'thumbnail' => 'riverside mission historical',
                'banner' => 'riverside downtown city',
            ],
            'bakersfield' => [
                'thumbnail' => 'bakersfield oil fields landscape',
                'banner' => 'bakersfield city view',
            ],
            'stockton' => [
                'thumbnail' => 'stockton waterfront port',
                'banner' => 'stockton downtown city',
            ],
            'irvine' => [
                'thumbnail' => 'irvine business district modern',
                'banner' => 'irvine spectrum center',
            ],
            'chula-vista' => [
                'thumbnail' => 'chula vista bayfront harbor',
                'banner' => 'chula vista downtown city',
            ],
            'fremont' => [
                'thumbnail' => 'fremont tech campus modern',
                'banner' => 'fremont central park city',
            ],
            'modesto' => [
                'thumbnail' => 'modesto downtown city',
                'banner' => 'modesto city view modern',
            ],
            'oxnard' => [
                'thumbnail' => 'oxnard harbor port',
                'banner' => 'oxnard beach sunset',
            ],
            'fontana' => [
                'thumbnail' => 'fontana speedway racing',
                'banner' => 'fontana downtown city',
            ],
            'moreno-valley' => [
                'thumbnail' => 'moreno valley lake landscape',
                'banner' => 'moreno valley city view',
            ],
            'glendale' => [
                'thumbnail' => 'glendale galleria shopping',
                'banner' => 'glendale downtown city',
            ],
            'huntington-beach' => [
                'thumbnail' => 'huntington beach pier sunset',
                'banner' => 'huntington beach waterfront',
            ],
            'santa-clarita' => [
                'thumbnail' => 'santa clarita valley landscape',
                'banner' => 'santa clarita downtown city',
            ],
            'garden-grove' => [
                'thumbnail' => 'garden grove crystal cathedral',
                'banner' => 'garden grove downtown city',
            ],
            'oceanside' => [
                'thumbnail' => 'oceanside pier beach',
                'banner' => 'oceanside beach sunset',
            ],
            'rancho-cucamonga' => [
                'thumbnail' => 'rancho cucamonga victoria gardens',
                'banner' => 'rancho cucamonga city view',
            ],
            'santa-rosa' => [
                'thumbnail' => 'santa rosa wine country vineyard',
                'banner' => 'santa rosa downtown city',
            ],
            'ontario' => [
                'thumbnail' => 'ontario mills mall shopping',
                'banner' => 'ontario airport modern',
            ],
            'elk-grove' => [
                'thumbnail' => 'elk grove park nature',
                'banner' => 'elk grove downtown city',
            ],
            'corona' => [
                'thumbnail' => 'corona hills landscape',
                'banner' => 'corona downtown city',
            ],
        ];

        foreach ($areaImages as $city => $queries) {
            try {
                // Download thumbnail
                $this->info("\nProcessing {$city} thumbnail...");
                $thumbnailFile = $this->getFreepikImage($queries['thumbnail'], 800, 600);
                
                if ($thumbnailFile) {
                    $this->info("Downloading thumbnail for {$city}...");
                    if (Storage::disk('public')->put("areas/thumbnails/{$city}.jpg", file_get_contents($thumbnailFile))) {
                        $this->info("Successfully downloaded thumbnail for {$city}");
                        $this->info("Thumbnail saved to: " . Storage::disk('public')->url("areas/thumbnails/{$city}.jpg"));
                        $this->info("Full path: " . Storage::disk('public')->path("areas/thumbnails/{$city}.jpg"));
                    } else {
                        $this->error("Failed to save thumbnail for {$city}");
                    }
                    unlink($thumbnailFile);
                } else {
                    $this->error("Failed to get thumbnail for {$city}");
                }

                // Download banner
                $this->info("\nProcessing {$city} banner...");
                $bannerFile = $this->getFreepikImage($queries['banner'], 1920, 1080);
                
                if ($bannerFile) {
                    $this->info("Downloading banner for {$city}...");
                    if (Storage::disk('public')->put("areas/banners/{$city}-banner.jpg", file_get_contents($bannerFile))) {
                        $this->info("Successfully downloaded banner for {$city}");
                        $this->info("Banner saved to: " . Storage::disk('public')->url("areas/banners/{$city}-banner.jpg"));
                        $this->info("Full path: " . Storage::disk('public')->path("areas/banners/{$city}-banner.jpg"));
                    } else {
                        $this->error("Failed to save banner for {$city}");
                    }
                    unlink($bannerFile);
                } else {
                    $this->error("Failed to get banner for {$city}");
                }

                // Add a small delay to avoid rate limiting
                sleep(1);
            } catch (\Exception $e) {
                $this->error("Failed to process {$city}: " . $e->getMessage());
                $this->error("Stack trace: " . $e->getTraceAsString());
            }
        }

        $this->info('Image download process completed!');
    }

    private function getFreepikImage($query, $width, $height)
    {
        try {
            $this->info("Searching Freepik for: " . $query);
            
            $response = Http::withHeaders([
                'X-Freepik-API-Key' => $this->freepikApiKey
            ])->get('https://api.freepik.com/v1/resources', [
                'term' => $query,
                'limit' => 1,
                'filters[content_type][photo]' => 1,
                'filters[orientation][landscape]' => 1,
                'order' => 'relevance'
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                if (isset($data['data'][0]['image']['source']['url'])) {
                    $imageUrl = $data['data'][0]['image']['source']['url'];
                    $this->info("Found image URL: " . $imageUrl);
                    
                    // Download the image with proper headers
                    $imageResponse = Http::withHeaders([
                        'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
                        'Accept' => 'image/webp,image/apng,image/*,*/*;q=0.8',
                        'Accept-Language' => 'en-US,en;q=0.9',
                        'Referer' => 'https://www.freepik.com/'
                    ])->get($imageUrl);

                    if ($imageResponse->successful()) {
                        // Create a temporary file to store the image
                        $tempFile = tempnam(sys_get_temp_dir(), 'freepik_');
                        file_put_contents($tempFile, $imageResponse->body());
                        
                        // Resize the image using GD
                        $sourceImage = imagecreatefromstring(file_get_contents($tempFile));
                        if (!$sourceImage) {
                            $this->error("Failed to create image from downloaded data");
                            unlink($tempFile);
                            return null;
                        }
                        
                        $resizedImage = imagecreatetruecolor($width, $height);
                        if (!$resizedImage) {
                            $this->error("Failed to create resized image");
                            imagedestroy($sourceImage);
                            unlink($tempFile);
                            return null;
                        }
                        
                        // Preserve transparency for PNG images
                        imagealphablending($resizedImage, false);
                        imagesavealpha($resizedImage, true);
                        
                        // Resize
                        imagecopyresampled(
                            $resizedImage, $sourceImage,
                            0, 0, 0, 0,
                            $width, $height,
                            imagesx($sourceImage), imagesy($sourceImage)
                        );
                        
                        // Save the resized image to a temporary file
                        $resizedTempFile = tempnam(sys_get_temp_dir(), 'freepik_resized_');
                        imagejpeg($resizedImage, $resizedTempFile, 90);
                        
                        // Clean up
                        imagedestroy($sourceImage);
                        imagedestroy($resizedImage);
                        unlink($tempFile);
                        
                        return $resizedTempFile;
                    } else {
                        $this->error("Failed to download image from URL");
                        $this->error("Status Code: " . $imageResponse->status());
                        $this->error("Response: " . $imageResponse->body());
                    }
                } else {
                    $this->error("No image URL found in API response");
                }
            } else {
                $this->error("Freepik API request failed");
                $this->error("Status Code: " . $response->status());
                $this->error("Response: " . $response->body());
            }
        } catch (\Exception $e) {
            $this->error("Error in getFreepikImage: " . $e->getMessage());
            $this->error("Stack trace: " . $e->getTraceAsString());
        }

        return null;
    }
} 