<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Service;
use App\Models\Area;
use App\Models\Industry;
use App\Models\Post;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->groupBy('group');
        $robotsContent = file_exists(public_path('robots.txt')) ? file_get_contents(public_path('robots.txt')) : "User-agent: *\nDisallow:";
        return view('admin.settings.index', compact('settings', 'robotsContent'));
    }

    public function update(Request $request)
    {
        $settings = $request->except('_token', '_method');
        
        foreach ($settings as $key => $value) {
            $setting = Setting::where('key', $key)->first();
            
            if ($setting) {
                // Handle file uploads
                if ($request->hasFile($key)) {
                    $file = $request->file($key);
                    $path = $file->store('public/settings');
                    $value = str_replace('public/', '', $path);
                }
                
                // Handle boolean values
                if ($setting->type === 'bool') {
                    $value = $request->has($key) ? '1' : '0';
                }
                
                $setting->value = $value;
                $setting->save();
            }
        }

        // Clear all caches
        Cache::flush();
        Artisan::call('view:clear');
        Artisan::call('config:clear');
        Artisan::call('cache:clear');

        // Apply timezone if changed
        if (isset($settings['timezone'])) {
            config(['app.timezone' => $settings['timezone']]);
            date_default_timezone_set($settings['timezone']);
        }

        return redirect()->route('admin.settings.index')
            ->with('status', 'Settings updated successfully and cache cleared.');
    }

    public function generateSitemap(Request $request)
    {
        $baseUrl = rtrim(Setting::where('key', 'site_url')->value('value') ?? config('app.url'), '/');
        $now = now()->toIso8601String();

        $urls = [
            ['loc' => $baseUrl . '/', 'priority' => '1.0', 'changefreq' => 'daily'],
            ['loc' => $baseUrl . '/about', 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['loc' => $baseUrl . '/services', 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['loc' => $baseUrl . '/areas', 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['loc' => $baseUrl . '/industries', 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['loc' => $baseUrl . '/blog', 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['loc' => $baseUrl . '/contact', 'priority' => '0.7', 'changefreq' => 'monthly'],
        ];

        foreach (Service::where('active', true)->get() as $item) {
            $urls[] = ['loc' => $baseUrl . '/services/' . $item->slug, 'priority' => '0.7', 'changefreq' => 'weekly', 'lastmod' => $item->updated_at->toIso8601String()];
        }
        foreach (Area::where('active', true)->get() as $item) {
            $urls[] = ['loc' => $baseUrl . '/areas/' . $item->slug, 'priority' => '0.7', 'changefreq' => 'weekly', 'lastmod' => $item->updated_at->toIso8601String()];
        }
        foreach (Industry::where('active', true)->get() as $item) {
            $urls[] = ['loc' => $baseUrl . '/industries/' . $item->slug, 'priority' => '0.7', 'changefreq' => 'weekly', 'lastmod' => $item->updated_at->toIso8601String()];
        }
        foreach (Post::where('status', 'published')->get() as $item) {
            $urls[] = ['loc' => $baseUrl . '/blog/' . $item->slug, 'priority' => '0.6', 'changefreq' => 'weekly', 'lastmod' => $item->updated_at->toIso8601String()];
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"' . "\n";
        $xml .= '        xmlns:xhtml="http://www.w3.org/1999/xhtml"' . "\n";
        $xml .= '        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"' . "\n";
        $xml .= '        xmlns:video="http://www.google.com/schemas/sitemap-video/1.1"' . "\n";
        $xml .= '        xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">' . "\n";

        foreach ($urls as $url) {
            $lastmod = $url['lastmod'] ?? $now;
            $xml .= "  <url>\n";
            $xml .= "    <loc>{$url['loc']}</loc>\n";
            $xml .= "    <lastmod>{$lastmod}</lastmod>\n";
            $xml .= "    <changefreq>{$url['changefreq']}</changefreq>\n";
            $xml .= "    <priority>{$url['priority']}</priority>\n";
            $xml .= "  </url>\n";
        }

        $xml .= '</urlset>';

        file_put_contents(public_path('sitemap.xml'), $xml);

        return redirect()->route('admin.settings.index', ['tab' => 'sitemap'])
            ->with('status', 'sitemap_generated');
    }

    public function saveRobots(Request $request)
    {
        $request->validate(['robots_content' => 'required|string']);
        file_put_contents(public_path('robots.txt'), $request->input('robots_content'));

        return redirect()->route('admin.settings.index', ['tab' => 'robots'])
            ->with('status', 'robots_saved');
    }
}
