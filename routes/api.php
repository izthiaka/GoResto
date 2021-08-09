<?php

use App\Http\Controllers\API\AuthController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
