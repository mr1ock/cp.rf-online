<?php

//  namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;

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

Route::get('/rating/{type}', [App\Http\Controllers\RatingController::class, 'rating'])->name('rating');

//POST
Route::post('/buyPremium', [App\Http\Controllers\PremiumController::class, 'buyPremiumAccount'])->name('buyPremium');

Route::post('/PasswordUser', [App\Http\Controllers\OptionsPersonController::class, 'changePasswordUser'])->name('changePasswordUser');
Route::post('/fix', [App\Http\Controllers\OptionsPersonController::class, 'fixPerson'])->name('fix');

//MMOTOP обработчик голосов
Route::post('/vote', [App\Http\Controllers\VoteController::class, 'vote'])->name('vote')->middleware('auth');
//Если надо в ручную спарсить голоса
Route::get('/parsVote', [App\Http\Controllers\IndexController::class, 'pars']);


// Принимает post с Яндекса
Route::post('/createdon', [App\Http\Controllers\DonateController::class, 'AcceptYandex']);


//Adminka
Route::get('/Bf@3z552v784^cX1', [App\Http\Controllers\AdminController::class, 'index'])->name('admin')->middleware(['admin', 'auth']);

Route::get('/Bf@3z552v784^cX2', [App\Http\Controllers\AdminController::class, 'createGm'])->name('createGm')->middleware(['admin', 'auth']);
Route::get('/Bf@3z552v784^cX3', [App\Http\Controllers\AdminController::class, 'pers'])->name('pers')->middleware(['admin', 'auth']);
Route::get('/Bf@3z552v784^cX4', [App\Http\Controllers\AdminController::class, 'giveItem'])->name('giveItem')->middleware(['admin', 'auth']);
Route::get('/Bf@3z552v784^cX5', [App\Http\Controllers\AdminController::class, 'Accounts'])->name('Accounts')->middleware(['admin', 'auth']);