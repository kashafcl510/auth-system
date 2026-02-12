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
        Schema::create('categories', function (Blueprint $table) {
             $table->id();
            $table->string('name'); // Bedroom, Entire Apartment, Excursion, Car Rental
            $table->text('description')->nullable();
            $table->string('icon')->nullable(); // Category icon/image path
            $table->boolean('is_enabled')->default(true);
            $table->integer('order')->default(0); // For reordering
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
