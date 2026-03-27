<?php

use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ProduitController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ClientLoginController;


Route::get('/', function () {
    return view('layout.index');
})->name('home');


Route::get('/login', [ClientLoginController::class, 'showLogin'])->name('login');


Route::post('/login', [ClientLoginController::class, 'login'])->name('login.submit');


Route::post('/register', [ClientLoginController::class, 'register'])->name('register');


Route::post('/logout', [ClientLoginController::class, 'logout'])->name('logout');


Route::get('/dashboard', function () {
    return view('layout.index');
})->middleware('auth:client')->name('dashboard');


Route::get('/catalogue', function () {
    return view('layout.Produits.Catalogue');
})->name('catalogue');



Route::get('/dashboardGestionnaire', function () {
    return view('layout.gestionnaire.dashboardGestionnaire');
})->middleware('auth:client')->name('dashboardGestionnaire');





Route::get('/GestionProduits', [ProduitController::class, 'index'])
    ->middleware('auth:client')
    ->name('gestion.produits');






Route::resource('categories', CategorieController::class);

Route::resource('produits', ProduitController::class)
    ->except(['index'])
    ->middleware('auth:client');



// Remplace l'ancienne route par celle-là :
Route::get('/catalogue', [ProduitController::class, 'catalogue'])->name('catalogue');
// Route pour archiver
Route::put('/produits/{id}/archiver', [ProduitController::class, 'archiver'])->name('produits.archiver');
