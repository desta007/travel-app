@extends('layouts.app')

@section('title', 'Login - TravelApp')
@section('description', 'Login to your TravelApp account')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card border-0 shadow-lg">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold text-primary mb-3">
                            <i class="fas fa-globe-asia me-2"></i>TravelApp
                        </h2>
                        <h4 class="fw-bold">Welcome Back</h4>
                        <p class="text-muted">Sign in to your account to continue</p>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email') }}" 
                                       placeholder="Enter your email" required autofocus>
                            </div>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">Password</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                       id="password" name="password" placeholder="Enter your password" required>
                            </div>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">
                                Remember me
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100 mb-3">
                            <i class="fas fa-sign-in-alt me-2"></i>Sign In
                        </button>
                    </form>

                    <div class="text-center">
                        <p class="text-muted mb-0">Don't have an account? 
                            <a href="{{ route('register') }}" class="text-primary fw-semibold text-decoration-none">
                                Sign up here
                            </a>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Demo Account Info -->
            <div class="card border-0 shadow-sm mt-4">
                <div class="card-body">
                    <h6 class="fw-bold text-center mb-3">Demo Account</h6>
                    <div class="row g-2">
                        <div class="col-6">
                            <small class="text-muted">Email:</small>
                            <div class="fw-semibold">demo@travelapp.com</div>
                        </div>
                        <div class="col-6">
                            <small class="text-muted">Password:</small>
                            <div class="fw-semibold">password</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.card {
    border-radius: 1rem;
}

.input-group-text {
    background: transparent;
    border-right: none;
    color: #6c757d;
}

.form-control {
    border-left: none;
}

.form-control:focus {
    border-left: none;
    box-shadow: none;
}

.input-group:focus-within .input-group-text {
    color: var(--primary-color);
}

.btn-primary {
    background: var(--gradient-primary);
    border: none;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
    transform: translateY(-2px);
}
</style>
@endpush
