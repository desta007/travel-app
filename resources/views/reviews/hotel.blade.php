@extends('layouts.app')

@section('title', 'Reviews for ' . $hotel->name . ' - TravelApp')
@section('description', 'Read reviews and ratings for ' . $hotel->name)

@section('content')
<div class="container py-5">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('hotels.show', $hotel) }}">{{ $hotel->name }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Reviews</li>
                </ol>
            </nav>
            <h1 class="fw-bold mb-3">Reviews for {{ $hotel->name }}</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Rating Summary -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-4 text-center">
                            <div class="display-4 fw-bold text-primary">{{ number_format($averageRating, 1) }}</div>
                            <div class="d-flex justify-content-center mb-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $averageRating ? 'text-warning' : 'text-muted' }}"></i>
                                @endfor
                            </div>
                            <p class="text-muted mb-0">Based on {{ $totalReviews }} reviews</p>
                        </div>
                        <div class="col-md-8">
                            @for($rating = 5; $rating >= 1; $rating--)
                                @php
                                    $count = $hotel->reviews()->where('rating', $rating)->count();
                                    $percentage = $totalReviews > 0 ? ($count / $totalReviews) * 100 : 0;
                                @endphp
                                <div class="d-flex align-items-center mb-2">
                                    <span class="me-2">{{ $rating }}</span>
                                    <i class="fas fa-star text-warning me-2"></i>
                                    <div class="progress flex-grow-1 me-2" style="height: 8px;">
                                        <div class="progress-bar bg-warning" style="width: {{ $percentage }}%"></div>
                                    </div>
                                    <span class="text-muted small">{{ $count }}</span>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reviews List -->
            <div class="mb-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="fw-bold mb-0">All Reviews</h3>
                    <div class="d-flex gap-2">
                        <select class="form-select form-select-sm" id="sortReviews">
                            <option value="newest">Newest First</option>
                            <option value="oldest">Oldest First</option>
                            <option value="highest">Highest Rating</option>
                            <option value="lowest">Lowest Rating</option>
                        </select>
                    </div>
                </div>

                @if($reviews->count() > 0)
                    @foreach($reviews as $review)
                    <div class="card border-0 shadow-sm mb-3">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="me-3">
                                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                        <span class="text-white fw-bold fs-5">{{ substr($review->user->name, 0, 1) }}</span>
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
                                        @if($review->is_verified)
                                            <span class="badge bg-success ms-2">Verified</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-outline-primary btn-sm" onclick="markHelpful({{ $review->id }})">
                                        <i class="fas fa-thumbs-up me-1"></i>{{ $review->helpful_count }}
                                    </button>
                                </div>
                            </div>
                            
                            <h5 class="fw-bold mb-2">{{ $review->title }}</h5>
                            <p class="text-muted mb-3">{{ $review->comment }}</p>

                            @if($review->travel_date)
                                <div class="d-flex align-items-center mb-3">
                                    <i class="fas fa-calendar text-muted me-2"></i>
                                    <small class="text-muted">Stayed {{ $review->travel_date->format('F Y') }}</small>
                                    @if($review->travel_type)
                                        <span class="badge bg-light text-dark ms-2">{{ $review->travel_type }}</span>
                                    @endif
                                </div>
                            @endif

                            @if($review->pros && count($review->pros) > 0)
                                <div class="mb-3">
                                    <h6 class="fw-bold text-success mb-2">What I liked:</h6>
                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach($review->pros as $pro)
                                            <span class="badge bg-success">{{ $pro }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            @if($review->cons && count($review->cons) > 0)
                                <div class="mb-3">
                                    <h6 class="fw-bold text-danger mb-2">What could be improved:</h6>
                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach($review->cons as $con)
                                            <span class="badge bg-danger">{{ $con }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            @if($review->recommended_for && count($review->recommended_for) > 0)
                                <div class="mb-3">
                                    <h6 class="fw-bold text-info mb-2">Recommended for:</h6>
                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach($review->recommended_for as $recommendation)
                                            <span class="badge bg-info">{{ $recommendation }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            @if($review->images && count($review->images) > 0)
                                <div class="row g-2">
                                    @foreach($review->images as $image)
                                        <div class="col-md-3">
                                            <img src="{{ asset('storage/' . $image) }}" alt="Review Image" class="img-fluid rounded">
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    @endforeach

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center">
                        {{ $reviews->links() }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                        <h4 class="fw-bold text-muted mb-3">No Reviews Yet</h4>
                        <p class="text-muted">Be the first to share your experience!</p>
                        @auth
                            <a href="{{ route('reviews.create', ['type' => 'hotel', 'id' => $hotel->id]) }}" class="btn btn-primary">
                                <i class="fas fa-star me-2"></i>Write a Review
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary">
                                <i class="fas fa-sign-in-alt me-2"></i>Login to Write Review
                            </a>
                        @endauth
                    </div>
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <div class="sticky-top" style="top: 2rem;">
                <!-- Write Review -->
                @auth
                    @if($hotel->reviews()->where('user_id', auth()->id())->count() == 0)
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body text-center">
                            <h5 class="fw-bold mb-3">Share Your Experience</h5>
                            <p class="text-muted mb-3">Help other travelers by writing a review</p>
                            <a href="{{ route('reviews.create', ['type' => 'hotel', 'id' => $hotel->id]) }}" class="btn btn-primary">
                                <i class="fas fa-star me-2"></i>Write a Review
                            </a>
                        </div>
                    </div>
                    @endif
                @else
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body text-center">
                            <h5 class="fw-bold mb-3">Join the Community</h5>
                            <p class="text-muted mb-3">Sign in to write reviews and share your experiences</p>
                            <a href="{{ route('login') }}" class="btn btn-primary">
                                <i class="fas fa-sign-in-alt me-2"></i>Sign In
                            </a>
                        </div>
                    </div>
                @endauth

                <!-- Hotel Info -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">About {{ $hotel->name }}</h5>
                        <img src="{{ $hotel->image_url ?: 'https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80' }}" 
                             alt="{{ $hotel->name }}" class="img-fluid rounded mb-3">
                        <p class="text-muted">{{ Str::limit($hotel->description, 150) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                <i class="fas fa-map-marker-alt me-1"></i>{{ $hotel->destination->name }}
                            </small>
                            <a href="{{ route('hotels.show', $hotel) }}" class="btn btn-outline-primary btn-sm">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Review Guidelines -->
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">Review Guidelines</h5>
                        <ul class="list-unstyled">
                            <li class="d-flex align-items-start mb-2">
                                <i class="fas fa-check text-success me-2 mt-1"></i>
                                <small>Be honest and objective</small>
                            </li>
                            <li class="d-flex align-items-start mb-2">
                                <i class="fas fa-check text-success me-2 mt-1"></i>
                                <small>Include specific details</small>
                            </li>
                            <li class="d-flex align-items-start mb-2">
                                <i class="fas fa-check text-success me-2 mt-1"></i>
                                <small>Respect other travelers</small>
                            </li>
                            <li class="d-flex align-items-start mb-2">
                                <i class="fas fa-check text-success me-2 mt-1"></i>
                                <small>Share helpful tips</small>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function markHelpful(reviewId) {
    fetch(`/reviews/${reviewId}/helpful`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update the helpful count
            const button = event.target.closest('button');
            const count = button.querySelector('i').nextSibling;
            count.textContent = ' ' + (parseInt(count.textContent.trim()) + 1);
            
            // Show success message
            if (typeof TravelApp !== 'undefined') {
                TravelApp.showToast('Thank you for your feedback!', 'success');
            }
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

// Sort reviews
document.getElementById('sortReviews').addEventListener('change', function() {
    const sortBy = this.value;
    const url = new URL(window.location);
    url.searchParams.set('sort', sortBy);
    window.location.href = url.toString();
});
</script>
@endpush
