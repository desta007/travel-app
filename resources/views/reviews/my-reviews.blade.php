@extends('layouts.app')

@section('title', 'My Reviews - TravelApp')
@section('description', 'View and manage your travel reviews')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="fw-bold mb-0">My Reviews</h1>
                <a href="{{ route('home') }}" class="btn btn-outline-primary">
                    <i class="fas fa-plus me-2"></i>Write New Review
                </a>
            </div>

            @if($reviews->count() > 0)
                <div class="row g-4">
                    @foreach($reviews as $review)
                    <div class="col-12">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-2">
                                        @if($review->destination)
                                            <img src="{{ $review->destination->image_url ?: 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80' }}" 
                                                 alt="{{ $review->destination->name }}" class="img-fluid rounded" style="height: 80px; width: 100%; object-fit: cover;">
                                        @elseif($review->activity)
                                            <img src="{{ $review->activity->image_url ?: 'https://images.unsplash.com/photo-1551632811-561732d1e306?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80' }}" 
                                                 alt="{{ $review->activity->name }}" class="img-fluid rounded" style="height: 80px; width: 100%; object-fit: cover;">
                                        @elseif($review->hotel)
                                            <img src="{{ $review->hotel->image_url ?: 'https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80' }}" 
                                                 alt="{{ $review->hotel->name }}" class="img-fluid rounded" style="height: 80px; width: 100%; object-fit: cover;">
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="fw-bold mb-2">{{ $review->title }}</h5>
                                        <p class="text-muted mb-2">
                                            @if($review->destination)
                                                Review for {{ $review->destination->name }}
                                            @elseif($review->activity)
                                                Review for {{ $review->activity->name }}
                                            @elseif($review->hotel)
                                                Review for {{ $review->hotel->name }}
                                            @endif
                                        </p>
                                        <div class="d-flex align-items-center gap-4">
                                            <div class="d-flex align-items-center">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= $review->rating ? 'text-warning' : 'text-muted' }}"></i>
                                                @endfor
                                                <span class="ms-2 fw-semibold">{{ $review->rating }}/5</span>
                                            </div>
                                            <small class="text-muted">
                                                <i class="fas fa-calendar me-1"></i>{{ $review->created_at->format('M d, Y') }}
                                            </small>
                                            @if($review->travel_date)
                                                <small class="text-muted">
                                                    <i class="fas fa-plane me-1"></i>Traveled {{ $review->travel_date->format('M Y') }}
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <div class="mb-2">
                                            @if($review->is_verified)
                                                <span class="badge bg-success">Verified</span>
                                            @else
                                                <span class="badge bg-secondary">Pending</span>
                                            @endif
                                        </div>
                                        <div class="mb-2">
                                            <span class="badge bg-primary">{{ ucfirst($review->review_type) }}</span>
                                        </div>
                                        <small class="text-muted">{{ $review->helpful_count }} helpful</small>
                                    </div>
                                    <div class="col-md-2 text-end">
                                        <div class="btn-group-vertical d-grid gap-1">
                                            @if($review->destination)
                                                <a href="{{ route('destinations.show', $review->destination) }}" class="btn btn-outline-primary btn-sm">
                                                    <i class="fas fa-eye me-1"></i>View Item
                                                </a>
                                            @elseif($review->activity)
                                                <a href="{{ route('activities.show', $review->activity) }}" class="btn btn-outline-primary btn-sm">
                                                    <i class="fas fa-eye me-1"></i>View Item
                                                </a>
                                            @elseif($review->hotel)
                                                <a href="{{ route('hotels.show', $review->hotel) }}" class="btn btn-outline-primary btn-sm">
                                                    <i class="fas fa-eye me-1"></i>View Item
                                                </a>
                                            @endif
                                            
                                            <button class="btn btn-outline-secondary btn-sm" onclick="viewReviewDetails({{ $review->id }})">
                                                <i class="fas fa-info-circle me-1"></i>View Details
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Review Content Preview -->
                                <div class="mt-3">
                                    <p class="text-muted">{{ Str::limit($review->comment, 200) }}</p>
                                    
                                    @if($review->pros && count($review->pros) > 0)
                                        <div class="mb-2">
                                            <small class="fw-semibold text-success">Pros:</small>
                                            @foreach($review->pros as $pro)
                                                <span class="badge bg-success me-1">{{ $pro }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                    
                                    @if($review->cons && count($review->cons) > 0)
                                        <div class="mb-2">
                                            <small class="fw-semibold text-danger">Cons:</small>
                                            @foreach($review->cons as $con)
                                                <span class="badge bg-danger me-1">{{ $con }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $reviews->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-5">
                    <i class="fas fa-star fa-4x text-muted mb-4"></i>
                    <h3 class="fw-bold text-muted mb-3">No Reviews Yet</h3>
                    <p class="text-muted mb-4">Start sharing your travel experiences by writing reviews!</p>
                    <a href="{{ route('search', ['type' => 'destinations']) }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-search me-2"></i>Explore Destinations
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Review Details Modal -->
<div class="modal fade" id="reviewModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Review Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="reviewModalBody">
                <!-- Content will be loaded here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function viewReviewDetails(reviewId) {
    // This would typically fetch review details via AJAX
    // For now, we'll show a simple message
    const modalBody = document.getElementById('reviewModalBody');
    modalBody.innerHTML = `
        <div class="text-center py-4">
            <i class="fas fa-info-circle fa-3x text-primary mb-3"></i>
            <h5>Review Details</h5>
            <p class="text-muted">Full review details would be loaded here via AJAX.</p>
            <p class="text-muted">Review ID: ${reviewId}</p>
        </div>
    `;
    
    const modal = new bootstrap.Modal(document.getElementById('reviewModal'));
    modal.show();
}
</script>
@endpush

@push('styles')
<style>
.card:hover {
    transform: translateY(-2px);
    transition: transform 0.3s ease;
}

.btn-group-vertical .btn {
    margin-bottom: 0.25rem;
}

.btn-group-vertical .btn:last-child {
    margin-bottom: 0;
}

.badge {
    font-size: 0.75rem;
}
</style>
@endpush
