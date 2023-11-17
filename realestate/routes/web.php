<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Seller\PropertyController;
use App\Http\Controllers\User\MessageController;
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

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'redirect'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/logout',  [HomeController::class, 'logout'])->name('logout');
Route::get('/property/{property}', [PropertyController::class, 'show'])->name('show.property');
Route::get('/all-properties', [PropertyController::class, 'allProperties'])->name('all.properties');
Route::post('/send-message', [MessageController::class, 'store'])->name('user.send-message');


Route::group(['middleware' => ['auth', 'isVendor']], function () {
    Route::get('/properties', [PropertyController::class, 'index'])->name('seller.properties');
    Route::get('/add-property', [PropertyController::class, 'create'])->name('seller.add-property');
    Route::post('/store-property', [PropertyController::class, 'store'])->name('seller.store-property');
    Route::put('/update-property/{property}', [PropertyController::class, 'update'])->name('seller.update.property');
    Route::delete('/delete-property/{property}', [PropertyController::class, 'destroy'])->name('seller.delete.property');

    Route::get('/messages', [MessageController::class, 'index'])->name('seller.messages');
    Route::delete('/delete-message/{message}', [MessageController::class, 'destroy'])->name('seller.delete.message');

});

Route::group(['middleware' => ['auth', 'isAdmin']], function () {
    Route::get('/users', [AdminController::class, 'index'])->name('admin.users-list');
    Route::post('/store-users', [AdminController::class, 'store'])->name('admin.store-users');
    Route::put('/update-user/{user}', [AdminController::class, 'update'])->name('admin.update.user');
    Route::delete('/delete-user/{user}', [AdminController::class, 'destroy'])->name('admin.delete.user');
    Route::post('/approve-user/{user}', [AdminController::class, 'approve'])->name('admin.approve.user');
    Route::get('/view-properties', [AdminController::class, 'view'])->name('admin.properties');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
