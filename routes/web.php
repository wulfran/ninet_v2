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

$panelRoutes = [
    '/',
    '/panel/dashboard',
    '/panel/users',
    '/panel/companies',
];

foreach ($panelRoutes as $route) {
    Route::get($route, [HomeController::class, 'index']);
}
