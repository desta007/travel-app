@extends('layouts.app')

@section('title', 'URL Too Long - TravelApp')
@section('description', 'The URL you requested is too long')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 text-center">
            <div class="mb-4">
                <i class="fas fa-link fa-5x text-warning mb-4"></i>
                <h1 class="display-1 fw-bold text-warning">414</h1>
                <h2 class="fw-bold mb-3">URL Too Long</h2>
                <p class="lead text-muted mb-4">
                    The URL you requested is too long. Please use a shorter URL or try a different approach.
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
                            <span>The URL contains too many characters</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-info-circle text-info me-2"></i>
                            <span>Long search queries or parameters</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-info-circle text-info me-2"></i>
                            <span>Deep nested URLs</span>
                        </li>
                    </ul>
                    
                    <h6 class="fw-bold mb-3 mt-4">Try these instead:</h6>
                    <ul class="list-unstyled text-start">
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            <span>Use the search form instead of long URLs</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            <span>Navigate using the menu</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            <span>Use shorter search terms</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
