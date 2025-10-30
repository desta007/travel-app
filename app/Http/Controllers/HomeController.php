<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Activity;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the home page with featured destinations, activities, and hotels.
     */
    public function index(): View
    {
        $featuredDestinations = Destination::featured()
            ->active()
            ->with(['activities', 'hotels'])
            ->limit(6)
            ->get();

        $featuredActivities = Activity::featured()
            ->active()
            ->with('destination')
            ->limit(8)
            ->get();

        $featuredHotels = Hotel::featured()
            ->active()
            ->with('destination')
            ->limit(6)
            ->get();

        $popularDestinations = Destination::active()
            ->orderBy('rating', 'desc')
            ->limit(4)
            ->get();

        return view('home', compact(
            'featuredDestinations',
            'featuredActivities',
            'featuredHotels',
            'popularDestinations'
        ));
    }

    /**
     * Display search results.
     */
    public function search(Request $request): View
    {
        $query = $request->get('q');
        $type = $request->get('type', 'all');
        $country = $request->get('country');
        $category = $request->get('category');
        $minPrice = $request->get('min_price');
        $maxPrice = $request->get('max_price');

        $destinations = collect();
        $activities = collect();
        $hotels = collect();

        if ($type === 'all' || $type === 'destinations') {
            $destinationsQuery = Destination::active();
            
            if ($query) {
                $destinationsQuery->where(function($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%")
                      ->orWhere('description', 'like', "%{$query}%")
                      ->orWhere('location', 'like', "%{$query}%");
                });
            }
            
            if ($country) {
                $destinationsQuery->byCountry($country);
            }
            
            if ($category) {
                $destinationsQuery->byCategory($category);
            }

            $destinations = $destinationsQuery->with(['activities', 'hotels'])->get();
        }

        if ($type === 'all' || $type === 'activities') {
            $activitiesQuery = Activity::active()->with('destination');
            
            if ($query) {
                $activitiesQuery->where(function($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%")
                      ->orWhere('description', 'like', "%{$query}%");
                });
            }
            
            if ($category) {
                $activitiesQuery->byCategory($category);
            }
            
            if ($minPrice && $maxPrice) {
                $activitiesQuery->byPriceRange($minPrice, $maxPrice);
            }

            $activities = $activitiesQuery->get();
        }

        if ($type === 'all' || $type === 'hotels') {
            $hotelsQuery = Hotel::active()->with('destination');
            
            if ($query) {
                $hotelsQuery->where(function($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%")
                      ->orWhere('description', 'like', "%{$query}%")
                      ->orWhere('address', 'like', "%{$query}%");
                });
            }
            
            if ($minPrice && $maxPrice) {
                $hotelsQuery->byPriceRange($minPrice, $maxPrice);
            }

            $hotels = $hotelsQuery->get();
        }

        $countries = Destination::active()->distinct()->pluck('country')->sort()->values();
        $categories = Destination::active()->distinct()->pluck('category')->sort()->values();

        return view('search', compact(
            'destinations',
            'activities',
            'hotels',
            'query',
            'type',
            'country',
            'category',
            'minPrice',
            'maxPrice',
            'countries',
            'categories'
        ));
    }

    /**
     * Display destination details.
     */
    public function destination(Destination $destination): View
    {
        $destination->load(['activities', 'hotels', 'reviews.user']);
        
        $relatedDestinations = Destination::active()
            ->where('id', '!=', $destination->id)
            ->where('country', $destination->country)
            ->limit(4)
            ->get();

        return view('destination', compact('destination', 'relatedDestinations'));
    }

    /**
     * Display activity details.
     */
    public function activity(Activity $activity): View
    {
        $activity->load(['destination', 'reviews.user']);
        
        $relatedActivities = Activity::active()
            ->where('id', '!=', $activity->id)
            ->where('destination_id', $activity->destination_id)
            ->limit(4)
            ->get();

        return view('activity', compact('activity', 'relatedActivities'));
    }

    /**
     * Display hotel details.
     */
    public function hotel(Hotel $hotel): View
    {
        $hotel->load(['destination', 'reviews.user']);
        
        $relatedHotels = Hotel::active()
            ->where('id', '!=', $hotel->id)
            ->where('destination_id', $hotel->destination_id)
            ->limit(4)
            ->get();

        return view('hotel', compact('hotel', 'relatedHotels'));
    }
}
