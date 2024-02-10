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
Route::group(['prefix' => 'logged', 'middleware' => 'manage.logged'], function () {
    Route::get('', [\App\Http\Controllers\HomeController::class,'index'])->name('index');
    Route::group(['prefix' => 'customers'], function () {
        Route::group(['prefix' => 'monthly/{customer_id}'], function () {
            Route::get('', [\App\Http\Controllers\MonthlyController::class, 'index'])->name('customers.monthly.index');
            Route::post('store', [\App\Http\Controllers\MonthlyController::class, 'store'])->name('customers.monthly.store');
            Route::get('create', [\App\Http\Controllers\MonthlyController::class, 'create'])->name('customers.monthly.create');
            Route::get('edit/{id}', [\App\Http\Controllers\MonthlyController::class, 'edit'])->name('customers.monthly.edit');
            Route::get('delete/{id}', [\App\Http\Controllers\MonthlyController::class, 'delete'])->name('customers.monthly.delete');
            Route::post('update/{id}', [\App\Http\Controllers\MonthlyController::class, 'update'])->name('customers.monthly.update');
        });
        Route::get('', [\App\Http\Controllers\CustomersController::class, 'index'])->name('customers.index');
        Route::post('store', [\App\Http\Controllers\CustomersController::class, 'store'])->name('customers.store');
        Route::get('create', [\App\Http\Controllers\CustomersController::class, 'create'])->name('customers.create');
        Route::get('edit/{id}', [\App\Http\Controllers\CustomersController::class, 'edit'])->name('customers.edit');
        Route::get('delete/{id}', [\App\Http\Controllers\CustomersController::class, 'delete'])->name('customers.delete');
        Route::post('update/{id}', [\App\Http\Controllers\CustomersController::class, 'update'])->name('customers.update');
    });
});
Route::get('logout', [\App\Http\Controllers\Guest\AuthController::class, 'logout'])->name('logout');

Route::get('',function (){
    return redirect()->route('auth.login');
});
Route::group(['prefix' => 'guest', 'middleware' => 'manage.not.logged'], function () {
    Route::group(['prefix' => 'login'], function () {
        Route::get('', [\App\Http\Controllers\Guest\AuthController::class, 'login'])->name('auth.login');
        Route::post('', [\App\Http\Controllers\Guest\AuthController::class, 'loginPost'])->name('auth.post-login');
    });
});
