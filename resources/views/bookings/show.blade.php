@extends('layouts.app')

@section('title', 'Booking Details - ' . $booking->booking_reference . ' - TravelApp')
@section('description', 'View your booking details')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <!-- Booking Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="fw-bold mb-2">Booking Details</h1>
                    <p class="text-muted mb-0">Reference: {{ $booking->booking_reference }}</p>
                </div>
                <div class="d-flex gap-2">
                    @if($booking->payment_status === 'pending')
                        <form action="{{ route('bookings.payment', $booking) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-credit-card me-2"></i>Pay Now
                            </button>
                        </form>
                    @endif
                    
                    @if($booking->can_be_cancelled)
                        <form action="{{ route('bookings.cancel', $booking) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger" 
                                    onclick="return confirm('Are you sure you want to cancel this booking?')">
                                <i class="fas fa-times me-2"></i>Cancel Booking
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <!-- Booking Information -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white border-0">
                            <h4 class="fw-bold mb-0">Booking Information</h4>
                        </div>
                        <div class="card-body">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-calendar text-primary me-3"></i>
                                        <div>
                                            <small class="text-muted">Booking Date</small>
                                            <div class="fw-semibold">{{ $booking->booking_date->format('M d, Y H:i') }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-calendar-check text-primary me-3"></i>
                                        <div>
                                            <small class="text-muted">Activity Date</small>
                                            <div class="fw-semibold">{{ $booking->check_in_date->format('M d, Y') }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-users text-primary me-3"></i>
                                        <div>
                                            <small class="text-muted">Guests</small>
                                            <div class="fw-semibold">
                                                {{ $booking->adult_count }} Adults
                                                @if($booking->child_count > 0)
                                                    , {{ $booking->child_count }} Children
                                                @endif
                                                @if($booking->infant_count > 0)
                                                    , {{ $booking->infant_count }} Infants
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-tag text-primary me-3"></i>
                                        <div>
                                            <small class="text-muted">Booking Type</small>
                                            <div class="fw-semibold">{{ ucfirst($booking->booking_type) }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Activity/Hotel Details -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white border-0">
                            <h4 class="fw-bold mb-0">
                                @if($booking->activity)
                                    Activity Details
                                @elseif($booking->hotel)
                                    Hotel Details
                                @endif
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-3">
                                    @if($booking->activity)
                                        <img src="{{ $booking->activity->image_url ?: 'https://images.unsplash.com/photo-1551632811-561732d1e306?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80' }}" 
                                             alt="{{ $booking->activity->name }}" class="img-fluid rounded">
                                    @elseif($booking->hotel)
                                        <img src="{{ $booking->hotel->image_url ?: 'https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80' }}" 
                                             alt="{{ $booking->hotel->name }}" class="img-fluid rounded">
                                    @endif
                                </div>
                                <div class="col-md-9">
                                    @if($booking->activity)
                                        <h5 class="fw-bold mb-2">{{ $booking->activity->name }}</h5>
                                        <p class="text-muted mb-2">{{ $booking->activity->short_description ?: Str::limit($booking->activity->description, 150) }}</p>
                                        <div class="d-flex align-items-center gap-4">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-star text-warning me-1"></i>
                                                <span class="fw-semibold">{{ number_format($booking->activity->average_rating, 1) }}</span>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-clock me-2"></i>
                                                <span>{{ $booking->activity->duration ?: 'Flexible' }}</span>
                                            </div>
                                        </div>
                                    @elseif($booking->hotel)
                                        <h5 class="fw-bold mb-2">{{ $booking->hotel->name }}</h5>
                                        <p class="text-muted mb-2">{{ $booking->hotel->short_description ?: Str::limit($booking->hotel->description, 150) }}</p>
                                        <div class="d-flex align-items-center gap-4">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-star text-warning me-1"></i>
                                                <span class="fw-semibold">{{ number_format($booking->hotel->average_rating, 1) }}</span>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="badge bg-warning text-dark">
                                                    @for($i = 0; $i < $booking->hotel->star_rating; $i++)
                                                        <i class="fas fa-star"></i>
                                                    @endfor
                                                </span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white border-0">
                            <h4 class="fw-bold mb-0">Contact Information</h4>
                        </div>
                        <div class="card-body">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-envelope text-primary me-3"></i>
                                        <div>
                                            <small class="text-muted">Email</small>
                                            <div class="fw-semibold">{{ $booking->contact_email }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-phone text-primary me-3"></i>
                                        <div>
                                            <small class="text-muted">Phone</small>
                                            <div class="fw-semibold">{{ $booking->contact_phone }}</div>
                                        </div>
                                    </div>
                                </div>
                                @if($booking->emergency_contact)
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-exclamation-triangle text-primary me-3"></i>
                                        <div>
                                            <small class="text-muted">Emergency Contact</small>
                                            <div class="fw-semibold">{{ $booking->emergency_contact }}</div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Special Requests -->
                    @if($booking->special_requests)
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white border-0">
                            <h4 class="fw-bold mb-0">Special Requests</h4>
                        </div>
                        <div class="card-body">
                            <p class="text-muted">{{ $booking->special_requests }}</p>
                        </div>
                    </div>
                    @endif

                    <!-- Review Section -->
                    @if($booking->is_active && $booking->reviews->count() == 0)
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white border-0">
                            <h4 class="fw-bold mb-0">Share Your Experience</h4>
                        </div>
                        <div class="card-body">
                            <p class="text-muted mb-3">Help other travelers by sharing your experience!</p>
                            <a href="{{ route('reviews.create', ['type' => $booking->booking_type, 'id' => $booking->activity_id ?: $booking->hotel_id]) }}" 
                               class="btn btn-primary">
                                <i class="fas fa-star me-2"></i>Write a Review
                            </a>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <div class="sticky-top" style="top: 2rem;">
                        <!-- Booking Status -->
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header bg-white border-0">
                                <h5 class="fw-bold mb-0">Booking Status</h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="text-muted">Status</span>
                                    @if($booking->booking_status === 'confirmed')
                                        <span class="badge bg-success">{{ ucfirst($booking->booking_status) }}</span>
                                    @elseif($booking->booking_status === 'pending')
                                        <span class="badge bg-warning">{{ ucfirst($booking->booking_status) }}</span>
                                    @elseif($booking->booking_status === 'cancelled')
                                        <span class="badge bg-danger">{{ ucfirst($booking->booking_status) }}</span>
                                    @else
                                        <span class="badge bg-info">{{ ucfirst($booking->booking_status) }}</span>
                                    @endif
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="text-muted">Payment</span>
                                    @if($booking->payment_status === 'paid')
                                        <span class="badge bg-success">{{ ucfirst($booking->payment_status) }}</span>
                                    @elseif($booking->payment_status === 'pending')
                                        <span class="badge bg-warning">{{ ucfirst($booking->payment_status) }}</span>
                                    @elseif($booking->payment_status === 'failed')
                                        <span class="badge bg-danger">{{ ucfirst($booking->payment_status) }}</span>
                                    @else
                                        <span class="badge bg-secondary">{{ ucfirst($booking->payment_status) }}</span>
                                    @endif
                                </div>
                                @if($booking->payment_method)
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="text-muted">Payment Method</span>
                                    <span class="fw-semibold">{{ ucfirst($booking->payment_method) }}</span>
                                </div>
                                @endif
                                @if($booking->payment_reference)
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-muted">Payment Ref</span>
                                    <span class="fw-semibold">{{ $booking->payment_reference }}</span>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Payment Summary -->
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header bg-white border-0">
                                <h5 class="fw-bold mb-0">Payment Summary</h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="text-muted">Total Amount</span>
                                    <span class="fw-bold text-primary fs-5">${{ number_format($booking->total_amount, 2) }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="text-muted">Currency</span>
                                    <span class="fw-semibold">{{ $booking->currency }}</span>
                                </div>
                                @if($booking->refund_amount)
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-muted">Refund Amount</span>
                                    <span class="fw-semibold text-success">${{ number_format($booking->refund_amount, 2) }}</span>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Cancellation Info -->
                        @if($booking->cancelled_at)
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-white border-0">
                                <h5 class="fw-bold mb-0">Cancellation Details</h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="text-muted">Cancelled On</span>
                                    <span class="fw-semibold">{{ $booking->cancelled_at->format('M d, Y H:i') }}</span>
                                </div>
                                @if($booking->cancellation_reason)
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-muted">Reason</span>
                                    <span class="fw-semibold">{{ $booking->cancellation_reason }}</span>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
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
