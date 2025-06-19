<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // General
            ['key' => 'site_name', 'value' => 'My Website', 'type' => 'string', 'group' => 'general', 'description' => 'Site Name'],
            ['key' => 'site_url', 'value' => 'https://example.com', 'type' => 'string', 'group' => 'general', 'description' => 'Site URL'],
            ['key' => 'default_language', 'value' => 'en', 'type' => 'string', 'group' => 'general', 'description' => 'Default Language'],
            ['key' => 'timezone', 'value' => 'UTC', 'type' => 'string', 'group' => 'general', 'description' => 'Timezone'],
            ['key' => 'site_logo', 'value' => '', 'type' => 'string', 'group' => 'general', 'description' => 'Website Logo'],
            ['key' => 'address', 'value' => '', 'type' => 'string', 'group' => 'general', 'description' => 'Street Address'],
            ['key' => 'city', 'value' => '', 'type' => 'string', 'group' => 'general', 'description' => 'City'],
            ['key' => 'state', 'value' => '', 'type' => 'string', 'group' => 'general', 'description' => 'State/Province'],
            ['key' => 'zip_code', 'value' => '', 'type' => 'string', 'group' => 'general', 'description' => 'ZIP/Postal Code'],
            ['key' => 'latitude', 'value' => '', 'type' => 'string', 'group' => 'general', 'description' => 'Latitude'],
            ['key' => 'longitude', 'value' => '', 'type' => 'string', 'group' => 'general', 'description' => 'Longitude'],

            // Caching
            ['key' => 'enable_full_page_cache', 'value' => '1', 'type' => 'bool', 'group' => 'caching', 'description' => 'Enable Full Page Cache'],
            ['key' => 'cache_expiry_minutes', 'value' => '60', 'type' => 'int', 'group' => 'caching', 'description' => 'Cache Expiry (minutes)'],
            ['key' => 'cache_driver', 'value' => 'file', 'type' => 'string', 'group' => 'caching', 'description' => 'Cache Driver'],

            // Image Optimization
            ['key' => 'image_compression_level', 'value' => '80', 'type' => 'int', 'group' => 'image', 'description' => 'Image Compression Level (0-100)'],
            ['key' => 'image_formats_allowed', 'value' => 'jpg,png,webp', 'type' => 'string', 'group' => 'image', 'description' => 'Allowed Image Formats'],
            ['key' => 'image_max_width', 'value' => '1920', 'type' => 'int', 'group' => 'image', 'description' => 'Max Image Width'],
            ['key' => 'image_cdn_url', 'value' => '', 'type' => 'string', 'group' => 'image', 'description' => 'Image CDN URL'],
            ['key' => 'enable_lazy_loading', 'value' => '1', 'type' => 'bool', 'group' => 'image', 'description' => 'Enable Lazy Loading'],

            // SEO
            ['key' => 'default_meta_title', 'value' => 'Welcome to My Website', 'type' => 'string', 'group' => 'seo', 'description' => 'Default Meta Title'],
            ['key' => 'default_meta_description', 'value' => 'This is my website.', 'type' => 'string', 'group' => 'seo', 'description' => 'Default Meta Description'],
            ['key' => 'meta_keywords', 'value' => '', 'type' => 'string', 'group' => 'seo', 'description' => 'Meta Keywords'],
            ['key' => 'enable_sitemap', 'value' => '1', 'type' => 'bool', 'group' => 'seo', 'description' => 'Enable Sitemap'],
            ['key' => 'enable_robots_txt', 'value' => '1', 'type' => 'bool', 'group' => 'seo', 'description' => 'Enable robots.txt'],
            ['key' => 'custom_robots_txt', 'value' => '', 'type' => 'text', 'group' => 'seo', 'description' => 'Custom robots.txt'],
            ['key' => 'enable_structured_data', 'value' => '1', 'type' => 'bool', 'group' => 'seo', 'description' => 'Enable Structured Data'],
            ['key' => 'canonical_url_mode', 'value' => 'auto', 'type' => 'string', 'group' => 'seo', 'description' => 'Canonical URL Mode'],
            ['key' => 'meta_tags', 'value' => '', 'type' => 'text', 'group' => 'seo', 'description' => 'Custom Meta Tags (HTML)'],

            // Performance
            ['key' => 'minify_css', 'value' => '1', 'type' => 'bool', 'group' => 'performance', 'description' => 'Minify CSS'],
            ['key' => 'minify_js', 'value' => '1', 'type' => 'bool', 'group' => 'performance', 'description' => 'Minify JS'],
            ['key' => 'inline_critical_css', 'value' => '1', 'type' => 'bool', 'group' => 'performance', 'description' => 'Inline Critical CSS'],
            ['key' => 'enable_http2', 'value' => '1', 'type' => 'bool', 'group' => 'performance', 'description' => 'Enable HTTP/2'],
            ['key' => 'enable_gzip', 'value' => '1', 'type' => 'bool', 'group' => 'performance', 'description' => 'Enable GZIP Compression'],
            ['key' => 'service_worker_enabled', 'value' => '0', 'type' => 'bool', 'group' => 'performance', 'description' => 'Enable Service Worker'],

            // Advanced
            ['key' => 'custom_head_html', 'value' => '', 'type' => 'text', 'group' => 'advanced', 'description' => 'Custom HTML in <head>'],
            ['key' => 'custom_body_end_html', 'value' => '', 'type' => 'text', 'group' => 'advanced', 'description' => 'Custom HTML before </body>'],
            ['key' => 'analytics_code', 'value' => '', 'type' => 'text', 'group' => 'advanced', 'description' => 'Analytics Code'],
            ['key' => 'facebook_pixel_id', 'value' => '', 'type' => 'string', 'group' => 'advanced', 'description' => 'Facebook Pixel ID'],

            // Others
            ['key' => 'maintenance_mode', 'value' => '0', 'type' => 'bool', 'group' => 'other', 'description' => 'Maintenance Mode'],
            ['key' => 'maintenance_message', 'value' => 'We are under maintenance.', 'type' => 'string', 'group' => 'other', 'description' => 'Maintenance Message'],
            ['key' => 'contact_email', 'value' => 'admin@example.com', 'type' => 'string', 'group' => 'other', 'description' => 'Contact Email'],
            ['key' => 'support_phone', 'value' => '', 'type' => 'string', 'group' => 'other', 'description' => 'Support Phone'],

            // Security
            ['key' => 'force_https', 'value' => '1', 'type' => 'bool', 'group' => 'security', 'description' => 'Force HTTPS'],
            ['key' => 'content_security_policy', 'value' => '', 'type' => 'string', 'group' => 'security', 'description' => 'Content Security Policy (CSP)'],
            ['key' => 'x_frame_options', 'value' => 'SAMEORIGIN', 'type' => 'string', 'group' => 'security', 'description' => 'X-Frame-Options'],
            ['key' => 'x_xss_protection', 'value' => '1', 'type' => 'bool', 'group' => 'security', 'description' => 'X-XSS-Protection'],
            ['key' => 'admin_session_timeout', 'value' => '30', 'type' => 'int', 'group' => 'security', 'description' => 'Admin Session Timeout (minutes)'],

            // User/Account
            ['key' => 'registration_enabled', 'value' => '1', 'type' => 'bool', 'group' => 'user', 'description' => 'Enable User Registration'],
            ['key' => 'email_verification_required', 'value' => '1', 'type' => 'bool', 'group' => 'user', 'description' => 'Require Email Verification'],
            ['key' => 'password_min_length', 'value' => '8', 'type' => 'int', 'group' => 'user', 'description' => 'Password Minimum Length'],
            ['key' => 'password_complexity', 'value' => '1', 'type' => 'bool', 'group' => 'user', 'description' => 'Require Complex Passwords'],

            // Email
            ['key' => 'mail_from_name', 'value' => 'READY 24h Security', 'type' => 'string', 'group' => 'email', 'description' => 'Mail From Name'],
            ['key' => 'mail_from_address', 'value' => 'noreply@example.com', 'type' => 'string', 'group' => 'email', 'description' => 'Mail From Address'],
            ['key' => 'mail_host', 'value' => '', 'type' => 'string', 'group' => 'email', 'description' => 'Mail Host'],
            ['key' => 'mail_port', 'value' => '', 'type' => 'string', 'group' => 'email', 'description' => 'Mail Port'],
            ['key' => 'mail_encryption', 'value' => 'tls', 'type' => 'string', 'group' => 'email', 'description' => 'Mail Encryption'],
            ['key' => 'mail_username', 'value' => '', 'type' => 'string', 'group' => 'email', 'description' => 'Mail Username'],
            ['key' => 'mail_password', 'value' => '', 'type' => 'string', 'group' => 'email', 'description' => 'Mail Password'],

            // Logging & Monitoring
            ['key' => 'log_level', 'value' => 'warning', 'type' => 'string', 'group' => 'logging', 'description' => 'Log Level'],
            ['key' => 'error_reporting_email', 'value' => '', 'type' => 'string', 'group' => 'logging', 'description' => 'Error Reporting Email'],
            ['key' => 'error_reporting_slack', 'value' => '', 'type' => 'string', 'group' => 'logging', 'description' => 'Error Reporting Slack Webhook'],

            // Integrations
            ['key' => 'google_analytics_id', 'value' => '', 'type' => 'string', 'group' => 'integrations', 'description' => 'Google Analytics ID'],
            ['key' => 'google_tag_manager_id', 'value' => '', 'type' => 'string', 'group' => 'integrations', 'description' => 'Google Tag Manager ID'],
            ['key' => 'custom_webhook_url', 'value' => '', 'type' => 'string', 'group' => 'integrations', 'description' => 'Custom Webhook URL'],

            // Branding
            ['key' => 'favicon', 'value' => '', 'type' => 'string', 'group' => 'branding', 'description' => 'Favicon'],
            ['key' => 'primary_color', 'value' => '#ff0000', 'type' => 'string', 'group' => 'branding', 'description' => 'Primary Color'],
            ['key' => 'secondary_color', 'value' => '#000000', 'type' => 'string', 'group' => 'branding', 'description' => 'Secondary Color'],

            // Legal
            ['key' => 'privacy_policy_url', 'value' => '', 'type' => 'string', 'group' => 'legal', 'description' => 'Privacy Policy URL'],
            ['key' => 'terms_of_service_url', 'value' => '', 'type' => 'string', 'group' => 'legal', 'description' => 'Terms of Service URL'],
            ['key' => 'cookie_consent_enabled', 'value' => '1', 'type' => 'bool', 'group' => 'legal', 'description' => 'Enable Cookie Consent'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
