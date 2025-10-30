@extends('layouts.app')

@section('title', 'File Too Large - TravelApp')
@section('description', 'The file you tried to upload is too large')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 text-center">
            <div class="mb-4">
                <i class="fas fa-file-upload fa-5x text-warning mb-4"></i>
                <h1 class="display-1 fw-bold text-warning">413</h1>
                <h2 class="fw-bold mb-3">File Too Large</h2>
                <p class="lead text-muted mb-4">
                    The file you tried to upload is too large. Please choose a smaller file and try again.
                </p>
            </div>
            
            <div class="d-flex justify-content-center gap-3 mb-4">
                <button onclick="history.back()" class="btn btn-primary btn-lg">
                    <i class="fas fa-arrow-left me-2"></i>Go Back
                </button>
                <a href="{{ route('home') }}" class="btn btn-outline-primary btn-lg">
                    <i class="fas fa-home me-2"></i>Go Home
                </a>
            </div>
            
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">File size limits:</h5>
                    <ul class="list-unstyled text-start">
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-info-circle text-info me-2"></i>
                            <span>Images: Maximum 2MB per file</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-info-circle text-info me-2"></i>
                            <span>Documents: Maximum 5MB per file</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-info-circle text-info me-2"></i>
                            <span>Total upload: Maximum 10MB per request</span>
                        </li>
                    </ul>
                    
                    <h6 class="fw-bold mb-3 mt-4">Tips for smaller files:</h6>
                    <ul class="list-unstyled text-start">
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            <span>Compress images before uploading</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            <span>Use lower resolution for photos</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            <span>Split large documents into smaller parts</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
