<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Settings\CacheSettingsService;
use App\Services\Settings\SeoSettingsService;
use App\Services\Settings\ImageSettingsService;
use App\Services\Settings\GeneralSettingsService;
use App\Services\Settings\PerformanceSettingsService;
use App\Services\Settings\SecuritySettingsService;
use App\Services\Settings\UserSettingsService;
use App\Services\Settings\EmailSettingsService;
use App\Services\Settings\LoggingSettingsService;
use App\Services\Settings\IntegrationSettingsService;
use App\Services\Settings\BrandingSettingsService;
use App\Services\Settings\LegalSettingsService;

class SettingsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(CacheSettingsService::class);
        $this->app->singleton(SeoSettingsService::class);
        $this->app->singleton(ImageSettingsService::class);
        $this->app->singleton(GeneralSettingsService::class);
        $this->app->singleton(PerformanceSettingsService::class);
        $this->app->singleton(SecuritySettingsService::class);
        $this->app->singleton(UserSettingsService::class);
        $this->app->singleton(EmailSettingsService::class);
        $this->app->singleton(LoggingSettingsService::class);
        $this->app->singleton(IntegrationSettingsService::class);
        $this->app->singleton(BrandingSettingsService::class);
        $this->app->singleton(LegalSettingsService::class);
    }
}
