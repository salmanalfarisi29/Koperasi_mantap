<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransaksiController;

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
  return view('welcome');
});

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
  Route::get('/home', function () {
    return view('home');
  })->name('home');

  Route::resource('users', \App\Http\Controllers\UserController::class)
    ->middleware(['role:admin']);
  Route::resource('products', \App\Http\Controllers\ProductController::class)
    ->middleware(['role:admin,petugas']);
  Route::get('reportStock', [ReportController::class, 'downloadPDF'])->middleware(['role:admin']);
});

Route::get('kirim-email', 'App\Http\Controllers\MailController@enqueue');
Route::get('transaksi', '\App\Http\Controllers\TransaksiController@index')->name('transaksi.index');
Route::get('transaksi/create', 'TransaksiController@create')->name('transaksi.create');
Route::get('transaksi/{transaksi}', '\App\Http\Controllers\TransaksiController@show')->name('transaksi.show');
Route::post('transaksi', '\App\Http\Controllers\TransaksiController@store')->name('transaksi.store');
Route::get('transaksi/{transaksi}/edit', '\App\Http\Controllers\TransaksiController@edit')->name('transaksi.edit');
Route::patch('transaksi/{transaksi}', '\App\Http\Controllers\TransaksiController@update')->name('transaksi.update');
Route::delete('transaksi/{transaksi}', '\App\Http\Controllers\TransaksiController@destroy')->name('transaksi.destroy');
