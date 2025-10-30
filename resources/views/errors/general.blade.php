@extends('layouts.app')

@section('title', 'Error - TravelApp')
@section('description', 'An error occurred')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 text-center">
            <div class="mb-4">
                <i class="fas fa-exclamation-triangle fa-5x text-danger mb-4"></i>
                <h1 class="display-1 fw-bold text-danger">Error</h1>
                <h2 class="fw-bold mb-3">Something Went Wrong</h2>
                <p class="lead text-muted mb-4">
                    An unexpected error occurred. Our team has been notified and is working to fix it.
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
                    <h5 class="fw-bold mb-3">What you can do:</h5>
                    <ul class="list-unstyled text-start">
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            <span>Try refreshing the page</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            <span>Go back to the homepage</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            <span>Try again in a few minutes</span>
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
