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
Auth::routes();

Route::get('/auth/{provider}', 'Auth\SocialLoginController@authenticate');

Route::post('/auth/{provider}/callback', 'Auth\SocialLoginController@login');
Route::post('/contact', 'ContactController');

Route::get('/{catchall?}', 'HomeController')->where('catchall', '^(?!api).*$')->name('home');
