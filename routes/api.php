<?php

use Illuminate\Http\Request;



Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');
Route::group(['middleware' => 'auth:api'], function(){
    Route::get('users', 'API\UserController@getAllUser');
});

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('categories', 'API\CategoryController@index');
    Route::post('category','API\CategoryController@createCategory');
    Route::get('category/{cate_id}/subcategories','API\SubCategoryController@index');
    Route::post('category/{cate_id}/sub-category','API\SubCategoryController@createSubcatgory');
});