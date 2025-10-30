@extends('layouts.app')

@section('title', $hotel->name . ' - TravelApp')
@section('description', Str::limit($hotel->description, 160))

@section('content')
<!-- Hero Section -->
<section class="hero-section bg-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('destinations.show', $hotel->destination) }}" class="text-white">{{ $hotel->destination->name }}</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">{{ $hotel->name }}</li>
                    </ol>
                </nav>
                <h1 class="display-4 fw-bold mb-3">{{ $hotel->name }}</h1>
                <p class="lead mb-4">{{ $hotel->short_description ?: Str::limit($hotel->description, 200) }}</p>
                <div class="d-flex align-items-center gap-4 mb-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-star text-warning me-2"></i>
                        <span class="fw-semibold">{{ number_format($hotel->average_rating, 1) }}</span>
                        <span class="ms-2">({{ $hotel->total_reviews }} reviews)</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <span class="badge bg-warning text-dark me-2">
                            @for($i = 0; $i < $hotel->star_rating; $i++)
                                <i class="fas fa-star"></i>
                            @endfor
                        </span>
                        <span>{{ $hotel->star_rating }} Star Hotel</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-map-marker-alt me-2"></i>
                        <span>{{ $hotel->destination->name }}</span>
                    </div>
                </div>
                <div class="d-flex gap-3">
                    @auth
                        <a href="{{ route('bookings.create.hotel', $hotel) }}" class="btn btn-light btn-lg">
                            <i class="fas fa-calendar-check me-2"></i>Book Now
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-light btn-lg">
                            <i class="fas fa-calendar-check me-2"></i>Login to Book
                        </a>
                    @endauth
                    <a href="#reviews" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-star me-2"></i>View Reviews
                    </a>
                </div>
            </div>
            <div class="col-lg-4">
                <img src="{{ $hotel->image_url ?: 'https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}" 
                     alt="{{ $hotel->name }}" class="img-fluid rounded-3 shadow-lg">
            </div>
        </div>
    </div>
</section>

