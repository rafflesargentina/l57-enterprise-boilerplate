<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->group(
    function () {
        Route::apiResource('avatars', 'AvatarController', ['only' => ['show', 'update']]);

        Route::get('account', 'AccountController');
        Route::put('account', 'UpdateAccountController');
    }
);

Route::apiResource('document-types', 'DocumentTypeController');
Route::apiResource('photos', 'PhotoController');
Route::apiResource('users', 'UserController');
