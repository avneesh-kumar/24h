<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->groupBy('group');
        // die('Settings loaded successfully.'); // Temporary debug line, remove in production
        return view('admin.settings.index', compact('settings'));
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
}
