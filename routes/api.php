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

// Api routes for login
// Api link api/auth/
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

// Api routes for course
// Api link api/course/
Route::prefix('course')->group(function () {
    Route::get('courses', 'Course\CourseController@index');

    Route::group(['middleware' => 'auth:api'], function(){

    });
});

// If the user need to be login
// Api link api/
Route::group(['middleware' => 'auth:api'], function(){
    Route::get('users', 'UserController@index')->middleware('isAdmin');
    Route::get('users/{id}', 'UserController@show');
    Route::get('git', 'GitController@index')->middleware('isAdmin');
    Route::post('git/{id}', 'GitController@store')->middleware('isAdminOrSelf');
    Route::get('tokenCheck/{id}', 'GitController@check');
    Route::get('token/{id}', 'GitController@get');
});


Route::get('course', 'Controller@leaveCourse');

//->middleware('isAdminOrHolderAndSelf')
