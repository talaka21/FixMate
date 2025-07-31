<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('service_provider_requests', function (Blueprint $table) {
            $table->id();
            $table->string('provider_name');
            $table->string('shop_name')->nullable();
            $table->string('description')->nullable();
            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('image')->nullable();
            $table->string('status')->default('unread');
            $table->foreignId('category_id')->references('id')->on('categories');
            $table->foreignId('subcategory_id')->references('id')->on('subcategories');
            $table->foreignId('state_id')->references('id')->on('states');
            $table->foreignId('city_id')->references('id')->on('cities');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_provider_requests');
    }
};
