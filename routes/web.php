<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('app_form'); });
Route::post('app_store', 'App\Http\Controllers\IrisController@app_store')->name('app_store');
Route::get('settle', 'App\Http\Controllers\IrisController@settle')->name('settle');
Route::post('confirm_post', 'App\Http\Controllers\IrisController@confirm_post')->name('confirm_post');
Route::get('confirm', 'App\Http\Controllers\IrisController@confirm')->name('confirm');
Route::post('txid_store', 'App\Http\Controllers\IrisController@txid_store')->name('txid_store');
Route::get('complete', 'App\Http\Controllers\IrisController@complete')->name('complete');
Route::get('complete_pay', 'App\Http\Controllers\IrisController@complete_pay')->name('complete_pay');
Route::get('dashboard', 'App\Http\Controllers\IrisController@dashboard')->name('dashboard')->middleware('login_user');

Route::get('faq', 'App\Http\Controllers\IrisController@faq')->name('faq');

Route::get('admin/app_list', 'App\Http\Controllers\IrisController@app_list')->name('admin.app_list')->middleware('login_admin');
Route::get('admin/deleted_list', 'App\Http\Controllers\IrisController@deleted_list')->name('admin.deleted_list')->middleware('login_admin');
Route::get('admin/checked_list', 'App\Http\Controllers\IrisController@checked_list')->name('admin.checked_list')->middleware('login_admin');
Route::get('admin/csv_export', 'App\Http\Controllers\IrisController@csv_export')->name('admin.csv_export')->middleware('login_admin');
Route::get('admin/app_list_update', 'App\Http\Controllers\IrisController@app_list_update')->name('admin.app_list_update')->middleware('login_admin');
Route::get('admin/app_active/{id}/{flg}/', 'App\Http\Controllers\IrisController@app_active')->name('admin.app_active')->middleware('login_admin');
Route::get('admin/search', 'App\Http\Controllers\IrisController@search')->name('admin.search')->middleware('login_admin');

Route::get('admin/faq_list', 'App\Http\Controllers\IrisController@faq_list')->name('admin.faq_list')->middleware('login_admin');
Route::get('admin/faq_regist', 'App\Http\Controllers\IrisController@faq_regist')->name('admin.faq_regist')->middleware('login_admin');
Route::get('admin/faq_store', 'App\Http\Controllers\IrisController@faq_store')->name('admin.faq_store')->middleware('login_admin');


// ユーザーログイン
Route::get('login', function () { return view('login_user'); });
Route::get('reminder', function () { return view('reminder'); });
Route::get('reminder_comp', function () { return view('reminder_comp'); });

Route::POST('/user_login', 'App\Http\Controllers\IrisController@login_user')->name('login');
Route::POST('/forget_mail', 'App\Http\Controllers\IrisController@forget_mail')->name('forget_mail');
Route::get('/user_logout', 'App\Http\Controllers\IrisController@logout_user')->name('logout')->middleware('login_user');

// 管理側ログイン
Route::get('admin/login', function () { return view('login_admin'); });

Route::POST('/admin_login', 'App\Http\Controllers\IrisController@login_admin')->name('admin.login');
Route::get('/admin_logout', 'App\Http\Controllers\IrisController@logout_admin')->name('admin.logout')->middleware('login_admin');