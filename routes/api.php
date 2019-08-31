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

Route::prefix('auth')->group(function () {
    Route::post('register', 'Auth\RegisterController@register');
    Route::post('login', 'Auth\LoginController@Login');
    Route::post('recovery', 'Auth\ForgotPasswordController@recovery');
    Route::post('change', 'Auth\ResetPasswordController@change');
    Route::get('verify/{verification_code}', 'Auth\VerificationController@verify');
    Route::get('refresh', 'AuthController@refresh');

    Route::group(['middleware' => 'auth:api'], function(){
        Route::get('user', 'AuthController@user');
        Route::post('logout', 'Auth\LoginController@logout');
    });
});

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('users', 'UserController@index')->middleware('isAdmin');
    Route::get('users/{id}', 'UserController@show')->middleware('isAdminOrSelf');
});

Route::resource('user', 'UserController');
Route::get('course/{id}', 'UserController@course');
Route::post('course', 'UserController@leaveCourse');
Route::get('time/{id}', 'UserController@time');
Route::post('login', 'LoginController@login');

Route::post('register' , 'LoginController@register');
