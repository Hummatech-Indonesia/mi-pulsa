<?php

use App\Http\Controllers\Dashboard\CustomerController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PackagesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TripayController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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




Auth::routes([
    'verify' => true
]);

Route::get('/', function () {
    return view('pages.index');
});

Route::prefix('tripay')->group(function () {
    Route::name('tripay.')->group(function () {
        Route::get('payment-channel', [TripayController::class, 'paymentChannel']);
        Route::post('request-transaction', [TripayController::class, 'requestTransaction']);
    });
});
Route::get('packages',[PackagesController::class,'index'])->name('packages.index');

Route::get('/home', [HomeController::class, 'index'])->name('home.index');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');
    });

    Route::resource('customers', CustomerController::class);
    Route::resource('products', ProductController::class);
    Route::resource('users', UserController::class);

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::patch('/update', [ProfileController::class, 'update'])->name('update');
        Route::patch('/change-password', [ProfileController::class, 'changePassword'])->name('change.password');
        Route::get('/forgot-password', [ProfileController::class, 'forgotPassword'])->name('forgot.password');
    });
});
