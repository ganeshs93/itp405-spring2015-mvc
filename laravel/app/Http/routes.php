<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::get('/dvds', 'DvdController@results');

Route::post('/dvds', 'DvdController@submitNewDvd');

Route::get('/dvds/search', 'DvdController@search');

Route::get('/dvds/create', 'DvdController@createDvd');

Route::get('dvds/{id}', 'DvdController@showDetails');

Route::post('/dvds/{id}/submit_review', 'DvdController@submitReview');

Route::get('genres/{genreName}/dvds', 'DvdController@dvdsByGenre');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
