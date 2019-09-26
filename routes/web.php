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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/urls/create', 'UrlShortenerController@create')->name('urls.create');
Route::get('/r/{path}', 'UrlShortenerController@redirectShortUrl')->name('urls.redirectShortUrl');
Route::post('/urls', 'UrlShortenerController@store')->name('urls.store');
