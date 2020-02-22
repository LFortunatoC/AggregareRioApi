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


//Routes for Evaluation
Route::/*middleware('auth:api')->*/post('evaluation', 'EvaluationController@store');
Route::/*middleware('auth:api')->*/patch('evaluation/{id}', 'EvaluationController@update');
Route::/*middleware('auth:api')->*/delete('evaluation/{id}', 'EvaluationController@destroy');
Route::get('evaluation', 'EvaluationController@index');
Route::get('evaluation/{id}', 'EvaluationController@show');

//Routes for Order
Route::/*middleware('auth:api')->*/post('order', 'OrderController@store');
Route::/*middleware('auth:api')->*/patch('order/{id}', 'OrderController@update');
Route::/*middleware('auth:api')->*/delete('order/{id}', 'OrderController@destroy');
Route::get('order', 'OrderController@index');
Route::get('order/{id}', 'OrderController@show');

//Routes for Item
Route::/*middleware('auth:api')->*/post('item', 'ItemController@store');
Route::/*middleware('auth:api')->*/patch('item/{id}', 'ItemController@update');
Route::/*middleware('auth:api')->*/delete('item/{id}', 'ItemController@destroy');
Route::get('item', 'ItemController@index');
Route::get('item/{id}', 'ItemController@show');

//Routes for Item Title Desc
//Routes for Promotion
Route::/*middleware('auth:api')->*/post('promotion', 'PromotionController@store');
Route::/*middleware('auth:api')->*/patch('promotion/{id}', 'PromotionController@update');
Route::/*middleware('auth:api')->*/delete('promotion/{id}', 'PromotionController@destroy');
Route::get('promotion', 'PromotionController@index');
Route::get('promotion/{id}', 'PromotionController@show');

//Routes for ItemTitleDesc
Route::/*middleware('auth:api')->*/post('itemtitledesc', 'ItemTitleDescriptionController@store');
Route::/*middleware('auth:api')->*/patch('itemtitledesc/{id}', 'ItemTitleDescriptionController@update');
Route::/*middleware('auth:api')->*/delete('itemtitledesc/{id}', 'ItemTitleDescriptionController@destroy');
Route::get('itemtitledesc', 'ItemTitleDescriptionController@index');
Route::get('itemtitledesc/{id}', 'ItemTitleDescriptionController@show');

//Routes for Menu Title Desc
Route::/*middleware('auth:api')->*/post('menutitledesc', 'MenuTitleDescController@store');
Route::/*middleware('auth:api')->*/patch('menutitledesc/{id}', 'MenuTitleDescController@update');
Route::/*middleware('auth:api')->*/delete('menutitledesc/{id}', 'MenuTitleDescController@destroy');
Route::get('menutitledesc', 'MenuTitleDescController@index');
Route::get('menutitledesc/{id}', 'MenuTitleDescController@show');

//Routes for Question Pool
Route::/*middleware('auth:api')->*/post('questionpool', 'QuestionPoolController@store');
Route::/*middleware('auth:api')->*/patch('questionpool/{id}', 'QuestionPoolController@update');
Route::/*middleware('auth:api')->*/delete('questionpool/{id}', 'QuestionPoolController@destroy');
Route::get('questionpool', 'QuestionPoolController@index');
Route::get('questionpool/{id}', 'QuestionPoolController@show');
