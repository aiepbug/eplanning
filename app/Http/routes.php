<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('publik/depan');
});
Route::get('/beranda', function () {
    return view('publik/beranda');
});

Route::get('/user',function() {return view('publik/beranda');});
Route::get('/user/profil','User@beranda');
Route::get('/user/logout','User@logout');
Route::post('/user/input_data','User@input_data');
Route::post('/user/tambahKegiatan','User@tambahKegiatan');
Route::post('/user/tambahRincian','User@tambahRincian');
Route::post('/user/simpan_kegiatan','User@simpan_kegiatan');
Route::post('/user/simpan_rincian','User@simpan_rincian');
Route::post('/user/editRincian','User@editRincian');
Route::post('/user/editKegiatan','User@editKegiatan');
Route::post('/user/hapus_rincian','User@hapus_rincian');
Route::post('/user/hapus_kegiatan','User@hapus_kegiatan');
Route::post('/user/menu_cetak','User@menu_cetak');
Route::get('/user/rincian_kegiatan/{_token}/{id}','User@rincian_kegiatan');
Route::get('/admin/logout','Admin@logout');
Route::get('/admin/beranda','Admin@beranda');
Route::post('/admin/list_kegiatan','Admin@list_kegiatan');
Route::post('/admin/cetak','Admin@cetak');
Route::post('/xlogin','Publik@ceklogin');
