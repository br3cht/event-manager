<?php

use App\Http\Controllers\EventController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/events', [EventController::class, 'index']);
Route::post('/events/create', [EventController::class,'store'])->middleware(AdminMiddleware::class);
Route::put('/events/edit/{event}', [EventController::class,'update'])->middleware(AdminMiddleware::class);
Route::delete('/events/delete/{event}', [EventController::class, 'delete'])->middleware(['auth', AdminMiddleware::class]);
Route::post('/events/subscribe/{event}', [EventController::class, 'subscribe'])->middleware('auth');
Route::put('/events/cancel-subscription/{event}', [EventController::class, 'cancelSubscribe'])->middleware('auth');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
