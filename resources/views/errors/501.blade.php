@extends('layouts.app')

@section('title', 'Not Implemented - TravelApp')
@section('description', 'This feature is not yet implemented')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 text-center">
            <div class="mb-4">
                <i class="fas fa-tools fa-5x text-warning mb-4"></i>
                <h1 class="display-1 fw-bold text-warning">501</h1>
                <h2 class="fw-bold mb-3">Not Implemented</h2>
                <p class="lead text-muted mb-4">
                    This feature is not yet implemented. We're working on it and it will be available soon.
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
                    <h5 class="fw-bold mb-3">What this means:</h5>
                    <ul class="list-unstyled text-start">
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-info-circle text-info me-2"></i>
                            <span>This feature is still in development</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-info-circle text-info me-2"></i>
                            <span>Server doesn't support this request method</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-info-circle text-info me-2"></i>
                            <span>Feature is planned but not yet available</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-info-circle text-info me-2"></i>
                            <span>We're working hard to bring it to you</span>
                        </li>
                    </ul>
                    
                    <h6 class="fw-bold mb-3 mt-4">Stay tuned!</h6>
                    <p class="text-muted">
                        We're constantly improving our platform. Check back soon for updates and new features.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
