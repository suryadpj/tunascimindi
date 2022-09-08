<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SliderDepanController;
use App\Http\Controllers\EcatalogController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\AksesorisController;
use App\Http\Controllers\MediaEdukasiController;
use App\Http\Controllers\CustomerController;

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
//     return view('home');
// });

Auth::routes();

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::resource('/slider/halamandepan', SliderDepanController::class);
Route::post('/slider/halamandepan/update', [SliderDepanController::class, 'update'])->name('halamandepan.updated');
Route::resource('/slider/ecatalog', EcatalogController::class);
Route::post('/slider/ecatalog/update', [EcatalogController::class, 'updateslider'])->name('ecatalogslider.updated');
Route::resource('/slider/promo', PromoController::class);
Route::post('/slider/promo/update', [PromoController::class, 'updateslider'])->name('promoslider.updated');
Route::get('/datapromo', [PromoController::class, 'promo'])->name('datapromo');
Route::post('/datapromo', [PromoController::class, 'storepromo'])->name('datapromo.store');
Route::post('/datapromo/update', [PromoController::class, 'updatepromo'])->name('datapromo.updated');
Route::resource('/slider/aksesoris', AksesorisController::class);
Route::post('/slider/aksesoris/update', [AksesorisController::class, 'updateslider'])->name('aksesorisslider.updated');
Route::post('/ecatalog/brosur/store', [EcatalogController::class, 'storebrosur'])->name('ecatalog.storebrosur');
Route::get('/ecatalog/brosur', [EcatalogController::class, 'brosur'])->name('ecatalog.brosur');
Route::get('/dataedukasi', [MediaEdukasiController::class, 'index'])->name('dataedukasi.index');
Route::post('/dataedukasi', [MediaEdukasiController::class, 'store'])->name('dataedukasi.store');
Route::post('/dataedukasi/update', [MediaEdukasiController::class, 'update'])->name('dataedukasi.update');
Route::get('/dataedukasi/{$id}', [MediaEdukasiController::class, 'edit'])->name('dataedukasi.edit');
Route::delete('/dataedukasi/{$id}', [MediaEdukasiController::class, 'edit'])->name('dataedukasi.edit');
Route::resource('/customer', CustomerController::class);
Route::get('/customer/data', [CustomerController::class, 'data'])->name('customer.data');
Route::post('/customer/tosales', [CustomerController::class, 'updatesales'])->name('customer.updatesals');



