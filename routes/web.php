<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('pages.index');
});
route::middleware(['auth','verified'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    route::get('dashboard', function () {
        return view('dashboard.pages.index');
    });
});

Auth::routes([
    'verify' => true
]);


Route::resource('users', UserController::class);
Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
Route::patch('profile-update', [ProfileController::class, 'update'])->name('profile.update');
route::patch('profile-change-password', [ProfileController::class, 'changePassword'])->name('profile.change.password');
Route::get('profile-forgot-password', [ProfileController::class, 'forgotPassword'])->name('profile.forgot.password');
