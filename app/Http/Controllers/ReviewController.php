<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Destination;
use App\Models\Activity;
use App\Models\Hotel;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Display reviews for a destination.
     */
    public function destination(Destination $destination): View
    {
        $reviews = $destination->reviews()
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $averageRating = $destination->average_rating;
        $totalReviews = $destination->total_reviews;

        return view('reviews.destination', compact('destination', 'reviews', 'averageRating', 'totalReviews'));
    }

    /**
     * Display reviews for an activity.
     */
    public function activity(Activity $activity): View
    {
        $reviews = $activity->reviews()
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $averageRating = $activity->average_rating;
        $totalReviews = $activity->total_reviews;

        return view('reviews.activity', compact('activity', 'reviews', 'averageRating', 'totalReviews'));
    }

    /**
     * Display reviews for a hotel.
     */
    public function hotel(Hotel $hotel): View
    {
        $reviews = $hotel->reviews()
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $averageRating = $hotel->average_rating;
        $totalReviews = $hotel->total_reviews;

        return view('reviews.hotel', compact('hotel', 'reviews', 'averageRating', 'totalReviews'));
    }

    /**
     * Show the form for creating a new review.
     */
    public function create(Request $request): View
    {
        $type = $request->get('type');
        $id = $request->get('id');
        
        $reviewable = null;
        $booking = null;

        if ($type === 'destination') {
            $reviewable = Destination::findOrFail($id);
        } elseif ($type === 'activity') {
            $reviewable = Activity::findOrFail($id);
        } elseif ($type === 'hotel') {
            $reviewable = Hotel::findOrFail($id);
        }

        // Check if user has a booking for this item
        if ($reviewable) {
            $booking = Booking::where('user_id', Auth::id())
                ->where(function($query) use ($reviewable, $type) {
                    if ($type === 'destination') {
                        $query->where('destination_id', $reviewable->id);
                    } elseif ($type === 'activity') {
                        $query->where('activity_id', $reviewable->id);
                    } elseif ($type === 'hotel') {
                        $query->where('hotel_id', $reviewable->id);
                    }
                })
                ->where('booking_status', 'confirmed')
                ->where('payment_status', 'paid')
                ->first();
        }

        return view('reviews.create', compact('reviewable', 'type', 'booking'));
    }

    /**
     * Store a newly created review.
     */
    public function store(Request $request): RedirectResponse
    {
        // Decode JSON strings for pros and cons (sent as JSON from hidden inputs)
        if ($request->has('pros') && is_string($request->input('pros'))) {
            $decoded = json_decode($request->input('pros'), true);
            $request->merge(['pros' => is_array($decoded) ? $decoded : []]);
        }
        if ($request->has('cons') && is_string($request->input('cons'))) {
            $decoded = json_decode($request->input('cons'), true);
            $request->merge(['cons' => is_array($decoded) ? $decoded : []]);
        }

        $validated = $request->validate([
            'type' => 'required|in:destination,activity,hotel',
            'id' => 'required|integer',
            'rating' => 'required|integer|min:1|max:5',
            'title' => 'required|string|max:255',
            'comment' => 'required|string|max:2000',
            'pros' => 'nullable|array',
            'cons' => 'nullable|array',
            'recommended_for' => 'nullable|array',
            'travel_date' => 'nullable|date|before_or_equal:today',
            'travel_type' => 'nullable|string|max:100',
            'images' => 'nullable|array|max:5',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Verify user has a valid booking
        $booking = Booking::where('user_id', Auth::id())
            ->where(function($query) use ($validated) {
                if ($validated['type'] === 'destination') {
                    $query->where('destination_id', $validated['id']);
                } elseif ($validated['type'] === 'activity') {
                    $query->where('activity_id', $validated['id']);
                } elseif ($validated['type'] === 'hotel') {
                    $query->where('hotel_id', $validated['id']);
                }
            })
            ->where('booking_status', 'confirmed')
            ->where('payment_status', 'paid')
            ->first();

        if (!$booking) {
            return redirect()->back()
                ->with('error', 'You must have a confirmed booking to write a review.');
        }

        // Check if user already reviewed this item
        $existingReview = Review::where('user_id', Auth::id())
            ->where(function($query) use ($validated) {
                if ($validated['type'] === 'destination') {
                    $query->where('destination_id', $validated['id']);
                } elseif ($validated['type'] === 'activity') {
                    $query->where('activity_id', $validated['id']);
                } elseif ($validated['type'] === 'hotel') {
                    $query->where('hotel_id', $validated['id']);
                }
            })
            ->first();

        if ($existingReview) {
            return redirect()->back()
                ->with('error', 'You have already reviewed this item.');
        }

        // Handle image uploads
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('reviews', 'public');
                $imagePaths[] = $path;
            }
        }

        $reviewData = [
            'user_id' => Auth::id(),
            'booking_id' => $booking->id,
            'rating' => $validated['rating'],
            'title' => $validated['title'],
            'comment' => $validated['comment'],
            'review_type' => $validated['type'],
            'pros' => $validated['pros'] ?? [],
            'cons' => $validated['cons'] ?? [],
            'recommended_for' => $validated['recommended_for'] ?? [],
            'travel_date' => $validated['travel_date'],
            'travel_type' => $validated['travel_type'],
            'images' => $imagePaths,
            'is_verified' => true, // Verified because user has confirmed booking
        ];

        // Set the appropriate foreign key
        if ($validated['type'] === 'destination') {
            $reviewData['destination_id'] = $validated['id'];
        } elseif ($validated['type'] === 'activity') {
            $reviewData['activity_id'] = $validated['id'];
        } elseif ($validated['type'] === 'hotel') {
            $reviewData['hotel_id'] = $validated['id'];
        }

        Review::create($reviewData);

        return redirect()->back()
            ->with('success', 'Review submitted successfully!');
    }

    /**
     * Mark a review as helpful.
     */
    public function helpful(Review $review)
    {
        $review->increment('helpful_count');
        
        if (request()->expectsJson()) {
            return response()->json(['success' => true]);
        }
        
        return redirect()->back()
            ->with('success', 'Thank you for your feedback!');
    }

    /**
     * Display user's reviews.
     */
    public function myReviews(): View
    {
        $reviews = Review::where('user_id', Auth::id())
            ->with(['destination', 'activity', 'hotel'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('reviews.my-reviews', compact('reviews'));
    }
}
