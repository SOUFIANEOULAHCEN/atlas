<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;
use App\Models\Compte;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
// Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [AuthController::class, 'login']);
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
// Route::post('/register', [AuthController::class, 'register']);

// Route::middleware('auth')->group(function () {
//     // User routes
//     Route::prefix('user')->group(function () {
//         Route::resource('reservations', ReservationController::class)->only(['index', 'create', 'store', 'destroy']);
//     });

//     // Admin routes
//     Route::prefix('admin')->group(function () {
//         Route::get('reservations', [ReservationController::class, 'adminIndex'])->name('admin.reservations');
//         Route::delete('reservations/{reservation}', [ReservationController::class, 'adminDestroy'])->name('admin.reservations.destroy');
//         Route::get('statistics', [ReservationController::class, 'statistics'])->name('admin.statistics');
//     });
// });

// Route::middleware('auth')->group(function () {
//     // Profile routes
//     Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile.show');
//     Route::get('/profile/edit', [AuthController::class, 'editProfile'])->name('profile.edit');
//     Route::put('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');
// });

// Route::get('/dashboard', function () {
//     $reservations = \App\Models\Reservation::where('Matricule', Auth::user()->Matricule)->get();
//     return view('user.dashboard', compact('reservations'));
// })->name('user.dashboard');

// Route::get('/admin', function () {
//     $totalUsers = Compte::count();
//     $todayReservations = Reservation::whereDate('DateReservation', today())->count();
//     $monthReservations = Reservation::whereMonth('DateReservation', now()->month)->count();

//     return view('admin.dashboard', compact('totalUsers', 'todayReservations', 'monthReservations'));
// })->name('admin.dashboard');




Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth')->group(function () {
    // User routes
    Route::middleware('auth')->prefix('user')->group(function () {
        Route::resource('reservations', ReservationController::class)->only(['index', 'create', 'store', 'destroy']);
    });

    // Admin routes
    Route::middleware('auth')->prefix('admin')->group(function () {
        Route::get('reservations', [ReservationController::class, 'adminIndex'])->name('admin.reservations');
        Route::delete('reservations/{reservation}', [ReservationController::class, 'adminDestroy'])->name('admin.reservations.destroy');
        Route::get('statistics', [ReservationController::class, 'statistics'])->name('admin.statistics');

        // User management routes
        Route::get('users', [UserController::class, 'index'])->name('admin.users.index');
        Route::get('users/{matricule}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('users/{matricule}', [UserController::class, 'update'])->name('admin.users.update');
        Route::delete('users/{matricule}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    });
});

Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile.show');
    Route::get('/profile/edit', [AuthController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');
});

Route::get('/dashboard', function () {
    $reservations = \App\Models\Reservation::where('Matricule', Auth::user()->Matricule)->get();
    return view('user.dashboard', compact('reservations'));
})->middleware('auth')->name('user.dashboard');

Route::get('/admin', function () {
    // Ensure user is admin
    if (Auth::user()->TypeCompte !== 'admin') {
        abort(403);
    }

    $totalUsers = Compte::count();
    $todayReservations = Reservation::whereDate('DateReservation', today())->count();
    $monthReservations = Reservation::whereMonth('DateReservation', now()->month)->count();

    return view('admin.dashboard', compact('totalUsers', 'todayReservations', 'monthReservations'));
})->middleware('auth')->name('admin.dashboard');
