@extends('layouts.app')

@section('title', 'Request Header Too Large - TravelApp')
@section('description', 'The request header fields are too large')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 text-center">
            <div class="mb-4">
                <i class="fas fa-heading fa-5x text-warning mb-4"></i>
                <h1 class="display-1 fw-bold text-warning">431</h1>
                <h2 class="fw-bold mb-3">Request Header Too Large</h2>
                <p class="lead text-muted mb-4">
                    The request header fields are too large. This usually happens with large cookies or custom headers.
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
                    <h5 class="fw-bold mb-3">What this means:</h5>
                    <ul class="list-unstyled text-start">
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-info-circle text-info me-2"></i>
                            <span>Request headers exceed server limits</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-info-circle text-info me-2"></i>
                            <span>Large cookies or session data</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-info-circle text-info me-2"></i>
                            <span>Custom headers are too large</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-info-circle text-info me-2"></i>
                            <span>Server configuration limits exceeded</span>
                        </li>
                    </ul>
                    
                    <h6 class="fw-bold mb-3 mt-4">Try these solutions:</h6>
                    <ul class="list-unstyled text-start">
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            <span>Clear your browser cookies</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            <span>Clear browser cache and data</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            <span>Try a different browser</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            <span>Disable browser extensions temporarily</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
