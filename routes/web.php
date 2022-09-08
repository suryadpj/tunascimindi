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

Auth::routes();
Route::get('/', function () {
    return view('auth.landing');
});
Route::get('pendaftaran', [App\Http\Controllers\NewRegisterController::class, 'index'])->name('pendaftaran');
Route::post('pendaftaran', [App\Http\Controllers\NewRegisterController::class, 'store'])->name('pendaftaran.store');
// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('referensi', [App\Http\Controllers\EcatalogController::class, 'referensistore'])->name('ecatalog.referensistore');
Route::resource('card', App\Http\Controllers\CardController::class);
Route::resource('history', App\Http\Controllers\HistoryController::class);
Route::resource('ecatalog', App\Http\Controllers\EcatalogController::class);
Route::resource('aksesoris', App\Http\Controllers\AksesoriController::class);
Route::resource('tradein', App\Http\Controllers\TradeinController::class);
Route::get('tradein/model/list', [App\Http\Controllers\TradeinController::class, 'model'])->name('tradein.model');
Route::resource('promo', App\Http\Controllers\PromoController::class);
Route::resource('media_edukasi', App\Http\Controllers\EdukasiController::class);
Route::resource('profile', App\Http\Controllers\ProfileController::class);
Route::resource('reservasi', App\Http\Controllers\ReservasiController::class);
Route::get('/profilefirst', [App\Http\Controllers\ProfileController::class, 'profilefirst'])->name('profilefirst');
Route::get('/hubungikami', [App\Http\Controllers\HubungiKamiController::class, 'index'])->name('hubungikami');


