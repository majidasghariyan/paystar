<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/test', function(){
    return Hash::make('123456');
});

Route::get('/', [App\Http\Controllers\Auth\LoginController::class,'showLoginForm'])->name('loginform');
Route::post('/', [App\Http\Controllers\Auth\LoginController::class,'login'])->name('login');
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class,'logout'])->name('logout');


Route::group(['prefix'=>'/panel','middleware' => 'auth'], function() {

    Route::get('',[App\Http\Controllers\HomeController::class, 'dashboard'])->name('admin.dashboard');

    // RoleController
    Route::prefix('/roles/')->group(function (){
        Route::get('',[App\Http\Controllers\RoleController::class, 'index'])->name('admin.role.index');
        Route::get('create',[App\Http\Controllers\RoleController::class, 'create'])->name('admin.role.create');
        Route::post('store',[App\Http\Controllers\RoleController::class, 'store'])->name('admin.role.store');
        Route::get('{role}/edit',[App\Http\Controllers\RoleController::class, 'edit'])->name('admin.role.edit');
        Route::post('{role}',[App\Http\Controllers\RoleController::class, 'update'])->name('admin.role.update');
        Route::get('{role}/delete',[App\Http\Controllers\RoleController::class, 'delete'])->name('admin.role.delete');
    });

    // BankController
    Route::prefix('/banks/')->group(function (){
        Route::get('',[App\Http\Controllers\BankController::class, 'index'])->name('admin.bank.index');
        Route::get('create',[App\Http\Controllers\BankController::class, 'create'])->name('admin.bank.create');
        Route::post('store',[App\Http\Controllers\BankController::class, 'store'])->name('admin.bank.store');
        Route::get('{bank}/edit',[App\Http\Controllers\BankController::class, 'edit'])->name('admin.bank.edit');
        Route::post('{bank}',[App\Http\Controllers\BankController::class, 'update'])->name('admin.bank.update');
        Route::delete('{bank}/delete',[App\Http\Controllers\BankController::class, 'delete'])->name('admin.bank.delete');
    });

    // CartController
    Route::prefix('/carts/')->group(function (){
        Route::get('',[App\Http\Controllers\CartController::class, 'index'])->name('admin.cart.index');
        Route::get('create',[App\Http\Controllers\CartController::class, 'create'])->name('admin.cart.create');
        Route::post('store',[App\Http\Controllers\CartController::class, 'store'])->name('admin.cart.store');
        Route::get('{cart}/edit',[App\Http\Controllers\CartController::class, 'edit'])->name('admin.cart.edit');
        Route::post('{cart}',[App\Http\Controllers\CartController::class, 'update'])->name('admin.cart.update');
        Route::delete('{cart}/delete',[App\Http\Controllers\CartController::class, 'delete'])->name('admin.cart.delete');
    });

    // CheckoutController
    Route::prefix('/checkout/')->group(function (){
        Route::get('',[App\Http\Controllers\CheckController::class, 'index'])->name('admin.checkout.index');
        Route::post('send',[App\Http\Controllers\CheckController::class, 'store'])->name('admin.checkout.store');
        // Route::get('callback/vertify',[App\Http\Controllers\CheckController::class, 'callback'])->name('admin.checkout.callback')->withoutMiddleware('auth');
        Route::get('history',[App\Http\Controllers\CheckController::class, 'history'])->name('admin.checkout.history');

    });

    // CheckoutController
    Route::prefix('/payment-lists/')->group(function (){
        Route::get('',[App\Http\Controllers\CheckController::class, 'history'])->name('admin.checkout.history');

    });


});

