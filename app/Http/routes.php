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
        Route::controllers([
            'category' => 'CategoriesController',
            'property' => 'PropertiesController',
            '/' => 'Admin\AdminController'
        ]);
    });

});

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
    '/' => 'HomeController'
]);