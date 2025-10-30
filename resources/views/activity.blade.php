@extends('layouts.app')

@section('title', $activity->name . ' - TravelApp')
@section('description', Str::limit($activity->description, 160))

@section('content')
<!-- Hero Section -->
<section class="hero-section bg-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('destinations.show', $activity->destination) }}" class="text-white">{{ $activity->destination->name }}</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">{{ $activity->name }}</li>
                    </ol>
                </nav>
                <h1 class="display-4 fw-bold mb-3">{{ $activity->name }}</h1>
                <p class="lead mb-4">{{ $activity->short_description ?: Str::limit($activity->description, 200) }}</p>
                <div class="d-flex align-items-center gap-4 mb-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-star text-warning me-2"></i>
                        <span class="fw-semibold">{{ number_format($activity->average_rating, 1) }}</span>
                        <span class="ms-2">({{ $activity->total_reviews }} reviews)</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-clock me-2"></i>
                        <span>{{ $activity->duration ?: 'Flexible' }}</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-users me-2"></i>
                        <span>{{ $activity->max_group_size ? 'Max ' . $activity->max_group_size . ' people' : 'Group activity' }}</span>
                    </div>
                </div>
                <div class="d-flex gap-3">
                    @auth
                        <a href="{{ route('bookings.create.activity', $activity) }}" class="btn btn-light btn-lg">
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
                <div class="position-relative">
                    <img src="{{ $activity->image_url ?: 'https://images.unsplash.com/photo-1551632811-561732d1e306?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}" 
                         alt="{{ $activity->name }}" class="img-fluid rounded-3 shadow-lg">
                    @if($activity->discount_percentage > 0)
                        <div class="position-absolute top-0 end-0 m-3">
                            <span class="badge bg-danger fs-6">{{ $activity->discount_percentage }}% OFF</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Activity Details -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!-- Description -->
                <div class="mb-5">
                    <h3 class="fw-bold mb-3">About This Activity</h3>
                    <p class="text-muted">{{ $activity->description }}</p>
                </div>

                <!-- Gallery -->
                @if($activity->gallery_images && count($activity->gallery_images) > 0)
                <div class="mb-5">
                    <h3 class="fw-bold mb-3">Gallery</h3>
                    <div class="row g-3">
                        @foreach($activity->gallery_images as $image)
                        <div class="col-lg-4 col-md-6">
                            <img src="{{ $image }}" alt="Activity Image" class="img-fluid rounded shadow-sm" style="height: 200px; width: 100%; object-fit: cover;">
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- What's Included -->
                @if($activity->included_items && count($activity->included_items) > 0)
                <div class="mb-5">
                    <h3 class="fw-bold mb-3">What's Included</h3>
                    <ul class="list-unstyled">
                        @foreach($activity->included_items as $item)
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-check text-success me-3"></i>
                            <span>{{ $item }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- What's Not Included -->
                @if($activity->excluded_items && count($activity->excluded_items) > 0)
                <div class="mb-5">
                    <h3 class="fw-bold mb-3">What's Not Included</h3>
                    <ul class="list-unstyled">
                        @foreach($activity->excluded_items as $item)
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-times text-danger me-3"></i>
                            <span>{{ $item }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Meeting Point -->
                @if($activity->meeting_point)
                <div class="mb-5">
                    <h3 class="fw-bold mb-3">Meeting Point</h3>
                    <p class="text-muted">{{ $activity->meeting_point }}</p>
                </div>
                @endif

                <!-- Cancellation Policy -->
                @if($activity->cancellation_policy)
                <div class="mb-5">
                    <h3 class="fw-bold mb-3">Cancellation Policy</h3>
                    <p class="text-muted">{{ $activity->cancellation_policy }}</p>
                </div>
                @endif

                <!-- Reviews -->
                @if($activity->reviews->count() > 0)
                <div id="reviews" class="mb-5">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="fw-bold mb-0">Reviews</h3>
                        <a href="{{ route('reviews.activity', $activity) }}" class="btn btn-outline-primary">
                            View All Reviews
                        </a>
                    </div>
                    <div class="row g-4">
                        @foreach($activity->reviews->take(3) as $review)
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
                    <!-- Booking Card -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <div class="text-center mb-4">
                                @if($activity->discount_percentage > 0)
                                    <div class="mb-2">
                                        <span class="text-decoration-line-through text-muted">${{ number_format($activity->original_price, 2) }}</span>
                                        <span class="badge bg-danger ms-2">{{ $activity->discount_percentage }}% OFF</span>
                                    </div>
                                    <h3 class="fw-bold text-primary">${{ number_format($activity->discounted_price, 2) }}</h3>
                                @else
                                    <h3 class="fw-bold text-primary">${{ number_format($activity->price, 2) }}</h3>
                                @endif
                                <small class="text-muted">per person</small>
                            </div>
                            
                            @auth
                                <a href="{{ route('bookings.create.activity', $activity) }}" class="btn btn-primary btn-lg w-100 mb-3">
                                    <i class="fas fa-calendar-check me-2"></i>Book Now
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-primary btn-lg w-100 mb-3">
                                    <i class="fas fa-sign-in-alt me-2"></i>Login to Book
                                </a>
                            @endauth

                            <div class="row text-center">
                                <div class="col-4">
                                    <div class="fw-bold">{{ $activity->average_rating }}</div>
                                    <small class="text-muted">Rating</small>
                                </div>
                                <div class="col-4">
                                    <div class="fw-bold">{{ $activity->total_reviews }}</div>
                                    <small class="text-muted">Reviews</small>
                                </div>
                                <div class="col-4">
                                    <div class="fw-bold">{{ $activity->total_bookings }}</div>
                                    <small class="text-muted">Bookings</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Activity Info -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Activity Details</h5>
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-clock text-primary me-3"></i>
                                        <div>
                                            <small class="text-muted">Duration</small>
                                            <div class="fw-semibold">{{ $activity->duration ?: 'Flexible' }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-signal text-primary me-3"></i>
                                        <div>
                                            <small class="text-muted">Difficulty</small>
                                            <div class="fw-semibold">{{ ucfirst($activity->difficulty_level) }}</div>
                                        </div>
                                    </div>
                                </div>
                                @if($activity->min_age)
                                <div class="col-12">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-child text-primary me-3"></i>
                                        <div>
                                            <small class="text-muted">Minimum Age</small>
                                            <div class="fw-semibold">{{ $activity->min_age }} years</div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if($activity->max_group_size)
                                <div class="col-12">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-users text-primary me-3"></i>
                                        <div>
                                            <small class="text-muted">Max Group Size</small>
                                            <div class="fw-semibold">{{ $activity->max_group_size }} people</div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="col-12">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-check-circle text-primary me-3"></i>
                                        <div>
                                            <small class="text-muted">Confirmation</small>
                                            <div class="fw-semibold">{{ $activity->is_instant_confirmation ? 'Instant' : 'Manual' }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-undo text-primary me-3"></i>
                                        <div>
                                            <small class="text-muted">Refundable</small>
                                            <div class="fw-semibold">{{ $activity->is_refundable ? 'Yes' : 'No' }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Related Activities -->
                    @if($relatedActivities->count() > 0)
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Related Activities</h5>
                            @foreach($relatedActivities as $related)
                            <div class="d-flex align-items-center mb-3">
                                <img src="{{ $related->image_url ?: 'https://images.unsplash.com/photo-1551632811-561732d1e306?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80' }}" 
                                     alt="{{ $related->name }}" class="rounded me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                <div class="flex-grow-1">
                                    <h6 class="fw-bold mb-1">{{ $related->name }}</h6>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-star text-warning me-1"></i>
                                        <small class="text-muted">{{ number_format($related->average_rating, 1) }}</small>
                                    </div>
                                </div>
                                <a href="{{ route('activities.show', $related) }}" class="btn btn-outline-primary btn-sm">
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
