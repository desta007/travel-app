<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Activity;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    /**
     * Display the booking form for an activity.
     */
    public function createActivity(Activity $activity): View
    {
        $activity->load('destination');
        
        return view('bookings.create-activity', compact('activity'));
    }

    /**
     * Display the booking form for a hotel.
     */
    public function createHotel(Hotel $hotel): View
    {
        $hotel->load('destination');
        
        return view('bookings.create-hotel', compact('hotel'));
    }

    /**
     * Store a new booking.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'activity_id' => 'nullable|exists:activities,id',
            'hotel_id' => 'nullable|exists:hotels,id',
            'booking_type' => 'required|in:activity,hotel',
            'check_in_date' => 'required|date|after:today',
            'check_out_date' => 'nullable|date|after:check_in_date',
            'adult_count' => 'required|integer|min:1|max:10',
            'child_count' => 'integer|min:0|max:10',
            'infant_count' => 'integer|min:0|max:5',
            'contact_email' => 'required|email',
            'contact_phone' => 'required|string|max:20',
            'emergency_contact' => 'nullable|string|max:20',
            'special_requests' => 'nullable|string|max:1000',
        ]);

        // Get the destination from activity or hotel
        if ($validated['booking_type'] === 'activity') {
            $activity = Activity::findOrFail($validated['activity_id']);
            $destination = $activity->destination;
            $totalAmount = $activity->price * $validated['adult_count'];
        } else {
            $hotel = Hotel::findOrFail($validated['hotel_id']);
            $destination = $hotel->destination;
            $nights = \Carbon\Carbon::parse($validated['check_in_date'])
                ->diffInDays(\Carbon\Carbon::parse($validated['check_out_date']));
            $totalAmount = $hotel->price_per_night * $nights * $validated['adult_count'];
        }

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'destination_id' => $destination->id,
            'activity_id' => $validated['activity_id'] ?? null,
            'hotel_id' => $validated['hotel_id'] ?? null,
            'booking_type' => $validated['booking_type'],
            'booking_reference' => 'BK' . Str::random(8),
            'booking_date' => now(),
            'check_in_date' => $validated['check_in_date'],
            'check_out_date' => $validated['check_out_date'] ?? null,
            'adult_count' => $validated['adult_count'],
            'child_count' => $validated['child_count'] ?? 0,
            'infant_count' => $validated['infant_count'] ?? 0,
            'total_amount' => $totalAmount,
            'contact_email' => $validated['contact_email'],
            'contact_phone' => $validated['contact_phone'],
            'emergency_contact' => $validated['emergency_contact'],
            'special_requests' => $validated['special_requests'],
            'booking_status' => 'pending',
            'payment_status' => 'pending',
        ]);

        return redirect()->route('bookings.show', $booking)
            ->with('success', 'Booking created successfully! Please complete the payment.');
    }

    /**
     * Display the specified booking.
     */
    public function show(Booking $booking): View
    {
        $booking->load(['destination', 'activity', 'hotel', 'user']);
        
        return view('bookings.show', compact('booking'));
    }

    /**
     * Display user's bookings.
     */
    public function index(): View
    {
        $bookings = Booking::where('user_id', Auth::id())
            ->with(['destination', 'activity', 'hotel'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('bookings.index', compact('bookings'));
    }

    /**
     * Cancel a booking.
     */
    public function cancel(Booking $booking): RedirectResponse
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        if (!$booking->can_be_cancelled) {
            return redirect()->back()
                ->with('error', 'This booking cannot be cancelled.');
        }

        $booking->update([
            'booking_status' => 'cancelled',
            'cancelled_at' => now(),
            'cancellation_reason' => 'Cancelled by user',
        ]);

        return redirect()->back()
            ->with('success', 'Booking cancelled successfully.');
    }

    /**
     * Process payment for a booking.
     */
    public function payment(Booking $booking): RedirectResponse
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        if ($booking->payment_status === 'paid') {
            return redirect()->back()
                ->with('error', 'This booking is already paid.');
        }

        // Simulate payment processing
        $booking->update([
            'payment_status' => 'paid',
            'booking_status' => 'confirmed',
            'payment_method' => 'credit_card',
            'payment_reference' => 'PAY' . Str::random(8),
        ]);

        return redirect()->route('bookings.show', $booking)
            ->with('success', 'Payment processed successfully!');
    }
}
