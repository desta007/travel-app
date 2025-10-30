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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('destination_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('activity_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('hotel_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('booking_id')->nullable()->constrained()->onDelete('cascade');
            $table->integer('rating');
            $table->string('title');
            $table->text('comment');
            $table->enum('review_type', ['destination', 'activity', 'hotel'])->default('destination');
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->integer('helpful_count')->default(0);
            $table->json('images')->nullable();
            $table->json('pros')->nullable();
            $table->json('cons')->nullable();
            $table->json('recommended_for')->nullable();
            $table->date('travel_date')->nullable();
            $table->string('travel_type')->nullable();
            $table->timestamps();

            $table->index(['destination_id', 'rating']);
            $table->index(['activity_id', 'rating']);
            $table->index(['hotel_id', 'rating']);
            $table->index('is_verified');
            $table->index('is_featured');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
