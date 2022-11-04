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
Route::get('/allpost/search/{data?}', 'AllprofileController@search');
Route::post('editpostdata1', 'AllprofileController@editpostdata1');
Route::post('editpostdata/{id}', 'AllprofileController@editpostdata');
Route::get('pa/{id}', 'AllprofileController@updates');
Route::get('getsingledata/{id}', 'RegistorController@getsingledata');
Route::post('demoprofiless', 'AllprofileController@demoprofile');
Route::get('userdata', 'AllprofileController@userdata');
Route::delete('deleteuser/{id}', 'AllprofileController@deleteuser');
Route::post('pagess/{id}', 'MypagrController@update');
Route::resource('pages', 'MypagrController');
Route::post('/profile', 'RegistorController@profile');
Route::post('/login', 'RegistorController@login');
Route::post('/register', 'RegistorController@registerUser');
Route::post('/logout', 'RegistorController@logout');
Route::get('page/', 'MypagrController@alldata');
Route::resource('registore/', 'RegistorController');
Route::resource('newusrdatas/', 'UserdataController');
Route::get('newusrdatas/{id}/edit', 'UserdataController@edit');
Route::put('newusrdatas/{id}', 'UserdataController@update');
Route::resource('allpost', 'AllprofileController');
Route::post('/upload_image', function (Request $request) {
    return response($request->file('image'));
});
