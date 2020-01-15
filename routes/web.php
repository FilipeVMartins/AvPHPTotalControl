<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'RoutesController@getRegistry');
Route::get('/home', 'RoutesController@getRegistry');
Route::get('/registry', 'RoutesController@getRegistry');//inicio = home = cadastro


Route::post('/searchregistry', 'RegistryController@searchregistry');
Route::get('/searchregistry', 'RoutesController@getSearchregistry');


Route::post('/searchregistry/deleteregistry', 'RegistryController@deleteregistry');
Route::get('/searchregistry/deleteregistry', 'RoutesController@getDeleteregistry');


Route::post('/searchregistry/editregistry', 'RegistryController@editegistry');
Route::get('/searchregistry/editregistry',  'RoutesController@getEditregistry');


Route::post('/searchregistry/editregistry/save', 'RegistryController@editegistrysave');
Route::get('/searchregistry/editregistry/save',  'RoutesController@getSave');




Route::post('/submit', 'RegistryController@submitregistry');

Route::get('/submit', 'RegistryController@submitregistry');//redirecionar isso pra home depois
