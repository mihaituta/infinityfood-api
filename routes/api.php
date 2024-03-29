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

/** Routes that doesn't require auth */
Route::group(['namespace' => 'Api'], function () {
    Route::post('staff/login', 'UserController@staffLogin');
    Route::post('/login', 'UserController@login');
    Route::post('/register', 'UserController@register');
    Route::post('/forgot-password', 'UserController@forgotPassword');
    Route::post('/change-password', 'UserController@changePassword');
    Route::post('/restaurant/order', 'OrderController@createOrder');
    Route::get('/stores-complete', 'StoreController@getStores');
    Route::get('/stores', 'StoreController@getStoresPreview');
    Route::get('/store-complete/{url}', 'StoreController@getStoreComplete');
});

/** Routes with auth */
Route::group(['namespace' => 'Api', 'middleware' => 'jwt'], function () {
    Route::group(['prefix' => 'user'], function () {
        Route::get('/', 'UserController@get');
        Route::patch('/', 'UserController@update');
        Route::get('/store', 'UserController@getStore');
    });

    /** Routes you can access as admin only  */
    Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {

        Route::group(['prefix' => 'store'], function () {
            Route::post('/', 'StoreController@create');
            Route::patch('/{id}', 'StoreController@update');
            Route::delete('/{id}', 'StoreController@delete');
        });
        Route::get('/users', 'AdminController@getUsers');
        Route::group(['prefix' => 'user'], function () {
            Route::post('/', 'AdminController@createUser');
            Route::patch('/{id}', 'AdminController@updateUser');
            Route::delete('/{id}', 'AdminController@deleteUser');
        });
    });

    /** Routes you can access as staff member only */
    Route::group(['prefix' => 'staff', 'middleware' => 'staff'], function () {
        Route::get('/menus', 'MenuController@getMenus');
        Route::get('/orders', 'OrderController@getOrders');
        Route::get('/store', 'StoreController@getStore');
        Route::patch('/store', 'StoreController@staffUpdateStore');
        Route::group(['prefix' => 'menu'], function () {
            Route::post('/add', 'MenuController@createMenu');
            Route::patch('/{id}', 'MenuController@updateMenu');
            Route::delete('/{id}', 'MenuController@deleteMenu');
        });
        Route::group(['prefix' => 'order'], function () {
            Route::patch('/{id}', 'OrderController@updateOrder');
            Route::delete('/{id}', 'OrderController@deleteOrder');
        });
    });
});