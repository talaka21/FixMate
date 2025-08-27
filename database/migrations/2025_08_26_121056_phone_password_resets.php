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
    if (!Schema::hasTable('phone_password_resets')) {
        Schema::create('phone_password_resets', function (Blueprint $table) {
            $table->id();
            $table->string('phone_number')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
    }
}

   /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
