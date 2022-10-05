<?php

use App\Http\Controllers\NumbersController;
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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('numbers')->group(function () {
    Route::post('store', [NumbersController::class, 'store'])->name('numbers.store');
    Route::post('change/status/{number}', [NumbersController::class, 'changeStatus'])->name('numbers.change.status');
    Route::post('preview/{number}', [NumbersController::class, 'preview'])->name('numbers.preview');
    Route::post('update/{number}', [NumbersController::class, 'update'])->name('numbers.update');
    Route::any('delete/{number}', [NumbersController::class, 'delete'])->name('numbers.delete');
});
