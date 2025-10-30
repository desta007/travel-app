@extends('layouts.app')

@section('title', 'HTTP Version Not Supported - TravelApp')
@section('description', 'The HTTP version used in the request is not supported')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 text-center">
            <div class="mb-4">
                <i class="fas fa-code fa-5x text-warning mb-4"></i>
                <h1 class="display-1 fw-bold text-warning">505</h1>
                <h2 class="fw-bold mb-3">HTTP Version Not Supported</h2>
                <p class="lead text-muted mb-4">
                    The HTTP version used in the request is not supported by the server. Please update your browser or application.
                </p>
            </div>
            
            <div class="d-flex justify-content-center gap-3 mb-4">
                <a href="{{ route('home') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-home me-2"></i>Go Home
                </a>
                <button onclick="window.location.reload()" class="btn btn-outline-primary btn-lg">
                    <i class="fas fa-redo me-2"></i>Try Again
                </button>
            </div>
            
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">What this means:</h5>
                    <ul class="list-unstyled text-start">
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-info-circle text-info me-2"></i>
                            <span>Your browser is using an outdated HTTP version</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-info-circle text-info me-2"></i>
                            <span>Server doesn't support the HTTP version used</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-info-circle text-info me-2"></i>
                            <span>Protocol version mismatch</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-info-circle text-info me-2"></i>
                            <span>Security or compatibility requirements not met</span>
                        </li>
                    </ul>
                    
                    <h6 class="fw-bold mb-3 mt-4">What to do:</h6>
                    <ul class="list-unstyled text-start">
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            <span>Update your browser to the latest version</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            <span>Enable modern web standards</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            <span>Clear browser cache and cookies</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            <span>Try a different browser</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
