@extends('layouts.app')

@section('title', 'Too Many Requests - TravelApp')
@section('description', 'You have made too many requests, please slow down')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 text-center">
            <div class="mb-4">
                <i class="fas fa-tachometer-alt fa-5x text-warning mb-4"></i>
                <h1 class="display-1 fw-bold text-warning">429</h1>
                <h2 class="fw-bold mb-3">Too Many Requests</h2>
                <p class="lead text-muted mb-4">
                    You've been making requests too quickly. Please slow down and try again in a moment.
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
                    <h5 class="fw-bold mb-3">Why this happened:</h5>
                    <ul class="list-unstyled text-start">
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-info-circle text-info me-2"></i>
                            <span>You're clicking buttons too quickly</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-info-circle text-info me-2"></i>
                            <span>Multiple requests were sent at once</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-info-circle text-info me-2"></i>
                            <span>Automated tools are being used</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-info-circle text-info me-2"></i>
                            <span>Rate limit exceeded</span>
                        </li>
                    </ul>
                    
                    <h6 class="fw-bold mb-3 mt-4">Please wait a moment before trying again.</h6>
                    <p class="text-muted">
                        This helps protect our servers and ensures a better experience for all users.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection