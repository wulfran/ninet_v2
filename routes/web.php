<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::group(['as' => 'panel.', 'prefix' => '/panel', 'middleware' => 'auth'], function(){
    Route::get('', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);
});

Route::get('test', ['as' => 'test', 'uses' => 'TestController@index']);


$panelRoutes = [
    '/',
    '/panel/dashboard',
];

foreach ($panelRoutes as $route) {
    Route::get($route, [HomeController::class, 'index']);
}
