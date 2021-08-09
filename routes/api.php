<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\SecteurController;
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
    // Route::get('/entreprises/{identreprise}', 'API\EntrepriseController@show');

    // Infos Dashboard
});
