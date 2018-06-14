<?php

use Illuminate\Http\Request;

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

Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
Route::group(['prefix' => 'auth', 'middleware' => 'jwt.auth'], function () {
  Route::get('user', 'AuthController@user');
  Route::delete('logout', 'AuthController@logout');
  Route::resource('user', 'UserController', ['only' => ['destroy']]);
  Route::resource('user/teacher', 'UserTeacherController', ['only' => ['store', 'index', 'show']]);
});
Route::middleware('jwt.refresh')->get('/token/refresh', 'AuthController@refresh');