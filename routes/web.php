<?php

use App\Http\Controllers\CategorieController;
use App\Http\Controllers\CommandeController;
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



//Route::get('/dashboardGestionnaire', function () {
//    return view('layout.gestionnaire.dashboardGestionnaire');
//})->middleware('auth:client')->name('dashboardGestionnaire');





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


Route::get('/panier', function () {
    return view('layout.Produits.Panier');
})->name('panier');

Route::post('/commandes/valider', [App\Http\Controllers\CommandeController::class, 'store'])
    ->middleware('auth:client')
    ->name('commandes.store');


Route::post('/commandes/{id}/prete', [CommandeController::class, 'marquerPrete'])
    ->middleware('auth:client')
    ->name('commandes.prete');

Route::get('/commandes', [CommandeController::class, 'index'])
    ->middleware('auth:client')
    ->name('commandes.index');


// Liste des commandes payées
Route::get('/gestion/recettes', [CommandeController::class, 'commandesPayees'])
    ->middleware('auth:client')
    ->name('gestion.recettes');



Route::get('/gestion/recettes', [CommandeController::class, 'commandesPayees'])->name('gestion.recettes');


Route::get('/dashboardGestionnaire', [CommandeController::class, 'tableaudeboard'])
    ->middleware('auth:client')
    ->name('dashboardGestionnaire');


Route::get('/statistiques', [CommandeController::class, 'statistiques'])
    ->middleware('auth:client')
    ->name('gestion.statistiques');
