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

Route::get('/', function () {
    return view('templates.home');
});

Route::get('/home', function () {
    return view('templates.home');
});

Route::get('/searchregistry', function () {
    return view('templates.searchregistry');
});

Route::post('/searchregistry', 'RegistryController@searchregistry');

Route::post('/searchregistry/deleteregistry', 'RegistryController@deleteregistry');

Route::post('/searchregistry/editregistry', 'RegistryController@editegistry');

Route::post('/searchregistry/editregistry/save', 'RegistryController@editegistrysave');




Route::post('/submit', 'RegistryController@submitregistry');

Route::get('/submit', 'RegistryController@submitregistry');//redirecionar isso pra home depois
