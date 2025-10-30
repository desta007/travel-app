@extends('layouts.app')

@section('title', 'Unsupported File Type - TravelApp')
@section('description', 'The file type you tried to upload is not supported')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 text-center">
            <div class="mb-4">
                <i class="fas fa-file-times fa-5x text-danger mb-4"></i>
                <h1 class="display-1 fw-bold text-danger">415</h1>
                <h2 class="fw-bold mb-3">Unsupported File Type</h2>
                <p class="lead text-muted mb-4">
                    The file type you tried to upload is not supported. Please choose a different file format.
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
                    <h5 class="fw-bold mb-3">Supported file types:</h5>
                    <ul class="list-unstyled text-start">
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-image text-success me-2"></i>
                            <span>Images: JPG, JPEG, PNG, GIF</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-file-pdf text-danger me-2"></i>
                            <span>Documents: PDF, DOC, DOCX</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-file-alt text-info me-2"></i>
                            <span>Text: TXT, RTF</span>
                        </li>
                    </ul>
                    
                    <h6 class="fw-bold mb-3 mt-4">Tips:</h6>
                    <ul class="list-unstyled text-start">
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            <span>Convert files to supported formats</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            <span>Use image editing software to change format</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            <span>Check file extension before uploading</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
