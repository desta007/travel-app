@extends('layouts.app')

@section('title', 'Unavailable For Legal Reasons - TravelApp')
@section('description', 'This resource is unavailable for legal reasons')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 text-center">
            <div class="mb-4">
                <i class="fas fa-gavel fa-5x text-warning mb-4"></i>
                <h1 class="display-1 fw-bold text-warning">451</h1>
                <h2 class="fw-bold mb-3">Unavailable For Legal Reasons</h2>
                <p class="lead text-muted mb-4">
                    This resource is unavailable for legal reasons. This may be due to copyright, privacy, or other legal restrictions.
                </p>
            </div>
            
            <div class="d-flex justify-content-center gap-3 mb-4">
                <a href="{{ route('home') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-home me-2"></i>Go Home
                </a>
                <a href="{{ route('search') }}" class="btn btn-outline-primary btn-lg">
                    <i class="fas fa-search me-2"></i>Search
                </a>
            </div>
            
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Why this happens:</h5>
                    <ul class="list-unstyled text-start">
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-info-circle text-info me-2"></i>
                            <span>Copyright or intellectual property restrictions</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-info-circle text-info me-2"></i>
                            <span>Privacy or data protection regulations</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-info-circle text-info me-2"></i>
                            <span>Geographic or jurisdictional restrictions</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-info-circle text-info me-2"></i>
                            <span>Content moderation or policy violations</span>
                        </li>
                    </ul>
                    
                    <h6 class="fw-bold mb-3 mt-4">What you can do:</h6>
                    <ul class="list-unstyled text-start">
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            <span>Explore other available content</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            <span>Use our search to find alternatives</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            <span>Contact support for more information</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
