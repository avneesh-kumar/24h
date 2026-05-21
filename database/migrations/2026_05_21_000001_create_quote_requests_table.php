<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('quote_requests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('facility_type');
            $table->string('service_type');
            $table->string('service_needed_by');
            $table->string('area');
            $table->string('num_guards');
            $table->string('referral');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('quote_requests');
    }
};
