<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['prefix' => 'admin'], function() {

    Route::get('login', 'Admin\AdminController@getLogin');

    Route::group(['middleware' => 'auth'], function() {
        Route::get('product/add', 'ProductsController@getAdd');
        Route::get('product/addproperties', 'ProductsController@getAddproperties');
        Route::get('product/{id}', 'ProductsController@getIndex');
        Route::get('recipe/add', 'RecipesController@getAdd');
        Route::get('recipe/{id}', 'RecipesController@getIndex');
        Route::controllers([
            'category' => 'CategoriesController',
            'property' => 'PropertiesController',
            'product' => 'ProductsController',
            'recipe' => 'RecipesController',
            'user' => 'UsersController',
            'image' => 'ImagesController',
            'news' => 'NewsController',
            'offer' => 'OffersController',
            '/' => 'Admin\AdminController'
        ]);
    });
});

Route::group(['middleware' => 'category'], function() {
    Route::group(['middleware' => 'client_auth'], function() {
        Route::group(['prefix' => 'recipes'], function() {
            Route::get('/', 'HomeController@getRecipes');
            Route::get('{subcategories}', 'HomeController@getRecipes');
        });

        Route::group(['prefix' => 'offers'], function() {
            Route::get('/', 'HomeController@getOffers');
            //Route::get('{subcategories}', 'HomeController@getOffers');
        });
    });

    Route::controllers([
        'auth' => 'Auth\AuthController',
        'password' => 'Auth\PasswordController',
        '/' => 'HomeController'
    ]);
});
