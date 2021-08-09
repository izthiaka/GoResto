<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CaisseController;
use App\Http\Controllers\API\CategorieController;
use App\Http\Controllers\API\ProduitController;
use App\Http\Controllers\API\SecteurController;
use App\Http\Controllers\API\TableController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['cors', 'json.response']], function () {

    // public routes
    Route::post('/register', [AuthController::class, 'register'])->name('register.api');
    Route::post('/login', [AuthController::class, 'login'])->name('login.api');
    Route::post(
        '/', function () {
            return redirect()->route('login.api');
        }
    );

});

Route::middleware('auth:api')->group(function () {
    // our routes to be protected will go in here
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout.api');

    // Infos profil
    // Route::get('/profil', 'API\UserController@profil');

    // Resource Serveur
    Route::get('/secteurs', [SecteurController::class, 'index']);
    Route::post('/secteur', [SecteurController::class, 'store']);
    Route::get('/secteurs/{id}', [SecteurController::class, 'show']);
    Route::put('/secteur/{id}', [SecteurController::class, 'update']);
    Route::delete('/secteur/{id}', [SecteurController::class, 'destroy']);

    // Resource Categorie
    Route::get('/categories', [CategorieController::class, 'index']);
    Route::post('/categorie', [CategorieController::class, 'store']);
    Route::get('/categories/{id}', [CategorieController::class, 'show']);
    Route::put('/categorie/{id}', [CategorieController::class, 'update']);
    Route::delete('/categorie/{id}', [CategorieController::class, 'destroy']);

    // Resource Table
    Route::get('/tables', [TableController::class, 'index']);
    Route::post('/table', [TableController::class, 'store']);
    Route::get('/tables/{id}', [TableController::class, 'show']);
    Route::put('/table/{id}', [TableController::class, 'update']);
    Route::delete('/table/{id}', [TableController::class, 'destroy']);

    // Resource Caisse
    Route::get('/caisses', [CaisseController::class, 'index']);
    Route::post('/caisse', [CaisseController::class, 'store']);
    Route::get('/caisses/{id}', [CaisseController::class, 'show']);
    Route::put('/caisse/{id}', [CaisseController::class, 'update']);
    Route::delete('/caisse/{id}', [CaisseController::class, 'destroy']);

    // Resource Produit
    Route::get('/produits', [ProduitController::class, 'index']);
    Route::post('/produit', [ProduitController::class, 'store']);
    Route::get('/produits/{id}', [ProduitController::class, 'show']);
    Route::put('/produit/{id}', [ProduitController::class, 'update']);
    Route::delete('/produit/{id}', [ProduitController::class, 'destroy']);

    // Infos Dashboard
});
