# Installation Guide

## Prerequisites
- PHP >= 8.0
- Composer
- MySQL or compatible database
- Node.js & npm (for frontend assets)

## 1. Clone the Repository
```bash
git clone <repository-url>
cd ready-24h-security
```

## 2. Install Dependencies
```bash
composer install
npm install
```

## 3. Environment Setup
- Copy the example environment file and configure your settings:
```bash
cp .env.example .env
```
- Edit `.env` to set your database and mail credentials.

## 4. Generate Application Key
```bash
php artisan key:generate
```

## 5. Run Migrations
```bash
php artisan migrate
```

## 6. Seed the Database
You can seed all or specific tables. Available seeders:
- `AreaSeeder`
- `ServiceSeeder`
- `IndustrySeeder`
- `MenuSeeder`
- `SettingSeeder`
- `TestimonialSeeder`

### Seed All (Default)
By default, only `AreaSeeder` is called. To seed all, edit `database/seeders/DatabaseSeeder.php` and uncomment/add the desired seeders in the `$this->call([...])` array, e.g.:
```php
$this->call([
    SettingSeeder::class,
    AreaSeeder::class,
    ServiceSeeder::class,
    IndustrySeeder::class,
    MenuSeeder::class,
    TestimonialSeeder::class,
]);
```
Then run:
```bash
php artisan db:seed
```

### Seed Individual Seeder
You can run any seeder individually:
```bash
php artisan db:seed --class=SettingSeeder
php artisan db:seed --class=AreaSeeder
php artisan db:seed --class=ServiceSeeder
php artisan db:seed --class=IndustrySeeder
php artisan db:seed --class=MenuSeeder
php artisan db:seed --class=TestimonialSeeder
```

## 7. Build Frontend Assets
```bash
npm run build
```

## 8. Start the Application
- For local development:
```bash
php artisan serve
```
- Or use your preferred web server (Apache, Nginx, etc.)

---