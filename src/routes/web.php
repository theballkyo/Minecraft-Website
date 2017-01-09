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
Route::get('/board/create', 'BoardController@create');

Route::get('/board/delete/{id}', 'BoardController@deleteConfirm');
Route::get('/board/reply/{id}', 'BoardController@reply');
Route::post('/board/reply', 'BoardController@storeReply');
Route::get('/board/reply', 'BoardController@replyRedirect');
Route::get('/board/pin/{id}', 'BoardController@pin');
Route::get('/board/lock/{id}', 'BoardController@lock');