@extends('layouts.app')

@section('title', 'Unauthorized - TravelApp')
@section('description', 'You need to be logged in to access this resource')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 text-center">
            <div class="mb-4">
                <i class="fas fa-user-lock fa-5x text-warning mb-4"></i>
                <h1 class="display-1 fw-bold text-warning">401</h1>
                <h2 class="fw-bold mb-3">Unauthorized</h2>
                <p class="lead text-muted mb-4">
                    You need to be logged in to access this resource. Please sign in to continue.
                </p>
            </div>
            
            <div class="d-flex justify-content-center gap-3 mb-4">
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-sign-in-alt me-2"></i>Sign In
                </a>
                <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg">
                    <i class="fas fa-user-plus me-2"></i>Sign Up
                </a>
            </div>
            
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Why you need to sign in:</h5>
                    <ul class="list-unstyled text-start">
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-info-circle text-info me-2"></i>
                            <span>To access your personal bookings</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-info-circle text-info me-2"></i>
                            <span>To write reviews and ratings</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-info-circle text-info me-2"></i>
                            <span>To make new bookings</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-info-circle text-info me-2"></i>
                            <span>To save your preferences</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
