<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ReviewController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/destinations/{destination}', [HomeController::class, 'destination'])->name('destinations.show');
Route::get('/activities/{activity}', [HomeController::class, 'activity'])->name('activities.show');
Route::get('/hotels/{hotel}', [HomeController::class, 'hotel'])->name('hotels.show');

// Authentication routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (\Illuminate\Http\Request $request) {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (\Illuminate\Support\Facades\Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/');
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
});

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', function (\Illuminate\Http\Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    $user = \App\Models\User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => \Illuminate\Support\Facades\Hash::make($validated['password']),
    ]);

    \Illuminate\Support\Facades\Auth::login($user);

    return redirect('/');
});

Route::post('/logout', function (\Illuminate\Http\Request $request) {
    \Illuminate\Support\Facades\Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// Review routes
Route::get('/destinations/{destination}/reviews', [ReviewController::class, 'destination'])->name('reviews.destination');
Route::get('/activities/{activity}/reviews', [ReviewController::class, 'activity'])->name('reviews.activity');
Route::get('/hotels/{hotel}/reviews', [ReviewController::class, 'hotel'])->name('reviews.hotel');
Route::post('/reviews/{review}/helpful', [ReviewController::class, 'helpful'])->name('reviews.helpful');

// Authenticated routes
Route::middleware(['auth'])->group(function () {
    // Booking routes
    Route::get('/activities/{activity}/book', [BookingController::class, 'createActivity'])->name('bookings.create.activity');
    Route::get('/hotels/{hotel}/book', [BookingController::class, 'createHotel'])->name('bookings.create.hotel');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
    Route::post('/bookings/{booking}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');
    Route::post('/bookings/{booking}/payment', [BookingController::class, 'payment'])->name('bookings.payment');

    // Review routes
    Route::get('/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/my-reviews', [ReviewController::class, 'myReviews'])->name('reviews.my');
});

// API routes for AJAX requests
Route::prefix('api')->group(function () {
    Route::get('/destinations', function () {
        return \App\Models\Destination::active()
            ->select('id', 'name', 'country', 'city', 'image_url')
            ->get();
    });

    Route::get('/activities/search', function (\Illuminate\Http\Request $request) {
        $query = $request->get('q');
        return \App\Models\Activity::active()
            ->where('name', 'like', "%{$query}%")
            ->with('destination:id,name,country')
            ->select('id', 'name', 'price', 'image_url', 'destination_id')
            ->limit(10)
            ->get();
    });

    Route::get('/hotels/search', function (\Illuminate\Http\Request $request) {
        $query = $request->get('q');
        return \App\Models\Hotel::active()
            ->where('name', 'like', "%{$query}%")
            ->with('destination:id,name,country')
            ->select('id', 'name', 'price_per_night', 'image_url', 'destination_id')
            ->limit(10)
            ->get();
    });
});