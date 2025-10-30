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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('destination_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->text('description');
            $table->text('short_description')->nullable();
            $table->string('category');
            $table->string('subcategory')->nullable();
            $table->string('duration')->nullable();
            $table->enum('difficulty_level', ['easy', 'moderate', 'hard', 'expert'])->default('easy');
            $table->integer('min_age')->nullable();
            $table->integer('max_group_size')->nullable();
            $table->decimal('price', 10, 2);
            $table->decimal('original_price', 10, 2)->nullable();
            $table->decimal('discount_percentage', 5, 2)->default(0);
            $table->string('currency', 3)->default('USD');
            $table->string('image_url')->nullable();
            $table->json('gallery_images')->nullable();
            $table->json('included_items')->nullable();
            $table->json('excluded_items')->nullable();
            $table->text('meeting_point')->nullable();
            $table->text('cancellation_policy')->nullable();
            $table->text('booking_requirements')->nullable();
            $table->boolean('is_instant_confirmation')->default(true);
            $table->boolean('is_refundable')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->decimal('rating', 3, 2)->default(0);
            $table->integer('total_bookings')->default(0);
            $table->timestamps();

            $table->index(['destination_id', 'category']);
            $table->index('is_featured');
            $table->index('is_active');
            $table->index('price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
