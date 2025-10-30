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
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('destination_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->text('description');
            $table->text('short_description')->nullable();
            $table->integer('star_rating');
            $table->text('address');
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->time('check_in_time')->nullable();
            $table->time('check_out_time')->nullable();
            $table->json('amenities')->nullable();
            $table->json('facilities')->nullable();
            $table->json('room_types')->nullable();
            $table->decimal('price_per_night', 10, 2);
            $table->string('currency', 3)->default('USD');
            $table->string('image_url')->nullable();
            $table->json('gallery_images')->nullable();
            $table->text('cancellation_policy')->nullable();
            $table->boolean('is_pet_friendly')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->decimal('rating', 3, 2)->default(0);
            $table->integer('total_reviews')->default(0);
            $table->timestamps();

            $table->index(['destination_id', 'star_rating']);
            $table->index('is_featured');
            $table->index('is_active');
            $table->index('price_per_night');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};
