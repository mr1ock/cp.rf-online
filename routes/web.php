<?php

// namespace App\Http\Controllers;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\IndexController::class, 'index'])->name('home')->middleware('auth');
Route::get('/logout', [App\Http\Controllers\Auth\SessionsController::class, 'destroy']);

Route::get('/donate', [App\Http\Controllers\IndexController::class, 'donate'])->middleware('auth');
Route::get('/premium', [App\Http\Controllers\IndexController::class, 'premium'])->name('premium')->middleware('auth');
Route::get('/statistic', [App\Http\Controllers\IndexController::class, 'statistic'])->name('statistic')->middleware('auth');
Route::get('/editpass', [App\Http\Controllers\IndexController::class, 'edit'])->name('editpass')->middleware('auth');
Route::get('/repairPerson', [App\Http\Controllers\IndexController::class, 'repair'])->name('repairPerson')->middleware('auth');
Route::get('/vote', [App\Http\Controllers\IndexController::class, 'vote'])->name('vote')->middleware('auth');

Route::get('/rating', [App\Http\Controllers\IndexController::class, 'rating'])->name('rating')->middleware('auth');
Route::get('/ratingBel', [App\Http\Controllers\IndexController::class, 'ratingBel'])->name('ratingBel')->middleware('auth');
Route::get('/ratingKora', [App\Http\Controllers\IndexController::class, 'ratingKora'])->name('ratingKora')->middleware('auth');
Route::get('/ratingAkr', [App\Http\Controllers\IndexController::class, 'ratingAkr'])->name('ratingAkr')->middleware('auth');
Route::get('/ratingDalant', [App\Http\Controllers\IndexController::class, 'ratingDalant'])->name('ratingDalant')->middleware('auth');


//POST
Route::post('/buyPremium', [App\Http\Controllers\PremiumController::class, 'buyPremiumAccount'])->name('buyPremium')->middleware('auth');

Route::post('/PasswordUser', [App\Http\Controllers\OptionsPersonController::class, 'changePasswordUser'])->name('changePasswordUser')->middleware('auth');
Route::post('/fix', [App\Http\Controllers\OptionsPersonController::class, 'fixPerson'])->name('fix')->middleware('auth');

//MMOTOP обработчик голосов
Route::post('/vote', [App\Http\Controllers\IndexController::class, 'vote'])->name('vote')->middleware('auth');

// Принимает post с Яндекса
Route::post('/createdon', [App\Http\Controllers\DonateController::class, 'AcceptYandex']);


