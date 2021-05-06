<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::resource('/', OrderController::class);
Route::get('show/{invoice}', [OrderController::class, 'show'])->name('show');
Route::get('order/{id}', [OrderController::class, 'order'])->name('order');
Route::get('terimakasih', [OrderController::class, 'terimakasih'])->name('terimakasih');



Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
