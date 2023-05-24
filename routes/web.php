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

    Route::get('/profile', [\App\Http\Controllers\Organizer\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [\App\Http\Controllers\Organizer\ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/organizer', [\App\Http\Controllers\Organizer\ProfileController::class, 'updateOrganizer'])->name('profile.updateOrganizer');
    Route::delete('/profile', [\App\Http\Controllers\Organizer\ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/profile/stripe/refresh', [\App\Http\Controllers\Organizer\ProfileController::class, 'StripeRefresh'])->name('profile.stripe.refresh');
    Route::get('/profile/stripe/return', [\App\Http\Controllers\Organizer\ProfileController::class, 'StripeReturn'])->name('profile.stripe.return');

    Route::get('/profile/stripe/account/create', [\App\Http\Controllers\Organizer\ProfileController::class, 'StripeAccountCreate'])->name('profile.stripe.account.create');
    // TEST
    // ===
    Route::get('/profile/stripe/account/{user_id}/dashboard', [\App\Http\Controllers\Organizer\ProfileController::class, 'StripeAccountDashboard'])->name('profile.stripe.account.dashboard');
    Route::get('/profile/stripe/account/{user_id}/delete', [\App\Http\Controllers\Organizer\ProfileController::class, 'StripeAccountDelete'])->name('profile.stripe.account.delete');
    // ===
    // TEST

    Route::get('/', [\App\Http\Controllers\Organizer\OrganizerController::class, 'index'])->name('index');
    Route::resource('venues', \App\Http\Controllers\Organizer\VenueController::class);
    Route::resource('events', \App\Http\Controllers\Organizer\EventController::class);
    Route::resource('event.tickets', \App\Http\Controllers\Organizer\TicketController::class);
    Route::resource('event.ticket-groups', \App\Http\Controllers\Organizer\TicketGroupController::class);

});

Route::middleware('auth')->name('dashboard.')->prefix('dashboard')->group(function () {

    Route::get('/', [\App\Http\Controllers\Dashboard\DashboardController::class, 'index'])->name('index');

    Route::get('/profile', [\App\Http\Controllers\Dashboard\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [\App\Http\Controllers\Dashboard\ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/customer', [\App\Http\Controllers\Dashboard\ProfileController::class, 'updateCustomer'])->name('profile.updateCustomer');
    Route::patch('/profile/organizer', [\App\Http\Controllers\Dashboard\ProfileController::class, 'upgradeOrganizer'])->name('profile.upgradeOrganizer');
    Route::delete('/profile', [\App\Http\Controllers\Dashboard\ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/purchases', [\App\Http\Controllers\Dashboard\PurchaseController::class, 'index'])->name('purchases.index');

});

Route::middleware('auth')->name('purchases.')->group(function () {

    Route::get('/events/{event}/tickets/buy', [\App\Http\Controllers\PurchaseController::class, 'create'])->name('create');
    Route::post('/events/{event}/tickets/buy', [\App\Http\Controllers\PurchaseController::class, 'store'])->name('store');
    Route::get('/purchases/{purchase}', [\App\Http\Controllers\PurchaseController::class, 'show'])->name('show');

    Route::get('/success/', [\App\Http\Controllers\PurchaseController::class, 'success'])->name('success');
    Route::get('/cancel', [\App\Http\Controllers\PurchaseController::class, 'cancel'])->name('cancel');

});

Route::post('/stripe/webhook', [\App\Http\Controllers\WebhookController::class, 'handleWebhook']);

require __DIR__.'/auth.php';
