<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ExchangeRequestController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LanguageController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/register', [AuthController::class, 'showRegister'])
    ->middleware('guest')
    ->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->middleware('guest');

Route::get('/login', [AuthController::class, 'showLogin'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->middleware('guest');

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::resource('items', ItemController::class)
    ->middleware(['create' => 'auth', 'store' => 'auth', 
    'edit' => 'auth', 'update' => 'auth', 'destroy' => 'auth']);

    Route::get('/language/{locale}', [LanguageController::class, 'switch'])
    ->name('language.switch');
    
Route::middleware('auth')->group(function () {
    Route::get('/items/{item}/request', [ExchangeRequestController::class, 'create'])
        ->name('requests.create');

    Route::post('/items/{item}/request', [ExchangeRequestController::class, 'store'])
        ->name('requests.store');

    Route::get('/requests/incoming', [ExchangeRequestController::class, 'incoming'])
        ->name('requests.incoming');

    Route::post('/requests/{requestModel}/approve', [ExchangeRequestController::class, 'approve'])
        ->name('requests.approve');

    Route::post('/requests/{requestModel}/reject', [ExchangeRequestController::class, 'reject'])
        ->name('requests.reject');
    
    Route::get('/requests/{requestModel}/review/create',
    [ReviewController::class, 'create'])
    ->name('reviews.create');

    Route::post('/requests/{requestModel}/review',
    [ReviewController::class, 'store'])
    ->name('reviews.store');

    Route::get('/requests/my', [ExchangeRequestController::class, 'myRequests'])
    ->name('requests.my');

    Route::get('/profile', [ProfileController::class, 'show'])
    ->middleware('auth')
    ->name('profile');
    
    Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])
        ->name('admin.index');

    Route::post('/admin/users/{user}/block', [AdminController::class, 'blockUser'])
        ->name('admin.users.block');

    Route::post('/admin/users/{user}/unblock', [AdminController::class, 'unblockUser'])
        ->name('admin.users.unblock');
});
});