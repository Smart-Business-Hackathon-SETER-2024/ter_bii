<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GareController;
use App\Http\Controllers\GenerateQRCode;
use App\Http\Controllers\AlerteController;
use App\Http\Controllers\AnonceController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TrajetController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => 'api',
], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/me', [AuthController::class, 'me']);
});


Route::group([
    'middleware' => 'api',
    'prefix' => 'alerte',
], function () {
    Route::get('/all', [AlerteController::class, 'index']);
    Route::post('/add', [AlerteController::class, 'store']);
    Route::get('/show/{alerte}', [AlerteController::class, 'show']);
    Route::put('/update/{alerte}', [AlerteController::class, 'update']);
    Route::delete('/delete/{alerte}', [AlerteController::class, 'destroy']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'anonce',
], function () {
    Route::get('/all', [AnonceController::class, 'index']);
    Route::post('/add', [AnonceController::class, 'store']);
    Route::get('/show/{anonce}', [AnonceController::class, 'show']);
    Route::put('/update/{anonce}', [AnonceController::class, 'update']);
    Route::delete('/delete/{anonce}', [AnonceController::class, 'destroy']);
});
Route::group([
    'middleware' => 'api',
    'prefix' => 'gares',
], function () {
    Route::get('/all', [GareController::class, 'index']);
    Route::post('/add', [GareController::class, 'store']);
    Route::get('/show/{gare}', [GareController::class, 'show']);
    Route::put('/update/{gare}', [GareController::class, 'update']);
    Route::delete('/delete/{gare}', [GareController::class, 'destroy']);
});


Route::group([
    'middleware' => 'api',
    'prefix' => 'trajets',
], function () {
    Route::get('/all', [TrajetController::class, 'index']);
    Route::post('/add', [TrajetController::class, 'store']);
    Route::get('/show/{id}', [TrajetController::class, 'show']);
    Route::put('/update/{id}', [TrajetController::class, 'update']);
    Route::delete('/delete/{id}', [TrajetController::class, 'destroy']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'tickets',
], function () {
    Route::get('/historique', [TicketController::class, 'index']);
    Route::post('/add', [TicketController::class, 'store']);
});

Route::get('/qrcode', [GenerateQRCode::class, 'generate']);
