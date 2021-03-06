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

Route::group(['prefix' => 'auth', 'as' => 'auth.'], function (){
    Route::post('login', 'Auth\LoginController@login')
        ->name('login');
    Route::post('register', 'Auth\RegisterController@register')
        ->name('register');
    Route::middleware('auth:sanctum')->get('logout', 'Auth\LoginController@logout')
        ->name('logout');
});
