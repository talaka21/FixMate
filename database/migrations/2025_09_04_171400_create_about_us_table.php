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
        Schema::create('about_us', function (Blueprint $table) {
            $table->id();
               $table->text('content'); // النص عن الشركة
    $table->string('phone', 10); // رقم الهاتف بحد أقصى 10 أرقام
    $table->string('facebook')->nullable(); // رابط فيسبوك
    $table->string('instagram')->nullable(); // رابط انستقرام
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_us');
    }
};
