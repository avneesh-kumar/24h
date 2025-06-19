<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Console\Commands\UserCreate;
use App\Console\Commands\UserPasswordUpdate;
use App\Services\Settings\CacheSettingsService;
use App\Services\Settings\EmailSettingsService;
use App\Services\Settings\LoggingSettingsService;
use App\Services\Settings\GeneralSettingsService;
use App\Services\Settings\BrandingSettingsService;
use App\Services\Settings\SeoSettingsService;
use App\Services\Settings\IntegrationSettingsService;
use App\Services\Settings\AdvancedSettingsService;
use App\Services\Settings\LegalSettingsService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->commands([
            UserCreate::class,
            UserPasswordUpdate::class,
        ]);
        $this->app->register(\App\Providers\SettingsServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Apply cache driver from settings globally
        $cacheSettings = app(CacheSettingsService::class);
        $driver = $cacheSettings->getCacheDriver();
        config(['cache.default' => $driver]);

        // Email settings
        $email = app(EmailSettingsService::class);
        config([
            'mail.from.name' => $email->fromName(),
            'mail.from.address' => $email->fromAddress(),
            'mail.mailers.smtp.host' => $email->smtpHost(),
            'mail.mailers.smtp.port' => $email->smtpPort(),
            'mail.mailers.smtp.encryption' => $email->smtpEncryption(),
            'mail.mailers.smtp.username' => $email->smtpUsername(),
            'mail.mailers.smtp.password' => $email->smtpPassword(),
        ]);

        // Logging settings
        $logging = app(LoggingSettingsService::class);
        config(['logging.channels.stack.level' => $logging->logLevel()]);

        // Prepare all settings for frontend views
        view()->composer('*', function ($view) {
            $general = app(GeneralSettingsService::class);
            $branding = app(BrandingSettingsService::class);
            $seo = app(SeoSettingsService::class);
            $integration = app(IntegrationSettingsService::class);
            $advanced = app(AdvancedSettingsService::class);
            $legal = app(LegalSettingsService::class);
            
            $view->with([
                // General/Branding
                'general' => $general,
                'site_logo' => $general->getLogoPath(),
                'branding_favicon' => $branding->favicon(),
                'branding_primary_color' => $branding->primaryColor(),
                'branding_secondary_color' => $branding->secondaryColor(),
                // SEO
                'seo_meta_title' => $seo->getMetaTitle(),
                'seo_meta_description' => $seo->getMetaDescription(),
                'seo_meta_keywords' => $seo->getMetaKeywords(),
                'seo_canonical_url_mode' => $seo->getCanonicalUrlMode(),
                'seo_meta_tags' => $seo->getMetaTags(),
                // Integrations
                'integration_google_analytics_id' => $integration->googleAnalyticsId(),
                'integration_facebook_pixel_id' => $integration->facebookPixelId(),
                // Advanced
                'advanced_custom_head_html' => $advanced->getCustomHeadHtml(),
                'advanced_custom_body_end_html' => $advanced->getCustomBodyEndHtml(),
                // Legal
                'legal_privacy_policy_url' => $legal->privacyPolicyUrl(),
                'legal_terms_of_service_url' => $legal->termsOfServiceUrl(),
                'legal_cookie_consent_enabled' => $legal->cookieConsentEnabled(),
            ]);
        });
    }
}
