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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'Api', 'prefix' => 'v1'], function () {

    Route::get('menu-sections','MenuSectionController@index');
    Route::post('menu-sections','MenuSectionController@bulkUpdate');
    
    Route::get('menu-section/{menuSection}','MenuSectionController@show');
    Route::post('menu-section/{menuSection}/update','MenuSectionController@update');

    Route::get('menu-items','MenuItemController@index');
    Route::post('menu-items','MenuItemController@bulkUpdate');

    Route::get('menu-item/{menuItem}','MenuItemController@show');
    Route::post('menu-item/{menuItem}/update','MenuItemController@update');
    Route::post('menu-item','MenuItemController@create');
    
    Route::get('menu/{menu}','MenuController@show');
    Route::delete('menu-item/{menuItem}','MenuItemController@delete');

});