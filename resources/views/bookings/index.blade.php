@extends('layouts.app')

@section('title', 'My Bookings - TravelApp')
@section('description', 'View and manage your travel bookings')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="fw-bold mb-0">My Bookings</h1>
                <a href="{{ route('home') }}" class="btn btn-outline-primary">
                    <i class="fas fa-plus me-2"></i>Book New Activity
                </a>
            </div>

            @if($bookings->count() > 0)
                <div class="row g-4">
                    @foreach($bookings as $booking)
                    <div class="col-12">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-2">
                                        @if($booking->activity)
                                            <img src="{{ $booking->activity->image_url ?: 'https://images.unsplash.com/photo-1551632811-561732d1e306?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80' }}" 
                                                 alt="{{ $booking->activity->name }}" class="img-fluid rounded" style="height: 80px; width: 100%; object-fit: cover;">
                                        @elseif($booking->hotel)
                                            <img src="{{ $booking->hotel->image_url ?: 'https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80' }}" 
                                                 alt="{{ $booking->hotel->name }}" class="img-fluid rounded" style="height: 80px; width: 100%; object-fit: cover;">
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="fw-bold mb-2">
                                            @if($booking->activity)
                                                {{ $booking->activity->name }}
                                            @elseif($booking->hotel)
                                                {{ $booking->hotel->name }}
                                            @endif
                                        </h5>
                                        <p class="text-muted mb-2">
                                            <i class="fas fa-map-marker-alt me-2"></i>
                                            {{ $booking->destination->name }}, {{ $booking->destination->country }}
                                        </p>
                                        <div class="d-flex align-items-center gap-4">
                                            <small class="text-muted">
                                                <i class="fas fa-calendar me-1"></i>
                                                {{ $booking->check_in_date->format('M d, Y') }}
                                                @if($booking->check_out_date)
                                                    - {{ $booking->check_out_date->format('M d, Y') }}
                                                @endif
                                            </small>
                                            <small class="text-muted">
                                                <i class="fas fa-users me-1"></i>
                                                {{ $booking->total_guests }} {{ $booking->total_guests == 1 ? 'Guest' : 'Guests' }}
                                            </small>
                                        </div>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <div class="mb-2">
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
                                        <div class="mb-2">
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
                                        <small class="text-muted">Ref: {{ $booking->booking_reference }}</small>
                                    </div>
                                    <div class="col-md-2 text-end">
                                        <div class="fw-bold text-primary mb-2">${{ number_format($booking->total_amount, 2) }}</div>
                                        <div class="btn-group-vertical d-grid gap-1">
                                            <a href="{{ route('bookings.show', $booking) }}" class="btn btn-outline-primary btn-sm">
                                                <i class="fas fa-eye me-1"></i>View Details
                                            </a>
                                            
                                            @if($booking->payment_status === 'pending')
                                                <form action="{{ route('bookings.payment', $booking) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm w-100">
                                                        <i class="fas fa-credit-card me-1"></i>Pay Now
                                                    </button>
                                                </form>
                                            @endif
                                            
                                            @if($booking->can_be_cancelled)
                                                <form action="{{ route('bookings.cancel', $booking) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-danger btn-sm w-100" 
                                                            onclick="return confirm('Are you sure you want to cancel this booking?')">
                                                        <i class="fas fa-times me-1"></i>Cancel
                                                    </button>
                                                </form>
                                            @endif
                                            
                                            @if($booking->is_active && $booking->reviews->count() == 0)
                                                <a href="{{ route('reviews.create', ['type' => $booking->booking_type, 'id' => $booking->activity_id ?: $booking->hotel_id]) }}" 
                                                   class="btn btn-outline-warning btn-sm">
                                                    <i class="fas fa-star me-1"></i>Write Review
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $bookings->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-5">
                    <i class="fas fa-calendar-times fa-4x text-muted mb-4"></i>
                    <h3 class="fw-bold text-muted mb-3">No Bookings Yet</h3>
                    <p class="text-muted mb-4">Start exploring amazing destinations and book your first adventure!</p>
                    <a href="{{ route('search', ['type' => 'activities']) }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-search me-2"></i>Explore Activities
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

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
</style>
@endpush
