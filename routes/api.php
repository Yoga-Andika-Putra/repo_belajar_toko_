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

    Route::post('/register', 'UserController@register'); 
    Route::post('/login', 'UserController@login'); 

    Route::group(['middleware' => ['jwt.verify']], function ()
    {
        Route::get('/product', 'ProductController@show'); 
        Route::get('/product/{id_product}', 'ProductController@detail'); 
        Route::post('/product', 'ProductController@store'); 
        Route::put('/product/{id_product}', 'ProductController@update'); 
        Route::delete('/product/{id_product}', 'ProductController@destroy');

        Route::get('/orders', 'OrdersController@show'); 
        Route::get('/orders/{id}', 'OrdersController@detail'); 
        Route::post('/orders', 'OrdersController@store'); 
        Route::put('/orders/{id}', 'OrdersController@update');
        Route::delete('/orders/{id}', 'OrdersController@destroy'); 

        Route::get('/customers', 'CustomersController@show'); 
        Route::get('/customers/{id}', 'CustomersController@detail'); 
        Route::post('/customers', 'CustomersController@store'); 
        Route::put('/customers/{id}', 'CustomersController@update'); 
        Route::delete('/customers/{id}', 'CustomersController@destroy');
    });