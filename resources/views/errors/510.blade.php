@extends('layouts.app')

@section('title', 'Not Extended - TravelApp')
@section('description', 'Further extensions to the request are required')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 text-center">
            <div class="mb-4">
                <i class="fas fa-plus-circle fa-5x text-warning mb-4"></i>
                <h1 class="display-1 fw-bold text-warning">510</h1>
                <h2 class="fw-bold mb-3">Not Extended</h2>
                <p class="lead text-muted mb-4">
                    Further extensions to the request are required. This is a technical issue that our team is working to resolve.
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
                            <span>Request requires additional extensions</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-info-circle text-info me-2"></i>
                            <span>Server configuration issue</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-info-circle text-info me-2"></i>
                            <span>Protocol or feature not supported</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-info-circle text-info me-2"></i>
                            <span>Technical issue on our end</span>
                        </li>
                    </ul>
                    
                    <h6 class="fw-bold mb-3 mt-4">Try these solutions:</h6>
                    <ul class="list-unstyled text-start">
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            <span>Refresh the page</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            <span>Wait a few minutes and try again</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            <span>Clear your browser cache</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            <span>Contact support if the problem persists</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
