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

Route::get('/', function () { return view('app_form'); });
Route::post('app_store', 'App\Http\Controllers\IrisController@app_store')->name('app_store');
Route::get('settle', 'App\Http\Controllers\IrisController@settle')->name('settle');
Route::post('confirm', 'App\Http\Controllers\IrisController@confirm')->name('confirm');
Route::post('txid_store', 'App\Http\Controllers\IrisController@txid_store')->name('txid_store');
Route::get('complete', 'App\Http\Controllers\IrisController@complete')->name('complete');
