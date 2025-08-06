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
        Schema::create('service_providers', function (Blueprint $table) {
            $table->id();
            $table->string('provider_name');
            $table->string('shop_name')->nullable();
            $table->string('description')->nullable();
            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('image')->nullable();
            $table->json('gallery')->nullable();
            $table->date('contract_start')->nullable();
            $table->date('contract_end')->nullable();
            $table->string('status')->default('inactive');
            $table->integer('views')->default(0);
            $table->foreignId('category_id')->references('id')->on('categories');
            $table->foreignId('subcategory_id')->references('id')->on('subcategories');
            $table->foreignId('state_id')->references('id')->on('states');
            $table->foreignId('city_id')->references('id')->on('cities');
            $table->string('tag')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_providers');
    }
};
