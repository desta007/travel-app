@extends('layouts.app')

@section('title', 'Write a Review - TravelApp')
@section('description', 'Share your experience and help other travelers')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Review Header -->
            <div class="text-center mb-5">
                <h1 class="fw-bold mb-3">Write a Review</h1>
                <p class="text-muted">Share your experience to help other travelers make informed decisions</p>
            </div>

            <!-- Item Being Reviewed -->
            @if($reviewable)
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-3">
                            @if($type === 'destination')
                                <img src="{{ $reviewable->image_url ?: 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80' }}" 
                                     alt="{{ $reviewable->name }}" class="img-fluid rounded">
                            @elseif($type === 'activity')
                                <img src="{{ $reviewable->image_url ?: 'https://images.unsplash.com/photo-1551632811-561732d1e306?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80' }}" 
                                     alt="{{ $reviewable->name }}" class="img-fluid rounded">
                            @elseif($type === 'hotel')
                                <img src="{{ $reviewable->image_url ?: 'https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80' }}" 
                                     alt="{{ $reviewable->name }}" class="img-fluid rounded">
                            @endif
                        </div>
                        <div class="col-md-9">
                            <h4 class="fw-bold mb-2">{{ $reviewable->name }}</h4>
                            @if($type === 'destination')
                                <p class="text-muted mb-2">{{ $reviewable->location }}, {{ $reviewable->country }}</p>
                            @elseif($type === 'activity')
                                <p class="text-muted mb-2">{{ $reviewable->destination->name }}, {{ $reviewable->destination->country }}</p>
                            @elseif($type === 'hotel')
                                <p class="text-muted mb-2">{{ $reviewable->destination->name }}, {{ $reviewable->destination->country }}</p>
                            @endif
                            <div class="d-flex align-items-center gap-4">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-star text-warning me-1"></i>
                                    <span class="fw-semibold">{{ number_format($reviewable->average_rating, 1) }}</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-comments me-2"></i>
                                    <span>{{ $reviewable->total_reviews }} reviews</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Review Form -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0">
                    <h4 class="fw-bold mb-0">Your Review</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('reviews.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="type" value="{{ $type }}">
                        <input type="hidden" name="id" value="{{ $reviewable->id ?? '' }}">

                        <div class="row g-4">
                            <!-- Rating -->
                            <div class="col-12">
                                <label class="form-label fw-semibold">Overall Rating <span class="text-danger">*</span></label>
                                <div class="rating-input mb-3">
                                    @for($i = 1; $i <= 5; $i++)
                                        <input type="radio" name="rating" value="{{ $i }}" id="rating{{ $i }}" 
                                               class="d-none" {{ old('rating') == $i ? 'checked' : '' }}>
                                        <label for="rating{{ $i }}" class="rating-star">
                                            <i class="fas fa-star"></i>
                                        </label>
                                    @endfor
                                </div>
                                @error('rating')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Review Title -->
                            <div class="col-12">
                                <label class="form-label fw-semibold">Review Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                       name="title" value="{{ old('title') }}" 
                                       placeholder="Summarize your experience in a few words" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Review Comment -->
                            <div class="col-12">
                                <label class="form-label fw-semibold">Your Review <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('comment') is-invalid @enderror" 
                                          name="comment" rows="5" 
                                          placeholder="Tell us about your experience. What did you like? What could be improved?" 
                                          required>{{ old('comment') }}</textarea>
                                @error('comment')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Travel Date -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Travel Date</label>
                                <input type="date" class="form-control @error('travel_date') is-invalid @enderror" 
                                       name="travel_date" value="{{ old('travel_date') }}" 
                                       max="{{ date('Y-m-d') }}">
                                @error('travel_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Travel Type -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Travel Type</label>
                                <select class="form-select @error('travel_type') is-invalid @enderror" name="travel_type">
                                    <option value="">Select travel type</option>
                                    <option value="Solo" {{ old('travel_type') == 'Solo' ? 'selected' : '' }}>Solo</option>
                                    <option value="Couple" {{ old('travel_type') == 'Couple' ? 'selected' : '' }}>Couple</option>
                                    <option value="Family" {{ old('travel_type') == 'Family' ? 'selected' : '' }}>Family</option>
                                    <option value="Friends" {{ old('travel_type') == 'Friends' ? 'selected' : '' }}>Friends</option>
                                    <option value="Business" {{ old('travel_type') == 'Business' ? 'selected' : '' }}>Business</option>
                                </select>
                                @error('travel_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Pros -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">What did you like?</label>
                                <div class="pros-container">
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control pros-input" placeholder="Add something you liked">
                                        <button type="button" class="btn btn-outline-success add-pros">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                    <div class="pros-list"></div>
                                </div>
                                <input type="hidden" name="pros" id="pros-hidden">
                            </div>

                            <!-- Cons -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">What could be improved?</label>
                                <div class="cons-container">
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control cons-input" placeholder="Add something to improve">
                                        <button type="button" class="btn btn-outline-danger add-cons">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                    <div class="cons-list"></div>
                                </div>
                                <input type="hidden" name="cons" id="cons-hidden">
                            </div>

                            <!-- Recommended For -->
                            <div class="col-12">
                                <label class="form-label fw-semibold">Recommended For</label>
                                <div class="row g-2">
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="recommended_for[]" value="Families" id="families">
                                            <label class="form-check-label" for="families">Families</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="recommended_for[]" value="Couples" id="couples">
                                            <label class="form-check-label" for="couples">Couples</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="recommended_for[]" value="Solo Travelers" id="solo">
                                            <label class="form-check-label" for="solo">Solo Travelers</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="recommended_for[]" value="Groups" id="groups">
                                            <label class="form-check-label" for="groups">Groups</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Photos -->
                            <div class="col-12">
                                <label class="form-label fw-semibold">Photos (Optional)</label>
                                <input type="file" class="form-control @error('images') is-invalid @enderror" 
                                       name="images[]" multiple accept="image/*">
                                <small class="text-muted">You can upload up to 5 photos</small>
                                @error('images')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="col-12">
                                <div class="d-flex gap-3">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-paper-plane me-2"></i>Submit Review
                                    </button>
                                    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-lg">
                                        <i class="fas fa-arrow-left me-2"></i>Cancel
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.rating-input {
    display: flex;
    gap: 0.5rem;
}

.rating-star {
    font-size: 2rem;
    color: #ddd;
    cursor: pointer;
    transition: color 0.2s ease;
}

.rating-star:hover,
.rating-star:hover ~ .rating-star {
    color: #ffc107;
}

.rating-input input:checked ~ .rating-star,
.rating-input input:checked ~ .rating-star ~ .rating-star {
    color: #ffc107;
}

.pros-list, .cons-list {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-top: 0.5rem;
}

.pros-item, .cons-item {
    background: #d4edda;
    color: #155724;
    padding: 0.25rem 0.5rem;
    border-radius: 0.25rem;
    font-size: 0.875rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.cons-item {
    background: #f8d7da;
    color: #721c24;
}

.pros-item .remove, .cons-item .remove {
    cursor: pointer;
    font-weight: bold;
}

.card:hover {
    transform: translateY(-2px);
    transition: transform 0.3s ease;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Rating stars
    const ratingStars = document.querySelectorAll('.rating-star');
    ratingStars.forEach((star, index) => {
        star.addEventListener('click', function() {
            const rating = index + 1;
            document.querySelector(`input[name="rating"][value="${rating}"]`).checked = true;
        });
    });

    // Pros and cons management
    let prosList = [];
    let consList = [];

    // Add pros
    document.querySelector('.add-pros').addEventListener('click', function() {
        const input = document.querySelector('.pros-input');
        const value = input.value.trim();
        if (value && !prosList.includes(value)) {
            prosList.push(value);
            updateProsList();
            input.value = '';
        }
    });

    // Add cons
    document.querySelector('.add-cons').addEventListener('click', function() {
        const input = document.querySelector('.cons-input');
        const value = input.value.trim();
        if (value && !consList.includes(value)) {
            consList.push(value);
            updateConsList();
            input.value = '';
        }
    });

    // Enter key for pros
    document.querySelector('.pros-input').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            document.querySelector('.add-pros').click();
        }
    });

    // Enter key for cons
    document.querySelector('.cons-input').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            document.querySelector('.add-cons').click();
        }
    });

    function updateProsList() {
        const container = document.querySelector('.pros-list');
        container.innerHTML = '';
        prosList.forEach((item, index) => {
            const div = document.createElement('div');
            div.className = 'pros-item';
            div.innerHTML = `
                <span>${item}</span>
                <span class="remove" onclick="removePros(${index})">&times;</span>
            `;
            container.appendChild(div);
        });
        document.getElementById('pros-hidden').value = JSON.stringify(prosList);
    }

    function updateConsList() {
        const container = document.querySelector('.cons-list');
        container.innerHTML = '';
        consList.forEach((item, index) => {
            const div = document.createElement('div');
            div.className = 'cons-item';
            div.innerHTML = `
                <span>${item}</span>
                <span class="remove" onclick="removeCons(${index})">&times;</span>
            `;
            container.appendChild(div);
        });
        document.getElementById('cons-hidden').value = JSON.stringify(consList);
    }

    // Global functions for removing items
    window.removePros = function(index) {
        prosList.splice(index, 1);
        updateProsList();
    };

    window.removeCons = function(index) {
        consList.splice(index, 1);
        updateConsList();
    };
});
</script>
@endpush
