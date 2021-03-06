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

Route::get('/','admin\IndexController@index');
Route::get('/banner','admin\IndexController@showbanner');
Route::get('/addbanner','admin\IndexController@addbanner');
Route::post('/banneradd','admin\IndexController@banneradd');
Route::get('/updatebanner','admin\IndexController@updatebanner');
Route::post('/update','admin\IndexController@update');
Route::post('/delete','admin\IndexController@delete');
Route::post('/changeValue','admin\IndexController@changeValue');
Route::get('/upload','admin\IndexController@upload');
Route::any('/uploadadd','admin\IndexController@uploadadd');

//分类
Route::any('sortadd',"admin\IndexController@sortadd");
Route::any('classifyadd',"admin\IndexController@classifyadd");
Route::any('reveal',"admin\IndexController@reveal");
Route::any('deldo',"admin\IndexController@deldo");
Route::any('alter',"admin\IndexController@alter");
Route::any('updata',"admin\IndexController@updata");
