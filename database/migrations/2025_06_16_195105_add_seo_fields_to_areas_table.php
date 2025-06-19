<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('areas', function (Blueprint $table) {
            $table->string('meta_title')->nullable()->after('description');
            $table->text('meta_keywords')->nullable()->after('meta_title');
            $table->string('canonical_url')->nullable()->after('meta_keywords');
        });
    }

    public function down()
    {
        Schema::table('areas', function (Blueprint $table) {
            $table->dropColumn(['meta_title', 'meta_keywords', 'canonical_url']);
        });
    }
}; 