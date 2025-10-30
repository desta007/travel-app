<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'destination_id',
        'name',
        'description',
        'short_description',
        'star_rating',
        'address',
        'latitude',
        'longitude',
        'phone',
        'email',
        'website',
        'check_in_time',
        'check_out_time',
        'amenities',
        'facilities',
        'room_types',
        'price_per_night',
        'currency',
        'image_url',
        'gallery_images',
        'cancellation_policy',
        'is_pet_friendly',
        'is_featured',
        'is_active',
        'rating',
        'total_reviews'
    ];

    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'star_rating' => 'integer',
        'price_per_night' => 'decimal:2',
        'rating' => 'decimal:2',
        'gallery_images' => 'array',
        'amenities' => 'array',
        'facilities' => 'array',
        'room_types' => 'array',
        'is_pet_friendly' => 'boolean',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'total_reviews' => 'integer',
    ];

    /**
     * Get the destination that owns the hotel.
     */
    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }

    /**
     * Get the bookings for the hotel.
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Get the reviews for the hotel.
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get the average rating for the hotel.
     */
    public function getAverageRatingAttribute(): float
    {
        return $this->reviews()->avg('rating') ?? 0;
    }

    /**
     * Get the total reviews count for the hotel.
     */
    public function getTotalReviewsAttribute(): int
    {
        return $this->reviews()->count();
    }

    /**
     * Scope a query to only include featured hotels.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope a query to only include active hotels.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to filter by star rating.
     */
    public function scopeByStarRating($query, $stars)
    {
        return $query->where('star_rating', $stars);
    }

    /**
     * Scope a query to filter by price range.
     */
    public function scopeByPriceRange($query, $minPrice, $maxPrice)
    {
        return $query->whereBetween('price_per_night', [$minPrice, $maxPrice]);
    }

    /**
     * Scope a query to filter by amenities.
     */
    public function scopeByAmenities($query, $amenities)
    {
        return $query->whereJsonContains('amenities', $amenities);
    }
}