<!-- Hotel Details -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!-- Description -->
                <div class="mb-5">
                    <h3 class="fw-bold mb-3">About This Hotel</h3>
                    <p class="text-muted">{{ $hotel->description }}</p>
                </div>

                <!-- Gallery -->
                @if($hotel->gallery_images && count($hotel->gallery_images) > 0)
                <div class="mb-5">
                    <h3 class="fw-bold mb-3">Gallery</h3>
                    <div class="row g-3">
                        @foreach($hotel->gallery_images as $image)
                        <div class="col-lg-4 col-md-6">
                            <img src="{{ $image }}" alt="Hotel Image" class="img-fluid rounded shadow-sm" style="height: 200px; width: 100%; object-fit: cover;">
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Amenities -->
                @if($hotel->amenities && count($hotel->amenities) > 0)
                <div class="mb-5">
                    <h3 class="fw-bold mb-3">Amenities</h3>
                    <div class="row g-3">
                        @foreach($hotel->amenities as $amenity)
                        <div class="col-md-4">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check text-success me-3"></i>
                                <span>{{ $amenity }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Facilities -->
                @if($hotel->facilities && count($hotel->facilities) > 0)
                <div class="mb-5">
                    <h3 class="fw-bold mb-3">Facilities</h3>
                    <div class="row g-3">
                        @foreach($hotel->facilities as $facility)
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-building text-primary me-3"></i>
                                <span>{{ $facility }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Room Types -->
                @if($hotel->room_types && count($hotel->room_types) > 0)
                <div class="mb-5">
                    <h3 class="fw-bold mb-3">Room Types</h3>
                    <div class="row g-3">
                        @foreach($hotel->room_types as $roomType)
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <h6 class="fw-bold">{{ $roomType }}</h6>
                                    <p class="text-muted small">Comfortable and well-equipped rooms</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Reviews -->
                @if($hotel->reviews->count() > 0)
                <div id="reviews" class="mb-5">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="fw-bold mb-0">Reviews</h3>
                        <a href="{{ route('reviews.hotel', $hotel) }}" class="btn btn-outline-primary">
                            View All Reviews
                        </a>
                    </div>
                    <div class="row g-4">
                        @foreach($hotel->reviews->take(3) as $review)
                        <div class="col-12">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="me-3">
                                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                <span class="text-white fw-bold">{{ substr($review->user->name, 0, 1) }}</span>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="fw-bold mb-1">{{ $review->user->name }}</h6>
                                            <div class="d-flex align-items-center">
                                                <div class="me-2">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <i class="fas fa-star {{ $i <= $review->rating ? 'text-warning' : 'text-muted' }}"></i>
                                                    @endfor
                                                </div>
                                                <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                                            </div>
                                        </div>
                                    </div>
                                    <h6 class="fw-bold">{{ $review->title }}</h6>
                                    <p class="text-muted">{{ $review->comment }}</p>
                                    @if($review->travel_date)
                                        <small class="text-muted">
                                            <i class="fas fa-calendar me-1"></i>Stayed {{ $review->travel_date->format('F Y') }}
                                        </small>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="sticky-top" style="top: 2rem;">
                    <!-- Booking Card -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <h3 class="fw-bold text-primary">${{ number_format($hotel->price_per_night, 2) }}</h3>
                                <small class="text-muted">per night</small>
                            </div>
                            
                            @auth
                                <a href="{{ route('bookings.create.hotel', $hotel) }}" class="btn btn-primary btn-lg w-100 mb-3">
                                    <i class="fas fa-calendar-check me-2"></i>Book Now
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-primary btn-lg w-100 mb-3">
                                    <i class="fas fa-sign-in-alt me-2"></i>Login to Book
                                </a>
                            @endauth

                            <div class="row text-center">
                                <div class="col-4">
                                    <div class="fw-bold">{{ $hotel->average_rating }}</div>
                                    <small class="text-muted">Rating</small>
                                </div>
                                <div class="col-4">
                                    <div class="fw-bold">{{ $hotel->total_reviews }}</div>
                                    <small class="text-muted">Reviews</small>
                                </div>
                                <div class="col-4">
                                    <div class="fw-bold">{{ $hotel->star_rating }}</div>
                                    <small class="text-muted">Stars</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Hotel Info -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Hotel Information</h5>
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-map-marker-alt text-primary me-3"></i>
                                        <div>
                                            <small class="text-muted">Address</small>
                                            <div class="fw-semibold">{{ $hotel->address }}</div>
                                        </div>
                                    </div>
                                </div>
                                @if($hotel->phone)
                                <div class="col-12">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-phone text-primary me-3"></i>
                                        <div>
                                            <small class="text-muted">Phone</small>
                                            <div class="fw-semibold">{{ $hotel->phone }}</div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if($hotel->email)
                                <div class="col-12">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-envelope text-primary me-3"></i>
                                        <div>
                                            <small class="text-muted">Email</small>
                                            <div class="fw-semibold">{{ $hotel->email }}</div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="col-12">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-clock text-primary me-3"></i>
                                        <div>
                                            <small class="text-muted">Check-in/out</small>
                                            <div class="fw-semibold">
                                                {{ $hotel->check_in_time ?: '15:00' }} / {{ $hotel->check_out_time ?: '11:00' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-paw text-primary me-3"></i>
                                        <div>
                                            <small class="text-muted">Pet Friendly</small>
                                            <div class="fw-semibold">{{ $hotel->is_pet_friendly ? 'Yes' : 'No' }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Related Hotels -->
                    @if($relatedHotels->count() > 0)
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Related Hotels</h5>
                            @foreach($relatedHotels as $related)
                            <div class="d-flex align-items-center mb-3">
                                <img src="{{ $related->image_url ?: 'https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80' }}" 
                                     alt="{{ $related->name }}" class="rounded me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                <div class="flex-grow-1">
                                    <h6 class="fw-bold mb-1">{{ $related->name }}</h6>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-star text-warning me-1"></i>
                                        <small class="text-muted">{{ number_format($related->average_rating, 1) }}</small>
                                        <span class="badge bg-warning text-dark ms-2">
                                            @for($i = 0; $i < $related->star_rating; $i++)
                                                <i class="fas fa-star"></i>
                                            @endfor
                                        </span>
                                    </div>
                                </div>
                                <a href="{{ route('hotels.show', $related) }}" class="btn btn-outline-primary btn-sm">
                                    View
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
.hero-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.breadcrumb {
    background: transparent;
    padding: 0;
}

.breadcrumb-item a {
    text-decoration: none;
}

.breadcrumb-item a:hover {
    text-decoration: underline;
}

.sticky-top {
    position: sticky;
    top: 2rem;
}

.card:hover {
    transform: translateY(-2px);
    transition: transform 0.3s ease;
}
</style>
@endpush
