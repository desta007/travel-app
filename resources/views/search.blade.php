@extends('layouts.app')

@section('title', 'Search Results - TravelApp')
@section('description', 'Search results for destinations, activities, and hotels')

@section('content')
<div class="container py-4">
    <!-- Search Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="fw-bold mb-3">Search Results</h1>
            @if($query)
                <p class="text-muted">Results for "<strong>{{ $query }}</strong>"</p>
            @endif
        </div>
    </div>

    <!-- Search Filters -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form action="{{ route('search') }}" method="GET" class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Search</label>
                            <input type="text" class="form-control" name="q" placeholder="Search..." value="{{ $query }}">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-semibold">Type</label>
                            <select class="form-select" name="type">
                                <option value="all" {{ $type == 'all' ? 'selected' : '' }}>All</option>
                                <option value="destinations" {{ $type == 'destinations' ? 'selected' : '' }}>Destinations</option>
                                <option value="activities" {{ $type == 'activities' ? 'selected' : '' }}>Activities</option>
                                <option value="hotels" {{ $type == 'hotels' ? 'selected' : '' }}>Hotels</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-semibold">Country</label>
                            <select class="form-select" name="country">
                                <option value="">All Countries</option>
                                @foreach($countries as $countryOption)
                                    <option value="{{ $countryOption }}" {{ $country == $countryOption ? 'selected' : '' }}>{{ $countryOption }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-semibold">Category</label>
                            <select class="form-select" name="category">
                                <option value="">All Categories</option>
                                @foreach($categories as $categoryOption)
                                    <option value="{{ $categoryOption }}" {{ $category == $categoryOption ? 'selected' : '' }}>{{ $categoryOption }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-semibold">Price Range</label>
                            <div class="d-flex gap-1">
                                <input type="number" class="form-control" name="min_price" placeholder="Min" value="{{ $minPrice }}">
                                <input type="number" class="form-control" name="max_price" placeholder="Max" value="{{ $maxPrice }}">
                            </div>
                        </div>
                        <div class="col-md-1 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Results Count -->
    <div class="row mb-4">
        <div class="col-12">
            @php
                $totalResults = $destinations->count() + $activities->count() + $hotels->count();
            @endphp
            <p class="text-muted">{{ $totalResults }} results found</p>
        </div>
    </div>

    <!-- Destinations Results -->
    @if($destinations->count() > 0)
    <div class="row mb-5">
        <div class="col-12">
            <h3 class="fw-bold mb-4">Destinations ({{ $destinations->count() }})</h3>
        </div>
        @foreach($destinations as $destination)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="position-relative">
                    <img src="{{ $destination->image_url ?: 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80' }}" 
                         class="card-img-top" alt="{{ $destination->name }}" style="height: 200px; object-fit: cover;">
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
                    <p class="card-text text-muted">{{ Str::limit($destination->description, 120) }}</p>
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
    @endif

    <!-- Activities Results -->
    @if($activities->count() > 0)
    <div class="row mb-5">
        <div class="col-12">
            <h3 class="fw-bold mb-4">Activities ({{ $activities->count() }})</h3>
        </div>
        @foreach($activities as $activity)
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="position-relative">
                    <img src="{{ $activity->image_url ?: 'https://images.unsplash.com/photo-1551632811-561732d1e306?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80' }}" 
                         class="card-img-top" alt="{{ $activity->name }}" style="height: 180px; object-fit: cover;">
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
    @endif

    <!-- Hotels Results -->
    @if($hotels->count() > 0)
    <div class="row mb-5">
        <div class="col-12">
            <h3 class="fw-bold mb-4">Hotels ({{ $hotels->count() }})</h3>
        </div>
        @foreach($hotels as $hotel)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100 border-0 shadow-sm">
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
    @endif

    <!-- No Results -->
    @if($totalResults == 0)
    <div class="row">
        <div class="col-12 text-center py-5">
            <i class="fas fa-search fa-3x text-muted mb-3"></i>
            <h4 class="fw-bold text-muted">No results found</h4>
            <p class="text-muted">Try adjusting your search criteria or browse our featured destinations.</p>
            <a href="{{ route('home') }}" class="btn btn-primary">Browse Destinations</a>
        </div>
    </div>
    @endif
</div>
@endsection

@push('styles')
<style>
.card:hover {
    transform: translateY(-2px);
    transition: transform 0.3s ease;
}

.card-img-top {
    transition: transform 0.3s ease;
}

.card:hover .card-img-top {
    transform: scale(1.05);
}
</style>
@endpush
