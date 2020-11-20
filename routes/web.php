<?php

// namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\IndexController::class, 'index'])->name('home');
Route::get('/logout', [App\Http\Controllers\Auth\SessionsController::class, 'destroy']);

Route::get('/donate', [App\Http\Controllers\IndexController::class, 'donate']);
Route::get('/premium', [App\Http\Controllers\IndexController::class, 'premium'])->name('premium');
Route::get('/statistic', [App\Http\Controllers\IndexController::class, 'statistic'])->name('statistic');
Route::get('/editpass', [App\Http\Controllers\IndexController::class, 'edit'])->name('editpass');
Route::get('/repairPerson', [App\Http\Controllers\IndexController::class, 'repair'])->name('repairPerson');
Route::get('/vote', [App\Http\Controllers\IndexController::class, 'vote'])->name('vote');

Route::get('/rating', [App\Http\Controllers\RatingController::class, 'rating'])->name('rating');
Route::get('/ratingBel', [App\Http\Controllers\RatingController::class, 'ratingBel'])->name('ratingBel');
Route::get('/ratingKora', [App\Http\Controllers\RatingController::class, 'ratingKora'])->name('ratingKora');
Route::get('/ratingAkr', [App\Http\Controllers\RatingController::class, 'ratingAkr'])->name('ratingAkr');
Route::get('/ratingDalant', [App\Http\Controllers\RatingController::class, 'ratingDalant'])->name('ratingDalant');


//POST
Route::post('/buyPremium', [App\Http\Controllers\PremiumController::class, 'buyPremiumAccount'])->name('buyPremium');

Route::post('/PasswordUser', [App\Http\Controllers\OptionsPersonController::class, 'changePasswordUser'])->name('changePasswordUser');
Route::post('/fix', [App\Http\Controllers\OptionsPersonController::class, 'fixPerson'])->name('fix');

//MMOTOP обработчик голосов
Route::post('/vote', [App\Http\Controllers\VoteController::class, 'vote'])->name('vote')->middleware('auth');

// Принимает post с Яндекса
Route::post('/createdon', [App\Http\Controllers\DonateController::class, 'AcceptYandex']);


