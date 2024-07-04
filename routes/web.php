<?php

use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\Dashboard\AboutController;
use App\Http\Controllers\Dashboard\ContactController;
use App\Http\Controllers\Dashboard\CustomerController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\TransactionController;
use App\Http\Controllers\DigiFlazzController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PackagesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProviderController;
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

Route::prefix('digi-flazz')->name('digi-flazz.')->group(function () {
    Route::post('cek-saldo', [DigiFlazzController::class, 'cekSaldo'])->name('ceksaldo');
    Route::post('price-list', [DigiFlazzController::class, 'priceList'])->name('pricelist');
    Route::get('get-price-list', [DigiFlazzController::class, 'getPriceList'])->name('get.price.list');
    Route::post('deposit', [DigiFlazzController::class, 'deposit'])->name('deposit');
    Route::post('blazz-top-up', [DigiFlazzController::class, 'blazzTopUp'])->name('blazz.topup');
    Route::post('transaction/{customer}', [DigiFlazzController::class, 'transaction'])->name('transaction');
    Route::post('repeat-transaction/{transaction}', [DigiFlazzController::class, 'repeatTransaction'])->name('repeat.transaction');

    Route::post('callback', [DigiFlazzController::class, 'callback'])->name('callback');
});

Route::prefix('tripay')->group(function () {
    Route::name('tripay.')->group(function () {
        Route::get('payment-channel', [TripayController::class, 'paymentChannel'])->name('payment.channel');
        Route::post('request-transaction', [TripayController::class, 'requestTransaction'])->name('request.transaction');
        Route::get('checkout-transaction/{topupAgen}', [TripayController::class, 'checkoutTransaction'])->name('checkout.transaction');
        Route::post('request-transaction-whatsapp', [TripayController::class, 'requestTransactionWhatsapp'])->name('request.transaction.whatsapp');
        Route::get('instructions/{topupAgen}', [TripayController::class, 'instructions'])->name('instructions');
    });
});
Route::get('checkout', function () {
    return view('dashboard.pages.packages.checkout');
});


Route::name('home.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('product', [HomeController::class, 'product'])->name('product');
    Route::get('about', [HomeController::class, 'about'])->name('about');
    Route::get('contact', [HomeController::class, 'contact'])->name('contact');
    Route::post('contact-us', [ContactUsController::class, 'store'])->name('contactus.store');
});
Route::post('upload_image', [DashboardController::class, 'uploadImage'])->name('upload');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');
        Route::get('topup-digiflazz', [DashboardController::class, 'index'])->name('topup.digiflazz');
        Route::get('topup-customer', [TransactionController::class, 'index'])->name('topup.customer');
        Route::get('json-customer', [TransactionController::class, 'jsonCustomer'])->name('json.customer');
        Route::get('history-topup-customer', [TransactionController::class, 'historyTopupCustomer'])->name('topup.history');
        Route::get('history-topup-customer-multiple', [TransactionController::class, 'historyTopupCustomerMultiple'])->name('topup.history.multiple');
        Route::get('history-topup-customer-multiple/{blazz_id?}', [TransactionController::class, 'detailHistoryTopupCustomerMultiple'])->name('detail.topup.history.multiple');
        Route::get('history-digiflazz', [DashboardController::class, 'index'])->name('history.digiflazz');

        Route::resources([
            'providers' => ProviderController::class
        ]);
    });

    Route::resource('customers', CustomerController::class);
    Route::patch('update-product-customer/{customer}', [CustomerController::class, 'customerProduct'])->name('update.product.customer');
    Route::post('customers-import', [CustomerController::class, 'import'])->name('customers.import');
    Route::get('products', [ProductController::class, 'index'])->name('products.index');
    Route::get('json-products', [ProductController::class, 'jsonProduct'])->name('json.products');
    Route::patch('product-selling-price/{product}', [ProductController::class, 'sellingPrice'])->name('product.selling.price');
    Route::resource('users', UserController::class)->except('index');
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::post('users-store-agen', [UserController::class, 'storeAgen'])->name('users.store.agen');
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
        Route::post('topup-customer', [TransactionController::class, 'topupCustomer'])->name('topup.customer');
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
        Route::get('contact-us', [ContactUsController::class, 'index'])->name('contactus.index');
    });
});
