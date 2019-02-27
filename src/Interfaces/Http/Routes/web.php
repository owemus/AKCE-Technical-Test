<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

Route::get('/clients', 'ClientsController@Get');
Route::get('/clients/detailed', 'ClientsController@GetWithRelationships');
Route::get('/clients/{id}', 'ClientsController@Find');
Route::get('/clients/{id}/detailed', 'ClientsController@FindWithRelationships');
Route::post('/clients', 'ClientsController@Insert');
Route::put('/clients/{id}', 'ClientsController@Update');
Route::delete('/clients/{id}', 'ClientsController@Delete');

Route::get('/client-accounts', 'ClientAccountController@Get');
Route::get('/client-accounts/detailed', 'ClientAccountController@GetWithRelationships');
Route::get('/client-accounts/{id}', 'ClientAccountController@Find');
Route::post('/client-accounts', 'ClientAccountController@Insert');
Route::put('/client-accounts/{id}', 'ClientAccountController@Update');
Route::delete('/client-accounts/{id}', 'ClientAccountController@Delete');

Route::get('/client-addresses', 'ClientAddressController@Get');
Route::get('/client-addresses/detailed', 'ClientAddressController@GetWithRelationships');
Route::get('/client-addresses/{id}', 'ClientAddressController@Find');
Route::get('/client-addresses/{id}/detailed', 'ClientAddressController@FindWithRelationships');
Route::post('/client-addresses', 'ClientAddressController@Insert');
Route::put('/client-addresses/{id}', 'ClientAddressController@Update');
Route::delete('/client-addresses/{id}', 'ClientAddressController@Delete');

Route::post('/transfer', 'TransactionController@Transfer');

Route::get('/transactions', 'TransactionController@Get');
Route::get('/transactions/detailed', 'TransactionController@GetWithRelationships');
Route::get('/transactions/{id}', 'TransactionController@Find');
Route::get('/transactions/{id}/detailed', 'TransactionController@FindWithRelationships');

Route::get('/client-accounts/{id}/transactions', 'ClientAccountController@FindWithRelationships');