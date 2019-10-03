<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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

/*
 * Auth Routes
 */
Route::prefix('user')->group(function () {

    Route::group(['middleware' => [ 'auth:api' ] ], function () {

        Route::post('details', 'API\User\AuthController@details');

    });

});

Route::prefix('auth')->group(function () {

    Route::post('login', 'API\User\AuthController@login');
    Route::post('register', 'API\User\AuthController@register');

    Route::group(['middleware' => [ 'auth:api' ] ], function () {

        Route::post('check', 'API\User\AuthController@check');

    });

});
