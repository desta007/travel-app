@extends('layouts.app')

@section('title', 'Book ' . $activity->name . ' - TravelApp')
@section('description', 'Book your ' . $activity->name . ' experience')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <!-- Activity Summary -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-3">
                            <img src="{{ $activity->image_url ?: 'https://images.unsplash.com/photo-1551632811-561732d1e306?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80' }}" 
                                 alt="{{ $activity->name }}" class="img-fluid rounded">
                        </div>
                        <div class="col-md-9">
                            <h4 class="fw-bold mb-2">{{ $activity->name }}</h4>
                            <p class="text-muted mb-2">{{ $activity->destination->name }}, {{ $activity->destination->country }}</p>
                            <div class="d-flex align-items-center gap-4">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-star text-warning me-1"></i>
                                    <span class="fw-semibold">{{ number_format($activity->average_rating, 1) }}</span>
                                    <span class="ms-2 text-muted">({{ $activity->total_reviews }} reviews)</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-clock me-2"></i>
                                    <span>{{ $activity->duration ?: 'Flexible' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Booking Form -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0">
                    <h3 class="fw-bold mb-0">Booking Details</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('bookings.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="activity_id" value="{{ $activity->id }}">
                        <input type="hidden" name="booking_type" value="activity">

                        <div class="row g-4">
                            <!-- Date Selection -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Activity Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('check_in_date') is-invalid @enderror" 
                                       name="check_in_date" value="{{ old('check_in_date') }}" 
                                       min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                                @error('check_in_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Guest Count -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Adults <span class="text-danger">*</span></label>
                                <select class="form-select @error('adult_count') is-invalid @enderror" name="adult_count" required>
                                    <option value="">Select adults</option>
                                    @for($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}" {{ old('adult_count') == $i ? 'selected' : '' }}>{{ $i }} {{ $i == 1 ? 'Adult' : 'Adults' }}</option>
                                    @endfor
                                </select>
                                @error('adult_count')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Children (2-11 years)</label>
                                <select class="form-select @error('child_count') is-invalid @enderror" name="child_count">
                                    <option value="0">No children</option>
                                    @for($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}" {{ old('child_count') == $i ? 'selected' : '' }}>{{ $i }} {{ $i == 1 ? 'Child' : 'Children' }}</option>
                                    @endfor
                                </select>
                                @error('child_count')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Infants (0-1 years)</label>
                                <select class="form-select @error('infant_count') is-invalid @enderror" name="infant_count">
                                    <option value="0">No infants</option>
                                    @for($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}" {{ old('infant_count') == $i ? 'selected' : '' }}>{{ $i }} {{ $i == 1 ? 'Infant' : 'Infants' }}</option>
                                    @endfor
                                </select>
                                @error('infant_count')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Contact Information -->
                            <div class="col-12">
                                <hr class="my-4">
                                <h5 class="fw-bold mb-3">Contact Information</h5>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Email Address <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('contact_email') is-invalid @enderror" 
                                       name="contact_email" value="{{ old('contact_email', auth()->user()->email ?? '') }}" required>
                                @error('contact_email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Phone Number <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control @error('contact_phone') is-invalid @enderror" 
                                       name="contact_phone" value="{{ old('contact_phone') }}" required>
                                @error('contact_phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Emergency Contact</label>
                                <input type="tel" class="form-control @error('emergency_contact') is-invalid @enderror" 
                                       name="emergency_contact" value="{{ old('emergency_contact') }}">
                                @error('emergency_contact')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Special Requests -->
                            <div class="col-12">
                                <label class="form-label fw-semibold">Special Requests</label>
                                <textarea class="form-control @error('special_requests') is-invalid @enderror" 
                                          name="special_requests" rows="3" 
                                          placeholder="Any special dietary requirements, accessibility needs, or other requests...">{{ old('special_requests') }}</textarea>
                                @error('special_requests')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Terms and Conditions -->
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="terms" required>
                                    <label class="form-check-label" for="terms">
                                        I agree to the <a href="#" class="text-primary">Terms and Conditions</a> and <a href="#" class="text-primary">Cancellation Policy</a>
                                    </label>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-lg w-100">
                                    <i class="fas fa-calendar-check me-2"></i>Complete Booking
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Booking Summary Sidebar -->
        <div class="col-lg-4">
            <div class="sticky-top" style="top: 2rem;">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0">
                        <h5 class="fw-bold mb-0">Booking Summary</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted">Activity Price</span>
                            <span class="fw-semibold">${{ number_format($activity->price, 2) }}</span>
                        </div>
                        
                        @if($activity->discount_percentage > 0)
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted">Discount ({{ $activity->discount_percentage }}%)</span>
                            <span class="text-success">-${{ number_format($activity->price * $activity->discount_percentage / 100, 2) }}</span>
                        </div>
                        @endif

                        <hr>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="fw-bold">Total Amount</span>
                            <span class="fw-bold text-primary fs-5">
                                @if($activity->discount_percentage > 0)
                                    ${{ number_format($activity->discounted_price, 2) }}
                                @else
                                    ${{ number_format($activity->price, 2) }}
                                @endif
                            </span>
                        </div>

                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            <small>Final price will be calculated based on the number of guests selected.</small>
                        </div>

                        <!-- Activity Highlights -->
                        <div class="mt-4">
                            <h6 class="fw-bold mb-3">Activity Highlights</h6>
                            <ul class="list-unstyled">
                                <li class="d-flex align-items-center mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    <small>Instant confirmation</small>
                                </li>
                                <li class="d-flex align-items-center mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    <small>Free cancellation</small>
                                </li>
                                <li class="d-flex align-items-center mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    <small>Mobile voucher accepted</small>
                                </li>
                                @if($activity->duration)
                                <li class="d-flex align-items-center mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    <small>Duration: {{ $activity->duration }}</small>
                                </li>
                                @endif
                            </ul>
                        </div>

                        <!-- Cancellation Policy -->
                        @if($activity->cancellation_policy)
                        <div class="mt-4">
                            <h6 class="fw-bold mb-3">Cancellation Policy</h6>
                            <p class="text-muted small">{{ Str::limit($activity->cancellation_policy, 150) }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const adultSelect = document.querySelector('select[name="adult_count"]');
    const childSelect = document.querySelector('select[name="child_count"]');
    const infantSelect = document.querySelector('select[name="infant_count"]');
    const totalAmount = document.querySelector('.fw-bold.text-primary.fs-5');
    
    const activityPrice = {{ $activity->discount_percentage > 0 ? $activity->discounted_price : $activity->price }};
    
    function updateTotal() {
        const adults = parseInt(adultSelect.value) || 0;
        const children = parseInt(childSelect.value) || 0;
        const infants = parseInt(infantSelect.value) || 0;
        
        // Calculate total based on adults and children (infants usually free)
        const totalGuests = adults + children;
        const total = activityPrice * totalGuests;
        
        if (totalAmount) {
            totalAmount.textContent = '$' + total.toFixed(2);
        }
    }
    
    adultSelect.addEventListener('change', updateTotal);
    childSelect.addEventListener('change', updateTotal);
    infantSelect.addEventListener('change', updateTotal);
});
</script>
@endpush
