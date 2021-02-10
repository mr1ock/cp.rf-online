<?php

  namespace App\Http\Controllers;
use App\Http\Controllers\Auth\SessionsController;
use App\Http\Controllers\Donate\DonateController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect('home');
});

Auth::routes();

Route::get('/home', [IndexController::class, 'index'])->name('home');
Route::get('/logout', [SessionsController::class, 'destroy']);

Route::get('/donate', [IndexController::class, 'donate']);
Route::get('/premium', [IndexController::class, 'premium'])->name('premium');
Route::get('/statistic', [IndexController::class, 'statistic'])->name('statistic');
Route::get('/editpass', [IndexController::class, 'edit'])->name('editpass');
Route::get('/repairPerson', [IndexController::class, 'repair'])->name('repairPerson');
Route::get('/vote', [IndexController::class, 'vote'])->name('vote');

Route::get('/rating/{type}', [RatingController::class, 'rating'])->name('rating');

//POST
Route::post('/buyPremium', [PremiumController::class, 'buyPremiumAccount'])->name('buyPremium');

Route::post('/PasswordUser', [OptionsPersonController::class, 'changePasswordUser'])->name('changePasswordUser');
Route::post('/fix', [OptionsPersonController::class, 'fixPerson'])->name('fix');

//MMOTOP обработчик голосов
Route::post('/vote', [VoteController::class, 'vote'])->name('vote')->middleware('auth');
//Если надо в ручную спарсить голоса
Route::get('/parsVote', [IndexController::class, 'pars']);


// Принимает post с Яндекса
Route::post('/createdon', [DonateController::class, 'AcceptYandex']);


//Adminka
Route::get('/Bf@3z552v784^cX1', [AdminController::class, 'index'])->name('admin')->middleware(['admin', 'auth']);

Route::get('/Bf@3z552v784^cX2', [AdminController::class, 'createGm'])->name('createGm')->middleware(['admin', 'auth']);
Route::get('/Bf@3z552v784^cX3', [AdminController::class, 'pers'])->name('pers')->middleware(['admin', 'auth']);
Route::get('/Bf@3z552v784^cX4', [AdminController::class, 'giveItem'])->name('giveItem')->middleware(['admin', 'auth']);
Route::get('/Bf@3z552v784^cX5', [AdminController::class, 'Accounts'])->name('Accounts')->middleware(['admin', 'auth']);


Route::post('/changePassUser', [AdminPostController::class, 'changePassUser']);
Route::post('/changePassSklad', [AdminPostController::class, 'changePassSklad']);


Route::post('/changeFGpass', [AdminPostController::class, 'changeFGpass']);
Route::post('/changeCashMoney', [AdminPostController::class, 'changeCashMoney']);

Route::post('/createGm', [AdminPostController::class, 'createGm']);

Route::post('/viewPerson', [AdminPostController::class, 'viewPerson']);
Route::post('/changePerson', [AdminPostController::class, 'changePerson']);

Route::post('/getAccountInfo', [AdminPostController::class, 'getAccountInfo']);

Route::post('/giveItems', [AdminPostController::class, 'giveItems']);



//Предметы в сумке персонажа
Route::post('/item', [PostItemController::class, 'getItem']);
Route::get('/item', [AdminController::class, 'getItem'])->middleware(['admin', 'auth']); //для пагинации
Route::get('/editItemInCase', [AdminController::class, 'getItem'])->middleware(['admin', 'auth']); //для пагинации

//изменение предмета в сумке
Route::post('/editItemInCase', [PostItemController::class, 'editItemInCase']);