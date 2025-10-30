@extends('layouts.app')

@section('title', 'Session Expired - TravelApp')
@section('description', 'Your session has expired, please try again')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 text-center">
            <div class="mb-4">
                <i class="fas fa-clock fa-5x text-warning mb-4"></i>
                <h1 class="display-1 fw-bold text-warning">419</h1>
                <h2 class="fw-bold mb-3">Session Expired</h2>
                <p class="lead text-muted mb-4">
                    Your session has expired for security reasons. Please try again.
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
                    <h5 class="fw-bold mb-3">What happened?</h5>
                    <p class="text-muted mb-3">
                        This usually happens when you've been inactive for too long or when there's a security issue with your session.
                    </p>
                    
                    <h6 class="fw-bold mb-3">To prevent this:</h6>
                    <ul class="list-unstyled text-start">
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            <span>Complete forms quickly</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            <span>Don't leave forms open for too long</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            <span>Refresh the page if you've been away</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
