<?php

use Illuminate\Support\Facades\Route;

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

//ブログ一覧
Route::get('/','BlogController@showList')->name("blogs");

//ブログ登録画面
Route::get('/blog/create','BlogController@showCreate')->name("create");

//ブログ登録(post)
Route::post('/blog/store','BlogController@exeStore')->name("store");

//ブログ編集画面
Route::get('/blog/edit/{id}','BlogController@showEdit')->name("edit");

//ブログ詳細画面
Route::get('/blog/{id}','BlogController@showDetail')->name("show");

//ブログ削除
Route::get('/blog/delete/{id}','BlogController@showDelete')->name("delete");

//ブログ更新(post)
Route::post('/blog/update','BlogController@exeUpdate')->name("update");