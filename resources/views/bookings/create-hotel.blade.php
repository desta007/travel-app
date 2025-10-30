@extends('layouts.app')

@section('title', 'Book ' . $hotel->name . ' - TravelApp')
@section('description', 'Book your stay at ' . $hotel->name)

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <!-- Hotel Summary -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-3">
                            <img src="{{ $hotel->image_url ?: 'https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80' }}" 
                                 alt="{{ $hotel->name }}" class="img-fluid rounded">
                        </div>
                        <div class="col-md-9">
                            <h4 class="fw-bold mb-2">{{ $hotel->name }}</h4>
                            <p class="text-muted mb-2">{{ $hotel->destination->name }}, {{ $hotel->destination->country }}</p>
                            <div class="d-flex align-items-center gap-4">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-star text-warning me-1"></i>
                                    <span class="fw-semibold">{{ number_format($hotel->average_rating, 1) }}</span>
                                    <span class="ms-2 text-muted">({{ $hotel->total_reviews }} reviews)</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-warning text-dark">
                                        @for($i = 0; $i < $hotel->star_rating; $i++)
                                            <i class="fas fa-star"></i>
                                        @endfor
                                    </span>
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
                        <input type="hidden" name="hotel_id" value="{{ $hotel->id }}">
                        <input type="hidden" name="booking_type" value="hotel">

                        <div class="row g-4">
                            <!-- Check-in Date -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Check-in Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('check_in_date') is-invalid @enderror" 
                                       name="check_in_date" value="{{ old('check_in_date') }}" 
                                       min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                                @error('check_in_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Check-out Date -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Check-out Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('check_out_date') is-invalid @enderror" 
                                       name="check_out_date" value="{{ old('check_out_date') }}" 
                                       min="{{ date('Y-m-d', strtotime('+2 days')) }}" required>
                                @error('check_out_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Guest Count -->
                            <div class="col-md-4">
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

                            <div class="col-md-4">
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

                            <div class="col-md-4">
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
                                          placeholder="Any special requests for your stay (room preferences, accessibility needs, etc.)...">{{ old('special_requests') }}</textarea>
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
                            <span class="text-muted">Price per night</span>
                            <span class="fw-semibold">${{ number_format($hotel->price_per_night, 2) }}</span>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted">Number of nights</span>
                            <span class="fw-semibold" id="nights-count">0</span>
                        </div>

                        <hr>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="fw-bold">Total Amount</span>
                            <span class="fw-bold text-primary fs-5" id="total-amount">$0.00</span>
                        </div>

                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            <small>Final price will be calculated based on the number of nights and guests selected.</small>
                        </div>

                        <!-- Hotel Highlights -->
                        <div class="mt-4">
                            <h6 class="fw-bold mb-3">Hotel Highlights</h6>
                            <ul class="list-unstyled">
                                <li class="d-flex align-items-center mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    <small>Free cancellation</small>
                                </li>
                                <li class="d-flex align-items-center mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    <small>Best price guarantee</small>
                                </li>
                                <li class="d-flex align-items-center mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    <small>Instant confirmation</small>
                                </li>
                                @if($hotel->amenities)
                                    @foreach(array_slice($hotel->amenities, 0, 3) as $amenity)
                                        <li class="d-flex align-items-center mb-2">
                                            <i class="fas fa-check text-success me-2"></i>
                                            <small>{{ $amenity }}</small>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>

                        <!-- Cancellation Policy -->
                        @if($hotel->cancellation_policy)
                        <div class="mt-4">
                            <h6 class="fw-bold mb-3">Cancellation Policy</h6>
                            <p class="text-muted small">{{ Str::limit($hotel->cancellation_policy, 150) }}</p>
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
    const checkInInput = document.querySelector('input[name="check_in_date"]');
    const checkOutInput = document.querySelector('input[name="check_out_date"]');
    const adultSelect = document.querySelector('select[name="adult_count"]');
    const childSelect = document.querySelector('select[name="child_count"]');
    const infantSelect = document.querySelector('select[name="infant_count"]');
    const nightsCount = document.getElementById('nights-count');
    const totalAmount = document.getElementById('total-amount');
    
    const hotelPrice = {{ $hotel->price_per_night }};
    
    function updateBookingSummary() {
        const checkIn = new Date(checkInInput.value);
        const checkOut = new Date(checkOutInput.value);
        const adults = parseInt(adultSelect.value) || 0;
        const children = parseInt(childSelect.value) || 0;
        const infants = parseInt(infantSelect.value) || 0;
        
        if (checkIn && checkOut && checkOut > checkIn) {
            const nights = Math.ceil((checkOut - checkIn) / (1000 * 60 * 60 * 24));
            nightsCount.textContent = nights;
            
            // Calculate total based on adults and children (infants usually free)
            const totalGuests = adults + children;
            const total = hotelPrice * nights * totalGuests;
            
            totalAmount.textContent = '$' + total.toFixed(2);
        } else {
            nightsCount.textContent = '0';
            totalAmount.textContent = '$0.00';
        }
    }
    
    // Update minimum check-out date when check-in date changes
    checkInInput.addEventListener('change', function() {
        if (this.value) {
            const checkInDate = new Date(this.value);
            const minCheckOut = new Date(checkInDate);
            minCheckOut.setDate(minCheckOut.getDate() + 1);
            checkOutInput.min = minCheckOut.toISOString().split('T')[0];
            updateBookingSummary();
        }
    });
    
    checkOutInput.addEventListener('change', updateBookingSummary);
    adultSelect.addEventListener('change', updateBookingSummary);
    childSelect.addEventListener('change', updateBookingSummary);
    infantSelect.addEventListener('change', updateBookingSummary);
});
</script>
@endpush
