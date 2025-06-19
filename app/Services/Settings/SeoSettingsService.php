<?php

namespace App\Services\Settings;

class SeoSettingsService extends BaseSettingsService
{
    public function getMetaTitle()
    {
        $title = $this->get('default_meta_title', config('app.name'));
        \Log::debug('SeoSettingsService::getMetaTitle', [
            'key' => 'default_meta_title',
            'value' => $title,
            'fallback' => config('app.name')
        ]);
        return $title;
    }

    public function setMetaTitle($title)
    {
        \Log::debug('SeoSettingsService::setMetaTitle', [
            'key' => 'default_meta_title',
            'value' => $title
        ]);
        return $this->set('default_meta_title', $title);
    }

    public function getMetaDescription()
    {
        return $this->get('default_meta_description', '');
    }

    public function setMetaDescription($desc)
    {
        return $this->set('default_meta_description', $desc);
    }

    public function getMetaKeywords()
    {
        return $this->get('meta_keywords', '');
    }

    public function setMetaKeywords($keywords)
    {
        return $this->set('meta_keywords', $keywords);
    }

    public function getCanonicalUrlMode()
    {
        return $this->get('canonical_url_mode', 'auto');
    }

    public function setCanonicalUrlMode($mode)
    {
        return $this->set('canonical_url_mode', $mode);
    }

    public function getMetaTags()
    {
        return $this->get('meta_tags', '');
    }

    public function setMetaTags($tags)
    {
        return $this->set('meta_tags', $tags);
    }

    public function isSitemapEnabled()
    {
        return (bool) $this->get('enable_sitemap', true);
    }

    public function isRobotsTxtEnabled()
    {
        return (bool) $this->get('enable_robots_txt', true);
    }

    public function getCustomRobotsTxt()
    {
        return $this->get('custom_robots_txt', '');
    }

    public function isStructuredDataEnabled()
    {
        return (bool) $this->get('enable_structured_data', true);
    }
}
