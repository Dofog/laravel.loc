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

Route::middleware('auth:api')->get('/user', function (Request $request) {



    return $request->user();
});

Route::post('/register','Auth\RegisterController@register');
Route::post('/login', 'Auth\LoginController@login');
Route::post('/logout', 'Auth\LoginController@logout');

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('admin', 'UserController@index');
  //  Route::get('admin/{admin}', 'UserController@show');
   Route::post('admin/create/user', 'UserController@create_user');
   Route::post('admin/create/project', 'UserController@create_project');
   Route::put('admin/create/project/{project}', 'UserController@update_project');
   Route::delete('admin/create/project/{project}', 'UserController@delete_project');


   Route::get('user', 'UserController@index');

});