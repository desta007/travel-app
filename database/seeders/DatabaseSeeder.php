<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Destination;
use App\Models\Activity;
use App\Models\Hotel;
use App\Models\User;
use App\Models\Review;
use App\Models\Booking;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create demo user
        $demoUser = User::create([
            'name' => 'Demo User',
            'email' => 'demo@travelapp.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
        ]);

        // Create additional users
        $users = User::factory(10)->create();
        $users->prepend($demoUser);

        // Create destinations
        $destinations = [
            [
                'name' => 'Tokyo',
                'description' => 'Tokyo is Japan\'s bustling capital, mixing the ultramodern and the traditional, from neon-lit skyscrapers to historic temples.',
                'location' => 'Tokyo, Japan',
                'country' => 'Japan',
                'city' => 'Tokyo',
                'latitude' => 35.6762,
                'longitude' => 139.6503,
                'image_url' => 'https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80',
                'category' => 'City',
                'rating' => 4.8,
                'price_range' => '$$$',
                'best_time_to_visit' => 'Spring (March-May) and Fall (September-November)',
                'language' => 'Japanese',
                'currency' => 'JPY',
                'timezone' => 'JST',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Kyoto',
                'description' => 'Kyoto is Japan\'s ancient capital, famous for its classical Buddhist temples, gardens, imperial palaces, and traditional wooden houses.',
                'location' => 'Kyoto, Japan',
                'country' => 'Japan',
                'city' => 'Kyoto',
                'latitude' => 35.0116,
                'longitude' => 135.7681,
                'image_url' => 'https://images.unsplash.com/photo-1493976040374-85c8e12f0c0e?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80',
                'category' => 'Cultural',
                'rating' => 4.9,
                'price_range' => '$$$',
                'best_time_to_visit' => 'Spring (March-May) and Fall (September-November)',
                'language' => 'Japanese',
                'currency' => 'JPY',
                'timezone' => 'JST',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Bangkok',
                'description' => 'Bangkok is Thailand\'s capital and largest city, known for ornate shrines and vibrant street life.',
                'location' => 'Bangkok, Thailand',
                'country' => 'Thailand',
                'city' => 'Bangkok',
                'latitude' => 13.7563,
                'longitude' => 100.5018,
                'image_url' => 'https://images.unsplash.com/photo-1552465011-b4e21bf6e79a?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80',
                'category' => 'City',
                'rating' => 4.6,
                'price_range' => '$$',
                'best_time_to_visit' => 'November to March',
                'language' => 'Thai',
                'currency' => 'THB',
                'timezone' => 'ICT',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Bali',
                'description' => 'Bali is an Indonesian island known for its forested volcanic mountains, iconic rice paddies, beaches and coral reefs.',
                'location' => 'Bali, Indonesia',
                'country' => 'Indonesia',
                'city' => 'Denpasar',
                'latitude' => -8.3405,
                'longitude' => 115.0920,
                'image_url' => 'https://images.unsplash.com/photo-1537953773345-d172ccf13cf1?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80',
                'category' => 'Beach',
                'rating' => 4.7,
                'price_range' => '$$',
                'best_time_to_visit' => 'April to October',
                'language' => 'Indonesian',
                'currency' => 'IDR',
                'timezone' => 'WITA',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Singapore',
                'description' => 'Singapore is a global financial center with a tropical climate and multicultural population.',
                'location' => 'Singapore',
                'country' => 'Singapore',
                'city' => 'Singapore',
                'latitude' => 1.3521,
                'longitude' => 103.8198,
                'image_url' => 'https://images.unsplash.com/photo-1525625293386-3f8f99389edd?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80',
                'category' => 'City',
                'rating' => 4.5,
                'price_range' => '$$$',
                'best_time_to_visit' => 'Year-round',
                'language' => 'English',
                'currency' => 'SGD',
                'timezone' => 'SGT',
                'is_featured' => true,
                'is_active' => true,
            ],
        ];

        foreach ($destinations as $destinationData) {
            Destination::create($destinationData);
        }

        $destinations = Destination::all();

        // Create activities
        $activities = [
            [
                'destination_id' => $destinations->where('name', 'Tokyo')->first()->id,
                'name' => 'Tokyo City Tour',
                'description' => 'Explore the vibrant city of Tokyo with our comprehensive city tour. Visit famous landmarks including Senso-ji Temple, Tokyo Skytree, and the bustling Shibuya crossing.',
                'short_description' => 'Comprehensive tour of Tokyo\'s most famous landmarks',
                'category' => 'Sightseeing',
                'subcategory' => 'City Tour',
                'duration' => '8 hours',
                'difficulty_level' => 'easy',
                'min_age' => 5,
                'max_group_size' => 20,
                'price' => 120.00,
                'original_price' => 150.00,
                'discount_percentage' => 20,
                'currency' => 'USD',
                'image_url' => 'https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'gallery_images' => [
                    'https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                    'https://images.unsplash.com/photo-1493976040374-85c8e12f0c0e?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                ],
                'included_items' => ['Professional guide', 'Transportation', 'Entrance fees', 'Lunch'],
                'excluded_items' => ['Personal expenses', 'Tips'],
                'meeting_point' => 'Tokyo Station, Marunouchi Exit',
                'cancellation_policy' => 'Free cancellation up to 24 hours before the tour',
                'booking_requirements' => 'Valid passport required for non-Japanese citizens',
                'is_instant_confirmation' => true,
                'is_refundable' => true,
                'is_featured' => true,
                'is_active' => true,
                'rating' => 4.8,
                'total_bookings' => 156,
            ],
            [
                'destination_id' => $destinations->where('name', 'Kyoto')->first()->id,
                'name' => 'Traditional Tea Ceremony Experience',
                'description' => 'Immerse yourself in Japanese culture with an authentic tea ceremony experience in a traditional tea house.',
                'short_description' => 'Authentic Japanese tea ceremony in traditional setting',
                'category' => 'Cultural',
                'subcategory' => 'Tea Ceremony',
                'duration' => '2 hours',
                'difficulty_level' => 'easy',
                'min_age' => 8,
                'max_group_size' => 8,
                'price' => 85.00,
                'currency' => 'USD',
                'image_url' => 'https://images.unsplash.com/photo-1493976040374-85c8e12f0c0e?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'included_items' => ['Tea ceremony experience', 'Traditional sweets', 'Kimono rental'],
                'excluded_items' => ['Transportation', 'Personal expenses'],
                'meeting_point' => 'Kyoto Traditional Tea House',
                'cancellation_policy' => 'Free cancellation up to 48 hours before the experience',
                'is_instant_confirmation' => true,
                'is_refundable' => true,
                'is_featured' => true,
                'is_active' => true,
                'rating' => 4.9,
                'total_bookings' => 89,
            ],
            [
                'destination_id' => $destinations->where('name', 'Bangkok')->first()->id,
                'name' => 'Bangkok Food Tour',
                'description' => 'Discover the authentic flavors of Bangkok with our guided food tour through local markets and street food stalls.',
                'short_description' => 'Authentic Thai food experience in local markets',
                'category' => 'Food',
                'subcategory' => 'Food Tour',
                'duration' => '4 hours',
                'difficulty_level' => 'easy',
                'min_age' => 12,
                'max_group_size' => 12,
                'price' => 65.00,
                'currency' => 'USD',
                'image_url' => 'https://images.unsplash.com/photo-1552465011-b4e21bf6e79a?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'included_items' => ['Food samples', 'Professional guide', 'Water'],
                'excluded_items' => ['Additional food', 'Transportation'],
                'meeting_point' => 'Chatuchak Weekend Market',
                'cancellation_policy' => 'Free cancellation up to 24 hours before the tour',
                'is_instant_confirmation' => true,
                'is_refundable' => true,
                'is_featured' => true,
                'is_active' => true,
                'rating' => 4.7,
                'total_bookings' => 203,
            ],
            [
                'destination_id' => $destinations->where('name', 'Bali')->first()->id,
                'name' => 'Bali Rice Terraces Trekking',
                'description' => 'Experience the beauty of Bali\'s famous rice terraces with a guided trekking tour through the countryside.',
                'short_description' => 'Scenic trekking through Bali\'s iconic rice terraces',
                'category' => 'Adventure',
                'subcategory' => 'Trekking',
                'duration' => '6 hours',
                'difficulty_level' => 'moderate',
                'min_age' => 10,
                'max_group_size' => 15,
                'price' => 75.00,
                'currency' => 'USD',
                'image_url' => 'https://images.unsplash.com/photo-1537953773345-d172ccf13cf1?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'included_items' => ['Professional guide', 'Lunch', 'Water', 'Trekking equipment'],
                'excluded_items' => ['Personal expenses', 'Tips'],
                'meeting_point' => 'Tegallalang Rice Terraces',
                'cancellation_policy' => 'Free cancellation up to 48 hours before the tour',
                'is_instant_confirmation' => true,
                'is_refundable' => true,
                'is_featured' => true,
                'is_active' => true,
                'rating' => 4.6,
                'total_bookings' => 134,
            ],
        ];

        foreach ($activities as $activityData) {
            Activity::create($activityData);
        }

        // Create hotels
        $hotels = [
            [
                'destination_id' => $destinations->where('name', 'Tokyo')->first()->id,
                'name' => 'Tokyo Grand Hotel',
                'description' => 'Luxury hotel in the heart of Tokyo with modern amenities and excellent service.',
                'short_description' => 'Luxury hotel in central Tokyo',
                'star_rating' => 5,
                'address' => '1-1-1 Marunouchi, Chiyoda-ku, Tokyo 100-0005',
                'latitude' => 35.6762,
                'longitude' => 139.6503,
                'phone' => '+81-3-1234-5678',
                'email' => 'info@tokyogrand.com',
                'website' => 'https://tokyogrand.com',
                'check_in_time' => '15:00',
                'check_out_time' => '11:00',
                'amenities' => ['WiFi', 'Pool', 'Spa', 'Restaurant', 'Gym', 'Concierge'],
                'facilities' => ['Business Center', 'Meeting Rooms', 'Laundry Service', 'Room Service'],
                'room_types' => ['Standard', 'Deluxe', 'Suite'],
                'price_per_night' => 350.00,
                'currency' => 'USD',
                'image_url' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'cancellation_policy' => 'Free cancellation up to 24 hours before check-in',
                'is_pet_friendly' => false,
                'is_featured' => true,
                'is_active' => true,
                'rating' => 4.8,
                'total_reviews' => 245,
            ],
            [
                'destination_id' => $destinations->where('name', 'Kyoto')->first()->id,
                'name' => 'Kyoto Traditional Inn',
                'description' => 'Authentic ryokan experience with traditional Japanese hospitality and tatami rooms.',
                'short_description' => 'Traditional ryokan with authentic Japanese experience',
                'star_rating' => 4,
                'address' => '123 Gion, Higashiyama-ku, Kyoto 605-0073',
                'latitude' => 35.0116,
                'longitude' => 135.7681,
                'phone' => '+81-75-123-4567',
                'email' => 'info@kyototraditional.com',
                'amenities' => ['WiFi', 'Traditional Bath', 'Kaiseki Dinner', 'Garden'],
                'facilities' => ['Concierge', 'Cultural Activities', 'Tea Ceremony'],
                'room_types' => ['Tatami Room', 'Deluxe Tatami'],
                'price_per_night' => 280.00,
                'currency' => 'USD',
                'image_url' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'cancellation_policy' => 'Free cancellation up to 48 hours before check-in',
                'is_pet_friendly' => false,
                'is_featured' => true,
                'is_active' => true,
                'rating' => 4.9,
                'total_reviews' => 189,
            ],
            [
                'destination_id' => $destinations->where('name', 'Bangkok')->first()->id,
                'name' => 'Bangkok Riverside Hotel',
                'description' => 'Modern hotel with stunning river views and easy access to Bangkok\'s attractions.',
                'short_description' => 'Modern hotel with beautiful river views',
                'star_rating' => 4,
                'address' => '456 Charoen Krung Road, Bang Rak, Bangkok 10500',
                'latitude' => 13.7563,
                'longitude' => 100.5018,
                'phone' => '+66-2-123-4567',
                'email' => 'info@bangkokriverside.com',
                'amenities' => ['WiFi', 'Pool', 'Restaurant', 'Spa', 'Gym'],
                'facilities' => ['Business Center', 'Tour Desk', 'Airport Shuttle'],
                'room_types' => ['Standard', 'Deluxe', 'River View'],
                'price_per_night' => 120.00,
                'currency' => 'USD',
                'image_url' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'cancellation_policy' => 'Free cancellation up to 24 hours before check-in',
                'is_pet_friendly' => true,
                'is_featured' => true,
                'is_active' => true,
                'rating' => 4.5,
                'total_reviews' => 312,
            ],
        ];

        foreach ($hotels as $hotelData) {
            Hotel::create($hotelData);
        }

        // Create sample reviews
        $activities = Activity::all();
        $hotels = Hotel::all();

        foreach ($activities->take(2) as $activity) {
            foreach ($users->take(3) as $user) {
                Review::create([
                    'user_id' => $user->id,
                    'activity_id' => $activity->id,
                    'destination_id' => $activity->destination_id,
                    'rating' => rand(4, 5),
                    'title' => 'Amazing experience!',
                    'comment' => 'This was one of the best activities I\'ve ever done. Highly recommended for anyone visiting this destination.',
                    'review_type' => 'activity',
                    'is_verified' => true,
                    'travel_date' => now()->subDays(rand(1, 30)),
                    'travel_type' => ['Solo', 'Couple', 'Family'][rand(0, 2)],
                ]);
            }
        }

        foreach ($hotels->take(2) as $hotel) {
            foreach ($users->take(3) as $user) {
                Review::create([
                    'user_id' => $user->id,
                    'hotel_id' => $hotel->id,
                    'destination_id' => $hotel->destination_id,
                    'rating' => rand(4, 5),
                    'title' => 'Excellent hotel!',
                    'comment' => 'Great location, friendly staff, and comfortable rooms. Would definitely stay here again.',
                    'review_type' => 'hotel',
                    'is_verified' => true,
                    'travel_date' => now()->subDays(rand(1, 30)),
                    'travel_type' => ['Solo', 'Couple', 'Family'][rand(0, 2)],
        ]);
    }
}

        // Create sample bookings
        foreach ($users->take(5) as $user) {
            $activity = $activities->random();
            Booking::create([
                'user_id' => $user->id,
                'destination_id' => $activity->destination_id,
                'activity_id' => $activity->id,
                'booking_type' => 'activity',
                'booking_reference' => 'BK' . strtoupper(substr(md5(uniqid()), 0, 8)),
                'booking_date' => now()->subDays(rand(1, 10)),
                'check_in_date' => now()->addDays(rand(1, 30)),
                'adult_count' => rand(1, 3),
                'child_count' => rand(0, 2),
                'infant_count' => rand(0, 1),
                'total_amount' => $activity->price * rand(1, 3),
                'currency' => 'USD',
                'payment_status' => 'paid',
                'payment_method' => 'credit_card',
                'payment_reference' => 'PAY' . strtoupper(substr(md5(uniqid()), 0, 8)),
                'booking_status' => 'confirmed',
                'contact_email' => $user->email,
                'contact_phone' => '+1234567890',
            ]);
        }
    }
}