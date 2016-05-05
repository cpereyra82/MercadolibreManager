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

Route::group(['middleware'=>['web']],function(){
    Route::get('/', function () {
        return view('welcome');
    });

    Route::auth();
    Route::resource('products','ProductsController');
    Route::post('products/procesar',[
        'uses' 	=> 'ProductsController@procesar',
        'as'	=> 	'products.procesar']);

    Route::resource('item','ItemsController');
    Route::get('/home', 'HomeController@index');



});
Route::post('/reporting', ['uses' =>'ReportesController@post']);
Route::get('/reporting', ['uses' =>'ReportesController@index', 'as' => 'reportes.index']);