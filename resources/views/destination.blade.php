@extends('layouts.app')

@section('title', $destination->name . ' - TravelApp')
@section('description', Str::limit($destination->description, 160))

@section('content')
<!-- Hero Section -->
<section class="hero-section bg-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('search', ['country' => $destination->country]) }}" class="text-white">{{ $destination->country }}</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">{{ $destination->name }}</li>
                    </ol>
                </nav>
                <h1 class="display-4 fw-bold mb-3">{{ $destination->name }}</h1>
                <p class="lead mb-4">{{ $destination->description }}</p>
                <div class="d-flex align-items-center gap-4 mb-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-star text-warning me-2"></i>
                        <span class="fw-semibold">{{ number_format($destination->average_rating, 1) }}</span>
                        <span class="ms-2">({{ $destination->total_reviews }} reviews)</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-map-marker-alt me-2"></i>
                        <span>{{ $destination->location }}</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-flag me-2"></i>
                        <span>{{ $destination->country }}</span>
                    </div>
                </div>
                <div class="d-flex gap-3">
                    <a href="#activities" class="btn btn-light btn-lg">
                        <i class="fas fa-hiking me-2"></i>View Activities
                    </a>
                    <a href="#hotels" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-bed me-2"></i>Find Hotels
                    </a>
                </div>
            </div>
            <div class="col-lg-4">
                <img src="{{ $destination->featured_image ?: $destination->image_url ?: 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}" 
                     alt="{{ $destination->name }}" class="img-fluid rounded-3 shadow-lg">
            </div>
        </div>
    </div>
</section>

