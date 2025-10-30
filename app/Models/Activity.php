<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'destination_id',
        'name',
        'description',
        'short_description',
        'category',
        'subcategory',
        'duration',
        'difficulty_level',
        'min_age',
        'max_group_size',
        'price',
        'original_price',
        'discount_percentage',
        'currency',
        'image_url',
        'gallery_images',
        'included_items',
        'excluded_items',
        'meeting_point',
        'cancellation_policy',
        'booking_requirements',
        'is_instant_confirmation',
        'is_refundable',
        'is_featured',
        'is_active',
        'rating',
        'total_bookings'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'original_price' => 'decimal:2',
        'discount_percentage' => 'decimal:2',
        'rating' => 'decimal:2',
        'gallery_images' => 'array',
        'included_items' => 'array',
        'excluded_items' => 'array',
        'is_instant_confirmation' => 'boolean',
        'is_refundable' => 'boolean',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'total_bookings' => 'integer',
    ];

    /**
     * Get the destination that owns the activity.
     */
    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }

    /**
     * Get the bookings for the activity.
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Get the reviews for the activity.
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get the average rating for the activity.
     */
    public function getAverageRatingAttribute(): float
    {
        return $this->reviews()->avg('rating') ?? 0;
    }

    /**
     * Get the total reviews count for the activity.
     */
    public function getTotalReviewsAttribute(): int
    {
        return $this->reviews()->count();
    }

    /**
     * Get the discounted price.
     */
    public function getDiscountedPriceAttribute(): float
    {
        if ($this->discount_percentage > 0) {
            return $this->price * (1 - $this->discount_percentage / 100);
        }
        return $this->price;
    }

    /**
     * Scope a query to only include featured activities.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope a query to only include active activities.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to filter by category.
     */
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Scope a query to filter by price range.
     */
    public function scopeByPriceRange($query, $minPrice, $maxPrice)
    {
        return $query->whereBetween('price', [$minPrice, $maxPrice]);
    }

    /**
     * Scope a query to filter by difficulty level.
     */
    public function scopeByDifficulty($query, $difficulty)
    {
        return $query->where('difficulty_level', $difficulty);
    }
}
