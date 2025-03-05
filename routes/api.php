<?php

use App\Http\Controllers\Api\EventController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/events', [EventController::class, 'index'])->middleware('auth:sanctum');
Route::get('/events/{event}', [EventController::class, 'show'])->middleware('auth:sanctum');
Route::post('/events/create', [EventController::class,'store'])->middleware(['auth:sanctum',AdminMiddleware::class]);
Route::put('/events/edit/{event}', [EventController::class,'update'])->middleware(['auth:sanctum',AdminMiddleware::class]);
Route::delete('/events/delete/{event}', [EventController::class, 'delete'])->middleware(['auth:sanctum', AdminMiddleware::class]);
Route::post('/events/subscribe/{event}', [EventController::class, 'subscribe'])->middleware(['auth:sanctum']);
Route::put('/events/cancel-subscription/{event}', [EventController::class, 'cancelSubscribe'])->middleware('auth:sanctum');
