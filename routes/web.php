<?php

use App\Http\Controllers\ECard\ECardController;
use App\Http\Controllers\ECard\ECardGenerationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/e-card/generate', [ECardGenerationController::class, 'create'])->name('e-card.generation.create');
    Route::post('/e-card/generate', [ECardGenerationController::class, 'store'])->name('e-card.generation.store');

    Route::get('/e-card/{eCard}', [ECardController::class, 'create'])->name('e-card.edit.create');
    Route::post('/e-card', [ECardController::class, 'store'])->name('e-card.store');
    Route::put('/e-card/{eCard}', [ECardController::class, 'update'])->name('e-card.update');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
