<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('app_form'); });
Route::post('app_store', 'App\Http\Controllers\IrisController@app_store')->name('app_store');
Route::get('settle', 'App\Http\Controllers\IrisController@settle')->name('settle');
Route::post('confirm_post', 'App\Http\Controllers\IrisController@confirm_post')->name('confirm_post');
Route::get('confirm', 'App\Http\Controllers\IrisController@confirm')->name('confirm');
Route::post('txid_store', 'App\Http\Controllers\IrisController@txid_store')->name('txid_store');
Route::get('complete', 'App\Http\Controllers\IrisController@complete')->name('complete');

Route::get('admin/app_list', 'App\Http\Controllers\IrisController@app_list')->name('admin.app_list')->middleware('login');

// ログイン
Route::get('admin/login', function () {
    return view('login');
});
Route::POST('/admin_login', 'App\Http\Controllers\IrisController@login')->name('admin.login');
Route::get('/admin_logout', 'App\Http\Controllers\IrisController@logout')->name('admin.logout')->middleware('login');