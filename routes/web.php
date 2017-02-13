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
    return view('welcome');
});

Route::get('/users', 'UsersController@index');
Route::get('/reports', 'ReportsController@index');
Route::get('/reports/{model}', 'ReportsController@lists');
Route::get('/reports/{model}/{id}', 'ReportsController@show');
Route::get('/reports/{model}/{id}/new', 'ReportsController@new');
Route::get('/reports/{model}/{id}/edit', 'ReportsController@edit');
Route::post('/reports/{model}/{id}/new', 'ReportsController@store');
Route::post('/reports/{model}/{id}/edit', 'ReportsController@update');

Auth::routes();

Route::get('/home', 'HomeController@index');
