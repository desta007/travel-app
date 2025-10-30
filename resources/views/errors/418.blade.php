@extends('layouts.app')

@section('title', 'I\'m a Teapot - TravelApp')
@section('description', 'The server is a teapot and cannot brew coffee')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 text-center">
            <div class="mb-4">
                <i class="fas fa-coffee fa-5x text-primary mb-4"></i>
                <h1 class="display-1 fw-bold text-primary">418</h1>
                <h2 class="fw-bold mb-3">I'm a Teapot</h2>
                <p class="lead text-muted mb-4">
                    The server is a teapot and cannot brew coffee. This is an April Fools' joke from the HTTP specification.
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
                    <h5 class="fw-bold mb-3">About this error:</h5>
                    <p class="text-muted mb-3">
                        This is a humorous error code from the HTTP specification (RFC 2324) that was created as an April Fools' joke. 
                        It's not commonly used in real applications, but it's a fun way to handle unexpected errors.
                    </p>
                    
                    <h6 class="fw-bold mb-3">Fun facts:</h6>
                    <ul class="list-unstyled text-start">
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-info-circle text-info me-2"></i>
                            <span>Created as an April Fools' joke in 1998</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-info-circle text-info me-2"></i>
                            <span>Part of the Hyper Text Coffee Pot Control Protocol</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <i class="fas fa-info-circle text-info me-2"></i>
                            <span>Officially recognized by the IETF</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
