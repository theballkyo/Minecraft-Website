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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::resource('/board', 'BoardController');
Route::group(['prefix' => 'board'], function () {

    # Route::get('create', 'BoardController@create');

    Route::get('delete/{id}', 'BoardController@deleteConfirm');
    Route::get('reply/{id}', 'BoardController@reply');
    Route::post('reply', 'BoardController@storeReply');
    Route::get('reply', 'BoardController@replyRedirect');
    Route::get('pin/{id}', 'BoardController@pin');
    Route::get('lock/{id}', 'BoardController@lock');
});