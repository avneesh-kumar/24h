# Settings Services Usage

You can inject any settings service into your controllers, jobs, or other services via type-hinting. Example usage:

## Example: Using in a Controller

```php
use App\Services\Settings\CacheSettingsService;

class ExampleController extends Controller
{
    public function index(CacheSettingsService $cacheSettings)
    {
        $driver = $cacheSettings->getCacheDriver();
        // ...
    }
}
```

## Available Services
- `CacheSettingsService`
- `SeoSettingsService`
- `ImageSettingsService`
- `GeneralSettingsService`
- `PerformanceSettingsService`

## Example: Getting and Setting a Value
```php
$seo = app(\App\Services\Settings\SeoSettingsService::class);
$title = $seo->getMetaTitle();
$seo->setMetaTitle('New Title');
```

All services provide simple `get...` and `set...` methods for their domain.

---

**Extend**: Add new services in `app/Services/Settings/` and register them in `SettingsServiceProvider`.

**Integrate**: Use these services anywhere in your app for fast, modular settings access.
