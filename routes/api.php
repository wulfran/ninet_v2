<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', ['as' => 'api.login', 'uses' => 'Api\UsersController@login']);


Route::group(['prefix' => 'panel/', 'as' => 'panel.', 'middleware' => 'auth:api'], function () {
    Route::get('/users', ['as' => 'users.list', 'uses' => 'Api\UsersController@index'])->middleware('auth:api');
    Route::get('/companies', ['as' => 'companies.list', 'uses' => 'Api\CompaniesController@index']);
    Route::patch('/companies/{company}', ['as' => 'companies.update', 'uses' => 'Api\CompaniesController@update']);
    Route::delete('/companies/{company}', ['as' => 'companies.delete', 'uses' => 'Api\CompaniesController@destroy']);
    Route::get('/countries', ['as' => 'countries.list', 'uses' => 'Api\CountriesController@index']);
});

Route::get('/test', function (){
    return 'Success';
})->middleware('auth:api');
