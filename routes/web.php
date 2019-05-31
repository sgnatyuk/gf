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

/*
 * Заглушка на все валидные маршруты
 */
Route::get('/{any?}', [
    'as' => 'home', 'uses' => 'AppController@index',
])->where('any', '[\/\w\.-]*');