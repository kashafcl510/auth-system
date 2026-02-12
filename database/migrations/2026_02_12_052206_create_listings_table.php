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
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Host ID
            $table->foreignId('category_id')->constrained()->onDelete('cascade');

            // Step 2: Basic Information
            $table->string('title', 100);
            $table->text('description'); // Max 2000 characters (validate in controller)
            $table->string('street')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->integer('max_guests');

            // Step 4: Pricing
            $table->decimal('base_price', 10, 2);
            $table->string('currency', 3)->default('USD');
            $table->decimal('weekend_price', 10, 2)->nullable();

            // Step 5: Availability & Rules
            $table->text('house_rules')->nullable();
            $table->enum('cancellation_policy', ['flexible', 'moderate', 'strict'])->default('moderate');
            $table->time('check_in_time');
            $table->time('check_out_time');
            $table->integer('minimum_stay')->default(1);
            $table->integer('maximum_stay')->nullable();

            // Step 6: Additional Details (for Bedrooms/Apartments)
            $table->integer('bedrooms')->nullable();
            $table->integer('bathrooms')->nullable();

            // Step 6: Additional Details (for Excursions)
            $table->string('duration')->nullable(); // e.g., "4 hours", "2 days"
            $table->string('difficulty_level')->nullable();
            $table->integer('group_size_min')->nullable();
            $table->integer('group_size_max')->nullable();
            $table->text('whats_included')->nullable();

            // Step 6: Additional Details (for Car Rentals)
            $table->string('vehicle_make')->nullable();
            $table->string('vehicle_model')->nullable();
            $table->integer('vehicle_year')->nullable();
            $table->string('transmission_type')->nullable();
            $table->string('fuel_type')->nullable();
            $table->integer('mileage_limit_per_day')->nullable();

            // Status & Moderation
            $table->enum('status', ['pending', 'active', 'rejected'])->default('pending');
            $table->text('rejection_reason')->nullable();
            $table->text('admin_notes')->nullable();

            // Statistics
            $table->integer('view_count')->default(0);

            // Draft functionality
            $table->boolean('is_draft')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
