<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;
use App\Livewire\Profile\Settings;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialiteController;
use App\Models\Car;
use App\Models\Transaction;

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Socialite Routes
Route::get('/auth/{provider}/redirect', [SocialiteController::class, 'redirect'])
    ->name('socialite.redirect');
Route::get('/auth/{provider}/callback', [SocialiteController::class, 'callback'])
    ->name('socialite.callback');

// Account Settings Routes
Route::get('/account/settings', [AccountController::class, 'settings'])->name('account.settings');
Route::put('/account/profile/update', [AccountController::class, 'updateProfile'])->name('account.profile.update');
Route::put('/account/password/update', [AccountController::class, 'updatePassword'])->name('account.password.update');

Route::get('/cars/{car}', function (Car $car) {
    return view('car.car-detail-page', ['car' => $car]);
})->name('cars.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/order/{car}', function(Car $car) {  // Add Car model type hint
        return view('order.order-form-page', ['car' => $car]);
    })->name('order.form');

    Route::get('/transaction/{transaction}', function(Transaction $transaction) {
        return view('transaction.transaction-detail-page', ['transaction' => $transaction]);
    })->name('transaction.show');
});