<!-- Destination Info -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!-- Activities Section -->
                @if($destination->activities->count() > 0)
                <div id="activities" class="mb-5">
                    <h3 class="fw-bold mb-4">Popular Activities</h3>
                    <div class="row g-4">
                        @foreach($destination->activities->take(6) as $activity)
                        <div class="col-lg-4 col-md-6">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="position-relative">
                                    <img src="{{ $activity->image_url ?: 'https://images.unsplash.com/photo-1551632811-561732d1e306?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80' }}" 
                                         class="card-img-top" alt="{{ $activity->name }}" style="height: 180px; object-fit: cover;">
                                    @if($activity->discount_percentage > 0)
                                        <div class="position-absolute top-0 end-0 m-2">
                                            <span class="badge bg-danger">{{ $activity->discount_percentage }}% OFF</span>
                                        </div>
                                    @endif
                                    <div class="position-absolute bottom-0 start-0 m-2">
                                        <div class="d-flex align-items-center text-white">
                                            <i class="fas fa-star text-warning me-1"></i>
                                            <span class="fw-semibold">{{ number_format($activity->average_rating, 1) }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h6 class="card-title fw-bold">{{ $activity->name }}</h6>
                                    <p class="card-text text-muted small">{{ Str::limit($activity->short_description ?: $activity->description, 80) }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            @if($activity->discount_percentage > 0)
                                                <span class="text-decoration-line-through text-muted small">${{ number_format($activity->original_price, 2) }}</span>
                                                <span class="fw-bold text-primary ms-2">${{ number_format($activity->discounted_price, 2) }}</span>
                                            @else
                                                <span class="fw-bold text-primary">${{ number_format($activity->price, 2) }}</span>
                                            @endif
                                        </div>
                                        <a href="{{ route('activities.show', $activity) }}" class="btn btn-outline-primary btn-sm">
                                            View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @if($destination->activities->count() > 6)
                    <div class="text-center mt-4">
                        <a href="{{ route('search', ['type' => 'activities', 'q' => $destination->name]) }}" class="btn btn-primary">
                            View All Activities <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                    @endif
                </div>
                @endif

                <!-- Hotels Section -->
                @if($destination->hotels->count() > 0)
                <div id="hotels" class="mb-5">
                    <h3 class="fw-bold mb-4">Recommended Hotels</h3>
                    <div class="row g-4">
                        @foreach($destination->hotels->take(6) as $hotel)
                        <div class="col-lg-4 col-md-6">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="position-relative">
                                    <img src="{{ $hotel->image_url ?: 'https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80' }}" 
                                         class="card-img-top" alt="{{ $hotel->name }}" style="height: 180px; object-fit: cover;">
                                    <div class="position-absolute top-0 end-0 m-2">
                                        <span class="badge bg-warning text-dark">
                                            @for($i = 0; $i < $hotel->star_rating; $i++)
                                                <i class="fas fa-star"></i>
                                            @endfor
                                        </span>
                                    </div>
                                    <div class="position-absolute bottom-0 start-0 m-2">
                                        <div class="d-flex align-items-center text-white">
                                            <i class="fas fa-star text-warning me-1"></i>
                                            <span class="fw-semibold">{{ number_format($hotel->average_rating, 1) }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h6 class="card-title fw-bold">{{ $hotel->name }}</h6>
                                    <p class="card-text text-muted small">{{ Str::limit($hotel->short_description ?: $hotel->description, 80) }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <span class="fw-bold text-primary">${{ number_format($hotel->price_per_night, 2) }}</span>
                                            <small class="text-muted">/night</small>
                                        </div>
                                        <a href="{{ route('hotels.show', $hotel) }}" class="btn btn-outline-primary btn-sm">
                                            View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @if($destination->hotels->count() > 6)
                    <div class="text-center mt-4">
                        <a href="{{ route('search', ['type' => 'hotels', 'q' => $destination->name]) }}" class="btn btn-primary">
                            View All Hotels <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                    @endif
                </div>
                @endif

                <!-- Reviews Section -->
                @if($destination->reviews->count() > 0)
                <div class="mb-5">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="fw-bold mb-0">Reviews</h3>
                        <a href="{{ route('reviews.destination', $destination) }}" class="btn btn-outline-primary">
                            View All Reviews
                        </a>
                    </div>
                    <div class="row g-4">
                        @foreach($destination->reviews->take(3) as $review)
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
                                            <i class="fas fa-calendar me-1"></i>Traveled {{ $review->travel_date->format('F Y') }}
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
                    <!-- Destination Info Card -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Destination Info</h5>
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-map-marker-alt text-primary me-3"></i>
                                        <div>
                                            <small class="text-muted">Location</small>
                                            <div class="fw-semibold">{{ $destination->location }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-flag text-primary me-3"></i>
                                        <div>
                                            <small class="text-muted">Country</small>
                                            <div class="fw-semibold">{{ $destination->country }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-tag text-primary me-3"></i>
                                        <div>
                                            <small class="text-muted">Category</small>
                                            <div class="fw-semibold">{{ $destination->category }}</div>
                                        </div>
                                    </div>
                                </div>
                                @if($destination->best_time_to_visit)
                                <div class="col-12">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-calendar-alt text-primary me-3"></i>
                                        <div>
                                            <small class="text-muted">Best Time to Visit</small>
                                            <div class="fw-semibold">{{ $destination->best_time_to_visit }}</div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if($destination->language)
                                <div class="col-12">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-language text-primary me-3"></i>
                                        <div>
                                            <small class="text-muted">Language</small>
                                            <div class="fw-semibold">{{ $destination->language }}</div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if($destination->currency)
                                <div class="col-12">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-dollar-sign text-primary me-3"></i>
                                        <div>
                                            <small class="text-muted">Currency</small>
                                            <div class="fw-semibold">{{ $destination->currency }}</div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Related Destinations -->
                    @if($relatedDestinations->count() > 0)
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Related Destinations</h5>
                            @foreach($relatedDestinations as $related)
                            <div class="d-flex align-items-center mb-3">
                                <img src="{{ $related->image_url ?: 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80' }}" 
                                     alt="{{ $related->name }}" class="rounded me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                <div class="flex-grow-1">
                                    <h6 class="fw-bold mb-1">{{ $related->name }}</h6>
                                    <small class="text-muted">{{ $related->country }}</small>
                                </div>
                                <a href="{{ route('destinations.show', $related) }}" class="btn btn-outline-primary btn-sm">
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
