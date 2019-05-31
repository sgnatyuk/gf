<?php

use Illuminate\Http\Request;

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

Route::get('getTariffs', [
    'as'         => 'getTariffs',
    'uses'       => 'Api\ActionController@getTariffs',
]);

Route::get('getStatistics', [
    'as'         => 'getStatistics',
    'uses'       => 'Api\ActionController@getStatistics',
]);

Route::post('confirm', [
    'as'         => 'confirm',
    'uses'       => 'Api\ActionController@confirm',
]);