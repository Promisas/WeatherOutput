<?php

use App\Http\Controllers\Api\WeatherTypeController;
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

Route::post('/products/recommended/{city?}', [WeatherTypeController::class, 'searchInput'])->where('city', '[A-Za-z]+')->name('city');
