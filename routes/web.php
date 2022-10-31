<?php

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/all', function () {
    return view('all');
});
Route::get('/home', function () {
    return view('all');
});
Route::get('/about', function () {
    return view('all');
});
Route::get('/help', function () {
    return view('all');
});
Route::get('/new', function () {
    return view('newpage');
});
Route::get('/test', function () {
    return view('newpage');
});
Route::get('/editeprofile', function () {
    return view('newpage');
});
Route::get('/profile', function () {
    return view('newpage');
});
Route::get('/demoprofile', function () {
    return view('newpage');
});
Route::get('/profile1', function () {
    return view('newpage');
});
Route::get('/loginaccount', function () {
    return view('newpage');
});
Route::get('/Addposts', function () {
    return view('newpage');
});
Route::get('/allnewpost', function () {
    return view('newpage');
});
Route::get('/editepost/{id}', function () {
    return view('newpage');
});
Route::get('/Mypost', function () {
    return view('newpage');
});
Route::get('/alluser', function () {
    return view('newpage');
});
Route::get('/alldata/{id}', function () {
    return view('all');
});
Route::get('/user', 'UserController@index');
Route::get('/data', 'DataController@index');
Route::get('/edit/{id}', 'DataController@index');
Route::get('/add', 'DataController@index');
// Route::get('/login', 'LoginController@index');
Route::get('/regi', 'LoginController@regi');
Route::post('/submit', 'LoginController@submit');
Route::get('/userdata', 'DataController@index');

Route::post('/upload', 'UserController@upload');




Route::get('pages/search/{term?}', 'MypagrController@index');

