<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LivreController as AdminLivreController;
use App\Http\Controllers\Admin\CategoriesLivreController;
use App\Http\Controllers\Admin\ReservationController as AdminReservationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\LivreController as UserLivreController;
use App\Http\Controllers\User\ReservationController as UserReservationController;
use App\Http\Controllers\User\RatingController;
use App\Http\Controllers\User\CommentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('livres.index');
    }
    return view('welcome');
});

// User Routes (authenticated users)
Route::middleware(['auth', 'verified'])->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User - Browse Books
    Route::get('/livres', [UserLivreController::class, 'index'])->name('livres.index');
    Route::get('/livres/{livre}', [UserLivreController::class, 'show'])->name('livres.show');

    // User - Reservations
    Route::get('/mes-reservations', [UserReservationController::class, 'index'])->name('reservations.index');
    Route::post('/reservations', [UserReservationController::class, 'store'])->name('reservations.store');
    Route::delete('/reservations/{reservation}', [UserReservationController::class, 'destroy'])->name('reservations.destroy');

    // Ratings
    Route::post('/livres/{livre}/rating', [RatingController::class, 'store'])->name('ratings.store');

    // Comments
    Route::post('/livres/{livre}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

// Admin Routes
Route::middleware(['auth', 'isAdmin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Manage Books
    Route::resource('livres', AdminLivreController::class);

    // Manage Categories
    Route::resource('categories', CategoriesLivreController::class);

    // Manage Reservations
    Route::resource('reservations', AdminReservationController::class)->only(['index', 'update', 'destroy']);
    Route::patch('reservations/{reservation}/valider', [AdminReservationController::class, 'valider'])->name('reservations.valider');
    Route::patch('reservations/{reservation}/annuler', [AdminReservationController::class, 'annuler'])->name('reservations.annuler');

    // Manage Users
    Route::resource('users', UserController::class);
});

require __DIR__.'/auth.php';