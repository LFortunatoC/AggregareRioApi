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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Routes for Category
Route::/*middleware('auth:api')->*/post('category', 'CategoryController@store');
Route::/*middleware('auth:api')->*/patch('category/{id}', 'CategoryController@update');
Route::/*middleware('auth:api')->*/delete('category/{id}', 'CategoryController@destroy');
Route::get('category', 'CategoryController@index');
Route::get('category/{id}', 'CategoryController@show');

//Routes for SubCategory
Route::/*middleware('auth:api')->*/post('subcategory', 'SubCategoryController@store');
Route::/*middleware('auth:api')->*/patch('subcategory/{id}', 'SubCategoryController@update');
Route::/*middleware('auth:api')->*/delete('subcategory/{id}', 'SubCategoryController@destroy');
Route::get('subcategory', 'SubCategoryController@index');
Route::get('subcategory/{id}', 'SubCategoryController@show');

//Routes for Language
Route::/*middleware('auth:api')->*/post('language', 'LanguageController@store');
Route::/*middleware('auth:api')->*/patch('language/{id}', 'LanguageController@update');
Route::/*middleware('auth:api')->*/delete('language/{id}', 'LanguageController@destroy');
Route::get('language', 'LanguageController@index');
Route::get('language/{id}', 'LanguageController@show');


//Routes for Menu
Route::/*middleware('auth:api')->*/post('menu', 'MenuController@store');
Route::/*middleware('auth:api')->*/patch('menu/{id}', 'MenuController@update');
Route::/*middleware('auth:api')->*/delete('menu/{id}', 'MenuController@destroy');
Route::get('menu', 'MenuController@index');
Route::get('menu/{id}', 'MenuController@show');

//Routes for Item
Route::/*middleware('auth:api')->*/post('item', 'ItemController@store');
Route::/*middleware('auth:api')->*/patch('item/{id}', 'ItemController@update');
Route::/*middleware('auth:api')->*/delete('item/{id}', 'ItemController@destroy');
Route::get('item', 'ItemController@index');
Route::get('item/{id}', 'ItemController@show');