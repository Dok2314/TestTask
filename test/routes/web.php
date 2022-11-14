<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers AS C;

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
    return view('home');
})->name('homePage');

Route::group([], function () {
    Route::put('/restore/{id}', [C\CategoryController::class, 'restore'])
        ->name('categories.restore');

    Route::put('/restore/{id}', [C\LotController::class, 'restore'])
        ->name('lots.restore');

    Route::resources([
        'categories' => C\CategoryController::class,
        'lots'       => C\LotController::class,
    ]);
});
