<?php
use App\Http\Controllers\Dashboard\AboutController;
use App\Http\Controllers\Dashboard\ContactController;
use App\Http\Controllers\Dashboard\CustomerController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\TransactionController;
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



Route::prefix('tripay')->group(function () {
    Route::name('tripay.')->group(function () {
        Route::get('payment-channel', [TripayController::class, 'paymentChannel'])->name('payment.channel');
        Route::post('request-transaction', [TripayController::class, 'requestTransaction'])->name('request.transaction');
        Route::post('request-transaction-whatsapp', [TripayController::class, 'requestTransactionWhatsapp'])->name('request.transaction.whatsapp');
    });
});
Route::get('checkout', function () {
    return view('dashboard.pages.packages.checkout');
});



Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::post('upload_image', [DashboardController::class, 'uploadImage'])->name('upload');
Route::get('product', [HomeController::class, 'product'])->name('home.product');
Route::get('about', [HomeController::class, 'about'])->name('about.index');
ROute::get('contact', [HomeController::class, 'contact'])->name('contact.index');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');
    });

    Route::resource('customers', CustomerController::class);
    Route::resource('products', ProductController::class);
    Route::resource('users', UserController::class)->except('index');
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users-agen', [UserController::class, 'agen'])->name('users.agen');

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::patch('/update', [ProfileController::class, 'update'])->name('update');
        Route::patch('/change-password', [ProfileController::class, 'changePassword'])->name('change.password');
        Route::get('/forgot-password', [ProfileController::class, 'forgotPassword'])->name('forgot.password');
    });
    Route::name('packages.')->group(function () {
        Route::get('packages', [PackagesController::class, 'index'])->name('index');
        Route::get('packages-whatsapp', [PackagesController::class, 'transactionWhatsapp'])->name('whatsapp');
    });
    Route::name('transactions.')->group(function () {
        route::post('transaction-whatsapp', [TransactionController::class, 'store'])->name('whatsapp.store');
        route::get('history', [TransactionController::class, 'historyTransaction'])->name('history');
    });

    Route::prefix('configuration')->name('dashboard.')->group(function () {
        Route::get('about', [AboutController::class, 'index'])->name('about.index');
        Route::post('about', [AboutController::class, 'store'])->name('about.store');
        Route::patch('about/{about}', [AboutController::class, 'update'])->name('about.update');
        Route::get('contact', [ContactController::class, 'index'])->name('contact.index');
        Route::post('contact', [ContactController::class, 'store'])->name('contact.store');
        Route::patch('contact/{contact}', [ContactController::class, 'update'])->name('contact.update');
    });
});
