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
   
        Route::group(['middleware' => ['api.superadmin']], function ()
        {
            Route::delete('/product/{id_product}', 'ProductController@destroy');
            Route::delete('/orders/{id}', 'OrdersController@destroy'); 
            Route::delete('/customers/{id}', 'CustomersController@destroy');
        });

    Route::group(['middleware' => ['api.admin']], function ()
        {
            Route::post('/product', 'ProductController@store'); 
            Route::put('/product/{id_product}', 'ProductController@update'); 
            
            Route::post('/orders', 'OrdersController@store'); 
            Route::put('/orders/{id}', 'OrdersController@update');
            
            Route::post('/customers', 'CustomersController@store'); 
            Route::put('/customers/{id}', 'CustomersController@update'); 
        });    
        
        Route::get('/product', 'ProductController@show'); 
        Route::get('/product/{id_product}', 'ProductController@detail'); 

        Route::get('/orders', 'OrdersController@show'); 
        Route::get('/orders/{id}', 'OrdersController@detail'); 

        Route::get('/customers', 'CustomersController@show'); 
        Route::get('/customers/{id}', 'CustomersController@detail'); 

    });