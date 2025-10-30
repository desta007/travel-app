@extends('layouts.app')

@section('title', 'Service Unavailable - TravelApp')
@section('description', 'The service is temporarily unavailable')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 text-center">
            <div class="mb-4">
                <i class="fas fa-tools fa-5x text-warning mb-4"></i>
                <h1 class="display-1 fw-bold text-warning">503</h1>
                <h2 class="fw-bold mb-3">Service Unavailable</h2>
                <p class="lead text-muted mb-4">
                    We're currently performing maintenance or experiencing high traffic. Please try again later.
                </p>
            </div>
            
            <div class="d-flex justify-content-center gap-3 mb-4">
                <button onclick="window.location.reload()" class="btn btn-primary btn-lg">
                    <i class="fas fa-redo me-2"></i>Try Again
                </button>
                <a href="{{ route('home') }}" class="btn btn-outline-primary btn-lg">
                    <i class="fas fa-home me-2"></i>Go Home
                </a>
            </div>
            
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">What's happening?</h5>
                    <ul class="list-unstyled text-start">
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-info-circle text-info me-2"></i>
                            <span>Scheduled maintenance is in progress</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-info-circle text-info me-2"></i>
                            <span>High traffic is causing delays</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-info-circle text-info me-2"></i>
                            <span>We're updating our systems</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-info-circle text-info me-2"></i>
                            <span>Server overload or capacity issues</span>
                        </li>
                    </ul>
                    
                    <h6 class="fw-bold mb-3 mt-4">We'll be back soon!</h6>
                    <p class="text-muted">
                        Our team is working hard to restore service. Please check back in a few minutes.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection