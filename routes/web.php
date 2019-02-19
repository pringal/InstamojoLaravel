<?php

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

Route::get('payment', 'PaymentController@index')->name('payment');
Route::post('payment', 'PaymentController@payment')->name('payment');
Route::get('returnurl', 'PaymentController@returnurl')->name('returnurl');
