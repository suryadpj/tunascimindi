<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SliderDepanController;
use App\Http\Controllers\EcatalogController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\AksesorisController;
use App\Http\Controllers\MediaEdukasiController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SscController;
use App\Http\Controllers\SosialMediaController;
use App\Http\Controllers\UserDataController;
use App\Http\Controllers\KritikSaranController;
use App\Http\Controllers\PkbController;
use App\Http\Controllers\Cr7Controller;
use App\Http\Controllers\ReservasiDataController;
use App\Http\Controllers\TradeInController;

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
Route::delete('/deleteecatalog/{id}', [EcatalogController::class, 'destroy'])->name('ecatalogslider.destroy');
Route::post('/slider/ecatalog/update', [EcatalogController::class, 'updateslider'])->name('ecatalogslider.updated');
Route::resource('/slider/promo', PromoController::class);
Route::post('/slider/promo/update', [PromoController::class, 'updateslider'])->name('promoslider.updated');
Route::get('/datapromo', [PromoController::class, 'promo'])->name('datapromo');
Route::get('/datapromo/{id}', [PromoController::class, 'show'])->name('datapromo.show');
Route::delete('/datapromo/{id}', [PromoController::class, 'destroy'])->name('datapromo.destroy');
Route::post('/datapromo', [PromoController::class, 'storepromo'])->name('datapromo.store');
Route::post('/datapromo/update', [PromoController::class, 'edit'])->name('datapromo.updated');
Route::resource('/slider/aksesoris', AksesorisController::class);
Route::get('/dataaksesoris', [AksesorisController::class, 'dataaksesoris'])->name('dataaksesoris');
Route::post('/dataaksesoris', [AksesorisController::class, 'storeaksesoris'])->name('dataaksesoris.store');
Route::get('/dataaksesoris/{id}', [AksesorisController::class, 'showaksesoris'])->name('dataaksesoris.show');
Route::post('/dataaksesoris/update', [AksesorisController::class, 'editaksesoris'])->name('dataaksesoris.updated');
Route::delete('/dataaksesoris/{id}', [AksesorisController::class, 'destroy'])->name('dataaksesoris.destroy');
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
Route::post('/customer/updatedata', [CustomerController::class, 'updatedata'])->name('customer.updatedata');
Route::resource('/ssc', SscController::class);
Route::get('/ssc/data', [SscController::class, 'data'])->name('ssc.data');
Route::post('/ssc/tosales', [SscController::class, 'updatesales'])->name('ssc.updatesals');
Route::post('/ssc/updatedata', [SscController::class, 'updatedata'])->name('ssc.updatedata');
Route::resource('/sosialmedia', SosialMediaController::class);
Route::get('/sosialmedia/data', [SosialMediaController::class, 'data'])->name('sosialmedia.data');
Route::post('/sosialmedia/updatedata', [SosialMediaController::class, 'updatedata'])->name('sosialmedia.updatedata');
Route::resource('/userdata', UserDataController::class);
Route::get('/userdata/data', [UserDataController::class, 'data'])->name('userdata.data');
Route::post('/userdata/tosales', [UserDataController::class, 'updatesales'])->name('userdata.updatesals');
Route::post('/userdata/updatedata', [UserDataController::class, 'updatedata'])->name('userdata.updatedata');
Route::resource('/pkb', PkbController::class);
Route::get('/pkb/data', [PkbController::class, 'data'])->name('pkb.data');
Route::resource('/cr7', Cr7Controller::class);
Route::get('/cr7/data', [Cr7Controller::class, 'data'])->name('cr7.data');
Route::resource('/kritik_saran', KritikSaranController::class);
Route::resource('/reservasidata', ReservasiDataController::class);
Route::get('/sales', [ReservasiDataController::class, 'datasales'])->name('reservasidata.sales');
Route::get('/service', [ReservasiDataController::class, 'databengkel'])->name('reservasidata.bengkel');
Route::get('/reservasi', [ReservasiDataController::class, 'dataaksesoris'])->name('reservasidata.aksesoris');

Route::resource('/tradein', TradeInController::class);




