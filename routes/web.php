<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SocialAuthController;

// Login Page
Route::get('/', function () {
    return view('login');
});

Route::get('/login', function () {
    return view('login');
});

// AJAX Login Route
Route::post('/ajax-login', [AuthController::class, 'login'])->name('ajax.login');

// Social Authentication
Route::get('/auth/{provider}/redirect', [SocialAuthController::class, 'redirect']);
Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'callback']);
