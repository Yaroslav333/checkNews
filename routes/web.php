<?php

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
/*
Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/register', function () {
    abort(404, 'This action is unauthorized.');
});

Route::get('/', 'GameController@index');
Route::get('/game/get-news', 'GameController@getNews');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', function () {
    return redirect('/');
});

Route::get('/admin', 'AdminController@index');
Route::post('/admin/news/{id}', 'NewsController@updateNews');
Route::post('/admin/news/delete/{id}', 'NewsController@destroyNews');
Route::get('/admin/mail', 'EmailController@mail');


Route::resource('admin/news', 'NewsController');
Route::resource('admin/users', 'UserController');
Route::resource('admin/greetings', 'GreetingsController');