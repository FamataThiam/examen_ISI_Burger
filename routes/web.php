<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ClientLoginController;

// Page d'accueil (index.blade.php)
Route::get('/', function () {
    return view('layout.index');
})->name('home');

// LOGIN - Affichage du formulaire
Route::get('/login', [ClientLoginController::class, 'showLogin'])->name('login');

// LOGIN - Traitement du formulaire
Route::post('/login', [ClientLoginController::class, 'login'])->name('login.submit');

// REGISTER - Traitement du formulaire
Route::post('/register', [ClientLoginController::class, 'register'])->name('register');

// LOGOUT
Route::post('/logout', [ClientLoginController::class, 'logout'])->name('logout');

// Dashboard ou page après login
Route::get('/dashboard', function () {
    return view('layout.index');
})->middleware('auth:client')->name('dashboard');
