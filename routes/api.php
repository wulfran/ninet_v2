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

Route::get('/users', ['as' => 'users.list', 'uses' => 'Api\UsersController@index'])->middleware('auth:api');


Route::get('/test', function (){
    return 'Success';
})->middleware('auth:api');
