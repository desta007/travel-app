@extends('layouts.app')

@section('title', 'TravelApp - Discover Amazing Destinations')
@section('description', 'Discover amazing destinations, book activities, and find the perfect hotels for your next adventure.')

@section('content')
<!-- Hero Section -->
<section class="hero-section bg-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center min-vh-50">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">Discover Amazing Destinations</h1>
                <p class="lead mb-4">Explore the world's most beautiful places, book exciting activities, and find the perfect accommodations for your next adventure.</p>
                <div class="d-flex gap-3">
                    <a href="{{ route('search', ['type' => 'destinations']) }}" class="btn btn-light btn-lg">
                        <i class="fas fa-map-marker-alt me-2"></i>Explore Destinations
                    </a>
                    <a href="{{ route('search', ['type' => 'activities']) }}" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-hiking me-2"></i>Find Activities
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-image">
                    <img src="https://images.unsplash.com/photo-1488646953014-85cb44e25828?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" 
                         alt="Travel Destination" class="img-fluid rounded-3 shadow-lg">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Search Bar -->
<section class="search-section py-4 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="filter-card">
                    <div class="filter-card-header">
                        <i class="fas fa-search me-2"></i>Find Your Next Adventure
                    </div>
                    <div class="filter-card-body">
                        <form action="{{ route('search') }}" method="GET">
                            <div class="row g-3 align-items-end">
                                <div class="col-lg-4 col-md-6">
                                    <label class="filter-label">
                                        <i class="fas fa-map-marker-alt me-1"></i>Where to?
                                    </label>
                                    <div class="filter-input-wrapper">
                                        <input type="text" class="form-control filter-input" name="q" placeholder="Search destinations, activities, hotels..." value="{{ request('q') }}">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <label class="filter-label">
                                        <i class="fas fa-layer-group me-1"></i>Type
                                    </label>
                                    <select class="form-select filter-input" name="type">
                                        <option value="all" {{ request('type') == 'all' ? 'selected' : '' }}>All Types</option>
                                        <option value="destinations" {{ request('type') == 'destinations' ? 'selected' : '' }}>Destinations</option>
                                        <option value="activities" {{ request('type') == 'activities' ? 'selected' : '' }}>Activities</option>
                                        <option value="hotels" {{ request('type') == 'hotels' ? 'selected' : '' }}>Hotels</option>
                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <label class="filter-label">
                                        <i class="fas fa-globe me-1"></i>Country
                                    </label>
                                    <select class="form-select filter-input" name="country">
                                        <option value="">All Countries</option>
                                        @foreach($countries as $countryItem)
                                            <option value="{{ $countryItem }}" {{ request('country') == $countryItem ? 'selected' : '' }}>{{ $countryItem }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <button type="submit" class="btn btn-search-filter w-100">
                                        <i class="fas fa-search me-2"></i>Search
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Destinations -->
@if($featuredDestinations->count() > 0)
<section class="py-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="fw-bold mb-3">Featured Destinations</h2>
                <p class="text-muted">Discover the most popular destinations around the world</p>
            </div>
        </div>
        <div class="row g-4">
            @foreach($featuredDestinations as $destination)
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm destination-card">
                    <div class="position-relative">
                        <img src="{{ $destination->image_url ?: 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80' }}" 
                             class="card-img-top" alt="{{ $destination->name }}" style="height: 250px; object-fit: cover;">
                        <div class="position-absolute top-0 end-0 m-3">
                            <span class="badge bg-primary">{{ $destination->country }}</span>
                        </div>
                        <div class="position-absolute bottom-0 start-0 m-3">
                            <div class="d-flex align-items-center text-white">
                                <i class="fas fa-star text-warning me-1"></i>
                                <span class="fw-semibold">{{ number_format($destination->average_rating, 1) }}</span>
                                <span class="ms-2">({{ $destination->total_reviews }})</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title fw-bold">{{ $destination->name }}</h5>
                        <p class="card-text text-muted">{{ Str::limit($destination->description, 100) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                <i class="fas fa-map-marker-alt me-1"></i>{{ $destination->location }}
                            </small>
                            <a href="{{ route('destinations.show', $destination) }}" class="btn btn-outline-primary btn-sm">
                                Explore <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('search', ['type' => 'destinations']) }}" class="btn btn-primary">
                View All Destinations <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>
@endif

<!-- Featured Activities -->
@if($featuredActivities->count() > 0)
<section class="py-5 bg-light">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="fw-bold mb-3">Popular Activities</h2>
                <p class="text-muted">Book exciting activities and experiences</p>
            </div>
        </div>
        <div class="row g-4">
            @foreach($featuredActivities as $activity)
            <div class="col-lg-3 col-md-6">
                <div class="card h-100 border-0 shadow-sm activity-card">
                    <div class="position-relative">
                        <img src="{{ $activity->image_url ?: 'https://images.unsplash.com/photo-1551632811-561732d1e306?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80' }}" 
                             class="card-img-top" alt="{{ $activity->name }}" style="height: 200px; object-fit: cover;">
                        <div class="position-absolute top-0 end-0 m-2">
                            @if($activity->discount_percentage > 0)
                                <span class="badge bg-danger">{{ $activity->discount_percentage }}% OFF</span>
                            @endif
                        </div>
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
        <div class="text-center mt-4">
            <a href="{{ route('search', ['type' => 'activities']) }}" class="btn btn-primary">
                View All Activities <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>
@endif

<!-- Featured Hotels -->
@if($featuredHotels->count() > 0)
<section class="py-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="fw-bold mb-3">Recommended Hotels</h2>
                <p class="text-muted">Find the perfect place to stay</p>
            </div>
        </div>
        <div class="row g-4">
            @foreach($featuredHotels as $hotel)
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm hotel-card">
                    <div class="position-relative">
                        <img src="{{ $hotel->image_url ?: 'https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80' }}" 
                             class="card-img-top" alt="{{ $hotel->name }}" style="height: 200px; object-fit: cover;">
                        <div class="position-absolute top-0 end-0 m-3">
                            <span class="badge bg-warning text-dark">
                                @for($i = 0; $i < $hotel->star_rating; $i++)
                                    <i class="fas fa-star"></i>
                                @endfor
                            </span>
                        </div>
                        <div class="position-absolute bottom-0 start-0 m-3">
                            <div class="d-flex align-items-center text-white">
                                <i class="fas fa-star text-warning me-1"></i>
                                <span class="fw-semibold">{{ number_format($hotel->average_rating, 1) }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title fw-bold">{{ $hotel->name }}</h5>
                        <p class="card-text text-muted">{{ Str::limit($hotel->short_description ?: $hotel->description, 100) }}</p>
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
        <div class="text-center mt-4">
            <a href="{{ route('search', ['type' => 'hotels']) }}" class="btn btn-primary">
                View All Hotels <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>
@endif

<!-- Popular Destinations -->
@if($popularDestinations->count() > 0)
<section class="py-5 bg-light">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="fw-bold mb-3">Popular This Month</h2>
                <p class="text-muted">Trending destinations based on bookings and reviews</p>
            </div>
        </div>
        <div class="row g-4">
            @foreach($popularDestinations as $destination)
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="position-relative">
                        <img src="{{ $destination->image_url ?: 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80' }}" 
                             class="card-img-top" alt="{{ $destination->name }}" style="height: 180px; object-fit: cover;">
                        <div class="position-absolute top-0 end-0 m-2">
                            <span class="badge bg-success">Popular</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="card-title fw-bold">{{ $destination->name }}</h6>
                        <p class="card-text text-muted small">{{ $destination->country }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-star text-warning me-1"></i>
                                <span class="small">{{ number_format($destination->average_rating, 1) }}</span>
                            </div>
                            <a href="{{ route('destinations.show', $destination) }}" class="btn btn-outline-primary btn-sm">
                                Explore
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Newsletter Section -->
<section class="py-5 bg-primary text-white">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-6">
                <h3 class="fw-bold mb-3">Stay Updated</h3>
                <p class="mb-4">Get the latest travel deals and destination inspiration delivered to your inbox.</p>
                <form class="d-flex gap-2">
                    <input type="email" class="form-control" placeholder="Enter your email">
                    <button type="submit" class="btn btn-light">Subscribe</button>
                </form>
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

.min-vh-50 {
    min-height: 50vh;
}

.destination-card:hover,
.activity-card:hover,
.hotel-card:hover {
    transform: translateY(-5px);
    transition: transform 0.3s ease;
}

.card-img-top {
    transition: transform 0.3s ease;
}

.card:hover .card-img-top {
    transform: scale(1.05);
}

/* Filter Card (same as search page) */
.filter-card {
    background: #ffffff;
    border-radius: 16px;
    box-shadow: 0 4px 24px rgba(0, 0, 0, 0.06);
    overflow: hidden;
    border: 1px solid rgba(102, 126, 234, 0.08);
}

.filter-card-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #ffffff;
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    font-size: 0.9rem;
    letter-spacing: 0.3px;
}

.filter-card-body {
    padding: 1.5rem;
}

.filter-label {
    display: block;
    font-size: 0.8rem;
    font-weight: 600;
    color: #4a5568;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0.5rem;
}

.filter-label i {
    color: #667eea;
    font-size: 0.75rem;
}

.filter-input {
    border: 2px solid #e8ecf4;
    border-radius: 10px;
    padding: 0.65rem 1rem;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    background: #f8f9fc;
}

.filter-input:focus {
    border-color: #667eea;
    background: #ffffff;
    box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
}

.filter-input::placeholder {
    color: #a0aec0;
}

.btn-search-filter {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #ffffff;
    border: none;
    border-radius: 10px;
    padding: 0.7rem 1.5rem;
    font-weight: 600;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

.btn-search-filter:hover {
    color: #ffffff;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(102, 126, 234, 0.45);
}
</style>
@endpush
