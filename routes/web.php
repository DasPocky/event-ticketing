<?php

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
    return view('home');
})->name('home');

Route::middleware(['auth', 'organizer'])->name('organizer.')->prefix('organizer')->group(function () {
    // Hier werden die Routen für den Organizer definiert

    Route::get('/profile', [\App\Http\Controllers\Organizer\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [\App\Http\Controllers\Organizer\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [\App\Http\Controllers\Organizer\ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/', [\App\Http\Controllers\Organizer\OrganizerController::class, 'index'])->name('index');

});

Route::middleware('auth')->name('dashboard.')->prefix('dashboard')->group(function () {

    Route::get('/', [\App\Http\Controllers\Dashboard\DashboardController::class, 'index'])->name('index');

    Route::get('/profile', [\App\Http\Controllers\Dashboard\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [\App\Http\Controllers\Dashboard\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [\App\Http\Controllers\Dashboard\ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
