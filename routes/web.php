<?php

use Illuminate\Http\Request;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminEventController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminVoucherController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminOrderController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\MyEventController;

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

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::redirect('/admin', '/admin/dashboard');

Route::middleware(['auth', 'isAdmin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Events
    Route::get('/events', [AdminEventController::class, 'index'])->name('events.index');
    Route::get('/events/create', [AdminEventController::class, 'create'])->name('events.create');
    Route::post('/events', [AdminEventController::class, 'store'])->name('events.store');
    Route::get('/events/{event}/edit', [AdminEventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{event}', [AdminEventController::class, 'update'])->name('events.update');
    Route::delete('/events/{event}', [AdminEventController::class, 'destroy'])->name('events.destroy');

    // Orders
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');

    // Users
    Route::resource('users', AdminUserController::class);

    // Voucher
    Route::resource('vouchers', AdminVoucherController::class);
});

Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Detail Event
    Route::get('/event/{event}', [EventController::class, 'show'])->name('event.show');
    Route::post('/event/{event}/like', [EventController::class, 'toggleLike'])->middleware('auth')->name('event.like');

    // Checkout
    Route::get('/checkout/{event}', [CheckoutController::class, 'show'])->name('checkout.show');
    Route::post('/checkout/{event}', [CheckoutController::class, 'store'])->name('checkout.store');

    // Ticket
    Route::get('/ticket/{order}', [TicketController::class, 'show'])
        ->middleware('auth')
        ->name('ticket.show');

    // My Event
    Route::get('/my-events', [MyEventController::class, 'index'])
        ->middleware('auth')
        ->name('my-events.index');
});

require __DIR__ . '/auth.php';
