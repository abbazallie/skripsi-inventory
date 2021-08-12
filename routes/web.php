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

Route::get('/', function () {
    return view('index');
});

// Route::resource('barang', 'BarangController');
// Route::resource('kategori', 'KategoriController');
// Route::resource('kerusakan', 'BarangRusakController');
Route::resource('user', 'UserController');
// Route::resource('peminjaman', 'PeminjamanController');

Route::resource('item', 'ItemController');
Route::resource('category', 'CategoryController');
Route::resource('damage', 'DamageController');
Route::resource('borrower', 'BorrowerController');
Route::resource('report', 'ReportController');


Route::post('/tampil', 'ShowController@show')->name('tampil');
Route::post('simpan', 'ShowController@simpan')->name('simpan');
