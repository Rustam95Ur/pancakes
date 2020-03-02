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

Route::get('', 'HomeController@index')->name('home');
Route::get('/menu', 'HomeController@menu')->name('menu');
Route::get('/delivery', 'HomeController@delivery')->name('delivery');
Route::get('/action', 'HomeController@action')->name('action');
Route::get('/contact', 'HomeController@contact')->name('contact');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
