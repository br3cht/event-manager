<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Middleware\AdminMiddleware;
use App\Livewire\Auth\Login;
use App\Livewire\Events;
use App\Livewire\Home;
use App\Livewire\MyEvents;
use App\Livewire\Register;
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

// Route::get('/events', [EventController::class, 'index']);
// Route::post('/events/create', [EventController::class, 'store'])->middleware(AdminMiddleware::class);
// Route::put('/events/edit/{event}', [EventController::class, 'update'])->middleware(AdminMiddleware::class);
// Route::delete('/events/delete/{event}', [EventController::class, 'delete'])->middleware(['auth', AdminMiddleware::class]);
// Route::post('/events/subscribe/{event}', [EventController::class, 'subscribe'])->middleware('auth');
// Route::put('/events/cancel-subscription/{event}', [EventController::class, 'cancelSubscribe'])->middleware('auth');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function(){
        return view('dashboard');
    })->middleware(AdminMiddleware::class);
});

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', Events::class)->name('home');
Route::get('/meus-eventos', MyEvents::class)->name('meus-eventos');
Route::get('/register', Register::class)->name('registrar');
