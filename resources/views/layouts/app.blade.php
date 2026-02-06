<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'TravelApp - Discover Amazing Destinations')</title>
    <meta name="description" content="@yield('description', 'Discover amazing destinations, book activities, and find the perfect hotels for your next adventure.')">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    @stack('styles')
</head>
<body class="font-sans antialiased">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="{{ route('home') }}">
                <i class="fas fa-globe-asia me-2"></i>TravelApp
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            Destinations
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('search', ['type' => 'destinations']) }}">All Destinations</a></li>
                            <li><a class="dropdown-item" href="{{ route('search', ['country' => 'Japan']) }}">Japan</a></li>
                            <li><a class="dropdown-item" href="{{ route('search', ['country' => 'Thailand']) }}">Thailand</a></li>
                            <li><a class="dropdown-item" href="{{ route('search', ['country' => 'Indonesia']) }}">Indonesia</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('search', ['type' => 'activities']) }}">Activities</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('search', ['type' => 'hotels']) }}">Hotels</a>
                    </li>
                </ul>
                
                <!-- Search Form -->
                <form class="d-flex me-3" action="{{ route('search') }}" method="GET">
                    <div class="input-group">
                        <input class="form-control" type="search" name="q" placeholder="Search destinations, activities..." value="{{ request('q') }}">
                        <button class="btn btn-outline-primary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
                
                <!-- User Menu -->
                <ul class="navbar-nav">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user me-1"></i>{{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('bookings.index') }}">My Bookings</a></li>
                                <li><a class="dropdown-item" href="{{ route('reviews.my') }}">My Reviews</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary ms-2" href="{{ route('register') }}">Sign Up</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer-premium mt-5">
        <!-- Decorative top border -->
        <div class="footer-top-accent"></div>
        
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5 class="footer-brand fw-bold mb-3">
                        <i class="fas fa-globe-asia me-2"></i>TravelApp
                    </h5>
                    <p class="footer-desc">Discover amazing destinations, book activities, and find the perfect hotels for your next adventure.</p>
                    <div class="d-flex gap-3 mt-4">
                        <a href="#" class="footer-social-link"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="footer-social-link"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="footer-social-link"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="footer-social-link"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="footer-heading fw-bold mb-3">Destinations</h6>
                    <ul class="list-unstyled footer-links">
                        <li><a href="{{ route('search', ['country' => 'Japan']) }}">Japan</a></li>
                        <li><a href="{{ route('search', ['country' => 'Thailand']) }}">Thailand</a></li>
                        <li><a href="{{ route('search', ['country' => 'Indonesia']) }}">Indonesia</a></li>
                        <li><a href="{{ route('search', ['country' => 'Singapore']) }}">Singapore</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="footer-heading fw-bold mb-3">Activities</h6>
                    <ul class="list-unstyled footer-links">
                        <li><a href="{{ route('search', ['type' => 'activities', 'category' => 'Adventure']) }}">Adventure</a></li>
                        <li><a href="{{ route('search', ['type' => 'activities', 'category' => 'Culture']) }}">Culture</a></li>
                        <li><a href="{{ route('search', ['type' => 'activities', 'category' => 'Food']) }}">Food Tours</a></li>
                        <li><a href="{{ route('search', ['type' => 'activities', 'category' => 'Nature']) }}">Nature</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="footer-heading fw-bold mb-3">Support</h6>
                    <ul class="list-unstyled footer-links">
                        <li><a href="#">Help Center</a></li>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">Terms of Service</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="footer-heading fw-bold mb-3">Company</h6>
                    <ul class="list-unstyled footer-links">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="#">Press</a></li>
                        <li><a href="#">Blog</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-divider my-4"></div>
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="footer-copyright mb-0">&copy; {{ date('Y') }} TravelApp. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="footer-copyright mb-0">Made with <i class="fas fa-heart footer-heart"></i> for travelers</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    
    @stack('scripts')
</body>
</html>
