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
Route::get('saveRemarks/', [
    'middleware' => 'auth',
    'uses' => 'HomeController@getSaveRemarks'
]);
Route::get('getMunicipalitiesByProvince/', [
    'middleware' => 'auth',
    'uses' => 'HomeController@getMunicipalitiesByProvince'
]);
Route::post('remove/{id}', [
    'middleware' => 'auth',
    'uses' => 'HomeController@postRemoveApplication'
]);
Route::post('printcertificate/{id}', [
    'middleware' => 'auth',
    'uses' => 'HomeController@postPrintCertificate'
]);
Route::post('approve/{id}', [
    'middleware' => 'auth',
    'uses' => 'HomeController@postApproveTravel'
]);
Route::post('editUser/{id}', [
    'middleware' => 'auth',
    'uses' => 'HomeController@postEditUser'
]);

Route::post('view/{id}', [
    'middleware' => 'auth',
    'uses' => 'HomeController@postViewApplication'
]);

Route::get('view/{id}', [
    'middleware' => 'auth',
    'uses' => 'HomeController@getViewApplication'
]);

Route::get('editUser/{id}', [
    'middleware' => 'auth',
    'uses' => 'HomeController@getEditUser'
]);

Route::post('edit/{id}', [
    'middleware' => 'auth',
    'uses' => 'HomeController@postEdit'
]);
Route::get('edit/{id}', [
    'middleware' => 'auth',
    'uses' => 'HomeController@getEdit'
]);
Route::get('/', [
    'middleware' => 'auth',
    'uses' => 'HomeController@getIndex'
]);
Route::post('/', [
    'middleware' => 'auth',
    'uses' => 'HomeController@postIndex'
]);
Route::post('/home', [
    'middleware' => 'auth',
    'uses' => 'HomeController@postIndex'
]);

Route::get('/home', [
    'middleware' => 'auth',
    'uses' => 'HomeController@getIndex'
]);
Route::get('/applyForTravel', [
    'middleware' => 'auth',
    'uses' => 'HomeController@getApplyForTravel'
]);
Route::post('/applyForTravel', [
    'middleware' => 'auth',
    "files" => true,
    'uses' => 'HomeController@postApplyForTravel'
]);

Route::get('/approvedTA', [
    'middleware' => 'auth',
    'uses' => 'HomeController@getApprovedTA'
]);
Route::get('/adminconsole', [
    'middleware' => 'auth',
    'uses' => 'HomeController@getAdminConsoleUsers'
]);
//search result
Route::post('/adminconsole', [
    'middleware' => 'auth',
    'uses' => 'HomeController@postAdminConsoleUsers'
]);
// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');