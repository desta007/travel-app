@extends('layouts.app')

@section('title', 'Search Results - TravelApp')
@section('description', 'Search results for destinations, activities, and hotels')

@section('content')
<div class="container py-4">
    <!-- Search Header -->
    <div class="search-page-header mb-4">
        <div class="row align-items-center">
            <div class="col-12">
                <h1 class="fw-bold mb-1 search-title">
                    <i class="fas fa-compass me-2 search-title-icon"></i>Search Results
                </h1>
                @if($query)
                    <p class="search-subtitle mb-0">Showing results for "<strong>{{ $query }}</strong>"</p>
                @else
                    <p class="search-subtitle mb-0">Browse destinations, activities & hotels</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Search Filters -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="filter-card">
                <div class="filter-card-header">
                    <i class="fas fa-sliders-h me-2"></i>Filters
                </div>
                <div class="filter-card-body">
                    <form action="{{ route('search') }}" method="GET">
                        <!-- Row 1: Search, Type, Country, Category -->
                        <div class="row g-3 mb-3">
                            <div class="col-lg-4 col-md-6">
                                <label class="filter-label">
                                    <i class="fas fa-search me-1"></i>Search
                                </label>
                                <div class="filter-input-wrapper">
                                    <input type="text" class="form-control filter-input" name="q" placeholder="Destinations, activities, hotels..." value="{{ $query }}">
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6">
                                <label class="filter-label">
                                    <i class="fas fa-layer-group me-1"></i>Type
                                </label>
                                <select class="form-select filter-input" name="type">
                                    <option value="all" {{ $type == 'all' ? 'selected' : '' }}>All Types</option>
                                    <option value="destinations" {{ $type == 'destinations' ? 'selected' : '' }}>Destinations</option>
                                    <option value="activities" {{ $type == 'activities' ? 'selected' : '' }}>Activities</option>
                                    <option value="hotels" {{ $type == 'hotels' ? 'selected' : '' }}>Hotels</option>
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <label class="filter-label">
                                    <i class="fas fa-globe me-1"></i>Country
                                </label>
                                <select class="form-select filter-input" name="country">
                                    <option value="">All Countries</option>
                                    @foreach($countries as $countryOption)
                                        <option value="{{ $countryOption }}" {{ $country == $countryOption ? 'selected' : '' }}>{{ $countryOption }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <label class="filter-label">
                                    <i class="fas fa-tags me-1"></i>Category
                                </label>
                                <select class="form-select filter-input" name="category">
                                    <option value="">All Categories</option>
                                    @foreach($categories as $categoryOption)
                                        <option value="{{ $categoryOption }}" {{ $category == $categoryOption ? 'selected' : '' }}>{{ $categoryOption }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- Row 2: Price Range + Search Button -->
                        <div class="row g-3 align-items-end">
                            <div class="col-lg-5 col-md-7">
                                <label class="filter-label">
                                    <i class="fas fa-dollar-sign me-1"></i>Price Range
                                </label>
                                <div class="price-range-wrapper">
                                    <div class="price-input-group">
                                        <span class="price-prefix">$</span>
                                        <input type="number" class="form-control filter-input price-input" name="min_price" placeholder="Min price" value="{{ $minPrice }}">
                                    </div>
                                    <span class="price-separator">
                                        <i class="fas fa-minus"></i>
                                    </span>
                                    <div class="price-input-group">
                                        <span class="price-prefix">$</span>
                                        <input type="number" class="form-control filter-input price-input" name="max_price" placeholder="Max price" value="{{ $maxPrice }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-1"></div>
                            <div class="col-lg-2 col-md-4">
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

    <!-- Results Count -->
    <div class="row mb-4">
        <div class="col-12">
            @php
                $totalResults = $destinations->count() + $activities->count() + $hotels->count();
            @endphp
            <div class="results-count-bar">
                <span class="results-count-badge">{{ $totalResults }}</span>
                <span class="results-count-text">results found</span>
                @if($query || $country || $category || $minPrice || $maxPrice)
                    <a href="{{ route('search') }}" class="results-clear-link ms-auto">
                        <i class="fas fa-times me-1"></i>Clear filters
                    </a>
                @endif
            </div>
        </div>
    </div>

    <!-- Destinations Results -->
    @if($destinations->count() > 0)
    <div class="row mb-5">
        <div class="col-12">
            <div class="section-heading-search">
                <i class="fas fa-map-marked-alt section-heading-icon"></i>
                <h3 class="fw-bold mb-0">Destinations</h3>
                <span class="section-heading-count">{{ $destinations->count() }}</span>
            </div>
        </div>
        @foreach($destinations as $destination)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="position-relative overflow-hidden">
                    <img src="{{ $destination->image_url ?: 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80' }}" 
                         class="card-img-top" alt="{{ $destination->name }}" style="height: 200px; object-fit: cover;">
                    <div class="position-absolute top-0 end-0 m-3">
                        @if($destination->average_rating > 0)
                        <span class="card-rating-badge">
                            <i class="fas fa-star me-1"></i>{{ number_format($destination->average_rating, 1) }}
                        </span>
                        @else
                        <span class="card-new-badge">New</span>
                        @endif
                    </div>
                    <div class="position-absolute top-0 start-0 m-3">
                        <span class="badge bg-primary">{{ $destination->country }}</span>
                    </div>
                    @if($destination->total_reviews > 0)
                    <div class="position-absolute bottom-0 start-0 m-3">
                        <span class="card-reviews-badge">
                            <i class="fas fa-comment me-1"></i>{{ $destination->total_reviews }} reviews
                        </span>
                    </div>
                    @endif
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
            <div class="section-heading-search">
                <i class="fas fa-hiking section-heading-icon"></i>
                <h3 class="fw-bold mb-0">Activities</h3>
                <span class="section-heading-count">{{ $activities->count() }}</span>
            </div>
        </div>
        @foreach($activities as $activity)
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="position-relative overflow-hidden">
                    <img src="{{ $activity->image_url ?: 'https://images.unsplash.com/photo-1551632811-561732d1e306?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80' }}" 
                         class="card-img-top" alt="{{ $activity->name }}" style="height: 180px; object-fit: cover;">
                    <div class="position-absolute top-0 end-0 m-2">
                        @if($activity->average_rating > 0)
                        <span class="card-rating-badge">
                            <i class="fas fa-star me-1"></i>{{ number_format($activity->average_rating, 1) }}
                        </span>
                        @else
                        <span class="card-new-badge">New</span>
                        @endif
                    </div>
                    @if($activity->discount_percentage > 0)
                    <div class="position-absolute top-0 start-0 m-2">
                        <span class="card-discount-badge">{{ $activity->discount_percentage }}% OFF</span>
                    </div>
                    @endif
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
            <div class="section-heading-search">
                <i class="fas fa-hotel section-heading-icon"></i>
                <h3 class="fw-bold mb-0">Hotels</h3>
                <span class="section-heading-count">{{ $hotels->count() }}</span>
            </div>
        </div>
        @foreach($hotels as $hotel)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="position-relative overflow-hidden">
                    <img src="{{ $hotel->image_url ?: 'https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80' }}" 
                         class="card-img-top" alt="{{ $hotel->name }}" style="height: 200px; object-fit: cover;">
                    <div class="position-absolute top-0 end-0 m-3">
                        @if($hotel->average_rating > 0)
                        <span class="card-rating-badge">
                            <i class="fas fa-star me-1"></i>{{ number_format($hotel->average_rating, 1) }}
                        </span>
                        @else
                        <span class="card-new-badge">New</span>
                        @endif
                    </div>
                    <div class="position-absolute top-0 start-0 m-3">
                        @if($hotel->average_rating > 0)
                        <span class="card-hotel-stars-badge">
                            @for($i = 0; $i < $hotel->star_rating; $i++)
                                <i class="fas fa-star"></i>
                            @endfor
                        </span>
                        @else
                        <span class="card-hotel-stars-badge card-hotel-stars-unrated">
                            <i class="fas fa-star"></i>
                        </span>
                        @endif
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
            <div class="no-results-wrapper">
                <div class="no-results-icon">
                    <i class="fas fa-search"></i>
                </div>
                <h4 class="fw-bold mt-4 mb-2">No results found</h4>
                <p class="text-muted mb-4">Try adjusting your search criteria or browse our featured destinations.</p>
                <a href="{{ route('home') }}" class="btn btn-primary px-4">
                    <i class="fas fa-home me-2"></i>Browse Destinations
                </a>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

@push('styles')
<style>
/* === Search Page Premium Styles === */

/* Search Header */
.search-page-header {
    padding: 1.5rem 0 1rem;
}

.search-title {
    font-size: 1.75rem;
    color: #1a1a2e;
}

.search-title-icon {
    background: linear-gradient(135deg, #667eea, #764ba2);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.search-subtitle {
    color: #6b7a90;
    font-size: 1rem;
}

/* Filter Card */
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

/* Price Range */
.price-range-wrapper {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.price-input-group {
    position: relative;
    flex: 1;
}

.price-prefix {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: #667eea;
    font-weight: 700;
    font-size: 0.9rem;
    z-index: 2;
    pointer-events: none;
}

.price-input {
    padding-left: 2rem !important;
}

.price-separator {
    color: #cbd5e0;
    font-size: 0.7rem;
    flex-shrink: 0;
}

/* Search Button */
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

/* Results Count Bar */
.results-count-bar {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem 1.25rem;
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.06) 0%, rgba(118, 75, 162, 0.06) 100%);
    border-radius: 12px;
    border: 1px solid rgba(102, 126, 234, 0.1);
}

.results-count-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 32px;
    height: 32px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: #ffffff;
    font-weight: 700;
    font-size: 0.85rem;
    border-radius: 8px;
    padding: 0 8px;
}

.results-count-text {
    color: #4a5568;
    font-weight: 500;
    font-size: 0.9rem;
}

.results-clear-link {
    color: #e53e3e;
    text-decoration: none;
    font-size: 0.85rem;
    font-weight: 500;
    transition: all 0.3s ease;
}

.results-clear-link:hover {
    color: #c53030;
    text-decoration: underline;
}

/* Section Headings */
.section-heading-search {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid #f0f0f5;
}

.section-heading-icon {
    width: 42px;
    height: 42px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
    color: #667eea;
    border-radius: 10px;
    font-size: 1rem;
}

.section-heading-count {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 28px;
    height: 28px;
    background: #f0f0f5;
    color: #4a5568;
    font-weight: 600;
    font-size: 0.8rem;
    border-radius: 8px;
    padding: 0 8px;
}

/* No Results */
.no-results-wrapper {
    padding: 2rem 0;
}

.no-results-icon {
    width: 80px;
    height: 80px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
    border-radius: 50%;
    margin: 0 auto;
}

.no-results-icon i {
    font-size: 2rem;
    background: linear-gradient(135deg, #667eea, #764ba2);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Card Image Badges */
.card-rating-badge {
    display: inline-flex;
    align-items: center;
    background: rgba(0, 0, 0, 0.65);
    backdrop-filter: blur(6px);
    color: #ffc107;
    font-weight: 700;
    font-size: 0.8rem;
    padding: 0.35rem 0.7rem;
    border-radius: 8px;
    letter-spacing: 0.3px;
}

.card-rating-badge .fa-star {
    font-size: 0.7rem;
}

.card-reviews-badge {
    display: inline-flex;
    align-items: center;
    background: rgba(0, 0, 0, 0.55);
    backdrop-filter: blur(6px);
    color: #ffffff;
    font-size: 0.75rem;
    font-weight: 500;
    padding: 0.3rem 0.65rem;
    border-radius: 6px;
}

.card-discount-badge {
    display: inline-block;
    background: linear-gradient(135deg, #e53e3e, #c53030);
    color: #ffffff;
    font-weight: 700;
    font-size: 0.75rem;
    padding: 0.3rem 0.6rem;
    border-radius: 6px;
    letter-spacing: 0.3px;
}

.card-new-badge {
    display: inline-flex;
    align-items: center;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: #ffffff;
    font-weight: 700;
    font-size: 0.75rem;
    padding: 0.35rem 0.7rem;
    border-radius: 8px;
    letter-spacing: 0.5px;
    text-transform: uppercase;
}

.card-hotel-stars-badge {
    display: inline-flex;
    align-items: center;
    gap: 2px;
    background: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(6px);
    color: #ffc107;
    font-size: 0.65rem;
    padding: 0.35rem 0.6rem;
    border-radius: 8px;
}

.card-hotel-stars-unrated .fa-star {
    color: #9ca3af !important;
}

/* Card hover effects */
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

/* Responsive adjustments */
@media (max-width: 768px) {
    .filter-card-body {
        padding: 1rem;
    }

    .price-range-wrapper {
        gap: 0.5rem;
    }

    .results-count-bar {
        flex-wrap: wrap;
    }

    .results-clear-link {
        width: 100%;
        text-align: right;
        margin-top: 0.25rem;
    }

    .section-heading-search {
        gap: 0.5rem;
    }

    .section-heading-icon {
        width: 36px;
        height: 36px;
        font-size: 0.9rem;
    }
}
</style>
@endpush
