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
Route::get('/', 'App\Http\Controllers\CardController@index');
Route::get('/add-card', 'App\Http\Controllers\CardController@create');
Route::post('/store-card', 'App\Http\Controllers\CardController@store');
Route::post('/update-card', 'App\Http\Controllers\CardController@update');
Route::get('/all-card-json', 'App\Http\Controllers\CardController@indexJson');
Route::get('/card/edit/{slug}', 'App\Http\Controllers\CardController@edit');
Route::get('/card/{slug}', 'App\Http\Controllers\CardController@view');
Route::post('/card/delete', 'App\Http\Controllers\CardController@destroy');