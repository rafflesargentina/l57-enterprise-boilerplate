<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your module. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('browser-usage', 'BrowserUsageController');
Route::get('device-usage', 'DeviceUsageController');
Route::get('device-type-usage', 'DeviceTypeUsageController');
Route::get('geo-usage', 'GeoUsageController');
Route::get('platform-usage', 'PlatformUsageController');
Route::get('user-traffic-count', 'UserTrafficCountController');
Route::get('users-active', 'UserActiveController');
Route::get('users-count', 'UserCountController');
Route::get('users-created', 'UserCreatedController');

Route::apiResource('user-traffic', 'UserTrafficController');
Route::apiResource('user-traffic-count', 'UserTrafficCountController');
