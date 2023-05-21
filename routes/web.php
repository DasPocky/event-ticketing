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

// Route zum Controller "HomeController"
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'organizer'])->name('organizer.')->prefix('organizer')->group(function () {
    // Hier werden die Routen für den Organizer definiert

    Route::get('/profile', [\App\Http\Controllers\Organizer\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [\App\Http\Controllers\Organizer\ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/organizer', [\App\Http\Controllers\Organizer\ProfileController::class, 'updateOrganizer'])->name('profile.updateOrganizer');
    Route::delete('/profile', [\App\Http\Controllers\Organizer\ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/', [\App\Http\Controllers\Organizer\OrganizerController::class, 'index'])->name('index');

    // Füge die Resource Venue hinzu
    Route::resource('venues', \App\Http\Controllers\Organizer\VenueController::class);

    // Füge eine Route zur View "Views/Events/index.blade.php" hinzu
    Route::resource('events', \App\Http\Controllers\Organizer\EventController::class);

    Route::resource('event.tickets', \App\Http\Controllers\Organizer\TicketController::class);



});

Route::middleware('auth')->name('dashboard.')->prefix('dashboard')->group(function () {

    Route::get('/', [\App\Http\Controllers\Dashboard\DashboardController::class, 'index'])->name('index');

    Route::get('/profile', [\App\Http\Controllers\Dashboard\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [\App\Http\Controllers\Dashboard\ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/customer', [\App\Http\Controllers\Dashboard\ProfileController::class, 'updateCustomer'])->name('profile.updateCustomer');
    Route::delete('/profile', [\App\Http\Controllers\Dashboard\ProfileController::class, 'destroy'])->name('profile.destroy');

});

Route::middleware('auth')->name('purchases.')->group(function () {

    Route::get('/events/{event}/tickets/buy', [\App\Http\Controllers\PurchaseController::class, 'create'])->name('create');
    Route::post('/events/{event}/tickets/buy', [\App\Http\Controllers\PurchaseController::class, 'store'])->name('store');
    Route::get('/purchases/{purchase}', [\App\Http\Controllers\PurchaseController::class, 'show'])->name('show');

});



require __DIR__.'/auth.php';
