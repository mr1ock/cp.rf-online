<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return redirect('home');
});

Route::get('/test', function () {
    return 123;
})->middleware('auth');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\IndexController::class, 'index'])->name('home')->middleware('auth');
Route::get('/home', [App\Http\Controllers\IndexController::class, 'index'])->name('home');


