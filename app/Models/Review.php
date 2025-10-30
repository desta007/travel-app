<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'destination_id',
        'activity_id',
        'hotel_id',
        'booking_id',
        'rating',
        'title',
        'comment',
        'review_type',
        'is_verified',
        'is_featured',
        'helpful_count',
        'images',
        'pros',
        'cons',
        'recommended_for',
        'travel_date',
        'travel_type'
    ];

    protected $casts = [
        'rating' => 'integer',
        'is_verified' => 'boolean',
        'is_featured' => 'boolean',
        'helpful_count' => 'integer',
        'images' => 'array',
        'pros' => 'array',
        'cons' => 'array',
        'recommended_for' => 'array',
        'travel_date' => 'date',
    ];

    /**
     * Get the user that owns the review.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the destination for the review.
     */
    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }

    /**
     * Get the activity for the review.
     */
    public function activity(): BelongsTo
    {
        return $this->belongsTo(Activity::class);
    }

    /**
     * Get the hotel for the review.
     */
    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class);
    }

    /**
     * Get the booking for the review.
     */
    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    /**
     * Get the reviewable entity (destination, activity, or hotel).
     */
    public function reviewable()
    {
        if ($this->destination_id) {
            return $this->destination();
        } elseif ($this->activity_id) {
            return $this->activity();
        } elseif ($this->hotel_id) {
            return $this->hotel();
        }
        return null;
    }

    /**
     * Scope a query to only include verified reviews.
     */
    public function scopeVerified($query)
    {
        return $query->where('is_verified', true);
    }

    /**
     * Scope a query to only include featured reviews.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope a query to filter by rating.
     */
    public function scopeByRating($query, $rating)
    {
        return $query->where('rating', $rating);
    }

    /**
     * Scope a query to filter by review type.
     */
    public function scopeByType($query, $type)
    {
        return $query->where('review_type', $type);
    }

    /**
     * Scope a query to order by helpful count.
     */
    public function scopeMostHelpful($query)
    {
        return $query->orderBy('helpful_count', 'desc');
    }

    /**
     * Scope a query to order by newest first.
     */
    public function scopeNewest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}
