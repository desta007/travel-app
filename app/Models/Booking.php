<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'destination_id',
        'activity_id',
        'hotel_id',
        'booking_type',
        'booking_reference',
        'booking_date',
        'check_in_date',
        'check_out_date',
        'adult_count',
        'child_count',
        'infant_count',
        'total_amount',
        'currency',
        'payment_status',
        'payment_method',
        'payment_reference',
        'booking_status',
        'special_requests',
        'cancellation_reason',
        'cancelled_at',
        'refund_amount',
        'refund_status',
        'contact_email',
        'contact_phone',
        'emergency_contact',
        'notes'
    ];

    protected $casts = [
        'booking_date' => 'datetime',
        'check_in_date' => 'date',
        'check_out_date' => 'date',
        'total_amount' => 'decimal:2',
        'refund_amount' => 'decimal:2',
        'cancelled_at' => 'datetime',
        'adult_count' => 'integer',
        'child_count' => 'integer',
        'infant_count' => 'integer',
    ];

    /**
     * Get the user that owns the booking.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the destination for the booking.
     */
    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }

    /**
     * Get the activity for the booking.
     */
    public function activity(): BelongsTo
    {
        return $this->belongsTo(Activity::class);
    }

    /**
     * Get the hotel for the booking.
     */
    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class);
    }

    /**
     * Get the reviews for the booking.
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get the total guests count.
     */
    public function getTotalGuestsAttribute(): int
    {
        return $this->adult_count + $this->child_count + $this->infant_count;
    }

    /**
     * Get the booking duration in days.
     */
    public function getDurationAttribute(): int
    {
        if ($this->check_in_date && $this->check_out_date) {
            return $this->check_in_date->diffInDays($this->check_out_date);
        }
        return 0;
    }

    /**
     * Check if booking is active.
     */
    public function getIsActiveAttribute(): bool
    {
        return $this->booking_status === 'confirmed' && 
               $this->payment_status === 'paid' && 
               !$this->cancelled_at;
    }

    /**
     * Check if booking can be cancelled.
     */
    public function getCanBeCancelledAttribute(): bool
    {
        if ($this->cancelled_at) {
            return false;
        }

        $cancellationDeadline = $this->check_in_date->subDays(1);
        return now()->lt($cancellationDeadline);
    }

    /**
     * Scope a query to only include confirmed bookings.
     */
    public function scopeConfirmed($query)
    {
        return $query->where('booking_status', 'confirmed');
    }

    /**
     * Scope a query to only include paid bookings.
     */
    public function scopePaid($query)
    {
        return $query->where('payment_status', 'paid');
    }

    /**
     * Scope a query to only include active bookings.
     */
    public function scopeActive($query)
    {
        return $query->where('booking_status', 'confirmed')
                    ->where('payment_status', 'paid')
                    ->whereNull('cancelled_at');
    }

    /**
     * Scope a query to filter by booking type.
     */
    public function scopeByType($query, $type)
    {
        return $query->where('booking_type', $type);
    }

    /**
     * Scope a query to filter by date range.
     */
    public function scopeByDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('booking_date', [$startDate, $endDate]);
    }
}
