<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\Setting;

return new class extends Migration
{
    public function up(): void
    {
        Setting::updateOrCreate(
            ['key' => 'custom_css'],
            ['value' => '', 'type' => 'text', 'group' => 'advanced', 'description' => 'Custom CSS']
        );
    }

    public function down(): void
    {
        Setting::where('key', 'custom_css')->delete();
    }
};
