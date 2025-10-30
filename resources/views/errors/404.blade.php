@extends('layouts.app')

@section('title', 'Page Not Found - TravelApp')
@section('description', 'The page you are looking for could not be found')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 text-center">
            <div class="mb-4">
                <i class="fas fa-map-marked-alt fa-5x text-primary mb-4"></i>
                <h1 class="display-1 fw-bold text-primary">404</h1>
                <h2 class="fw-bold mb-3">Page Not Found</h2>
                <p class="lead text-muted mb-4">
                    Oops! The page you're looking for seems to have wandered off on its own adventure.
                </p>
            </div>
            
            <div class="d-flex justify-content-center gap-3 mb-4">
                <a href="{{ route('home') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-home me-2"></i>Go Home
                </a>
                <a href="{{ route('search') }}" class="btn btn-outline-primary btn-lg">
                    <i class="fas fa-search me-2"></i>Explore Destinations
                </a>
            </div>
            
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Popular Destinations</h5>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="{{ route('search', ['country' => 'Japan']) }}" class="text-decoration-none">
                                <div class="d-flex align-items-center p-2 rounded bg-light">
                                    <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                    <span class="fw-semibold">Japan</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('search', ['country' => 'Thailand']) }}" class="text-decoration-none">
                                <div class="d-flex align-items-center p-2 rounded bg-light">
                                    <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                    <span class="fw-semibold">Thailand</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('search', ['country' => 'Indonesia']) }}" class="text-decoration-none">
                                <div class="d-flex align-items-center p-2 rounded bg-light">
                                    <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                    <span class="fw-semibold">Indonesia</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('search', ['country' => 'Singapore']) }}" class="text-decoration-none">
                                <div class="d-flex align-items-center p-2 rounded bg-light">
                                    <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                    <span class="fw-semibold">Singapore</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
