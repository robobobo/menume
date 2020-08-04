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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/menus','MenuController@index')->name('menus');
Route::get('/menu/{menu}','MenuController@show')->name('menu.show');
Route::get('/menu/{menu}/edit','MenuController@edit')->name('menu.edit');

Route::get('/getting-started','EstablishmentController@create')->name('establishment.create');
Route::get('/establishments','EstablishmentController@index')->name('establishments');
Route::get('/establishment/{establishment}','EstablishmentController@show')->name('establishment.show');