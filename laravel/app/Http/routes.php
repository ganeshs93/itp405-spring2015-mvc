<?php

use App\User;

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

Route::get('/signup', function()
{
    return view('signup');           
});

Route::post('/signup', function()
{
    $validation = User::validate(Request::all());
    if ($validation->passes())
    {
        $user = new User();
        $user->name = Request::input('name');
        $user->email = Request::input('email');
        $user->password = Hash::make(Request::input('password'));
        $user->save;
        
        Auth::loginUsingId($user->id);
        return redirect('dashboard');
    }
    else
    {
        return redirect('/signup')->withErrors($validation->errors());
    }
});

Route::get('/login', function()
{
   return view('login');    
});

Route::post('/login', function()
{
   if (Auth::attempt(['email' => Request::input('email'), 'password' => Request::input('password')])) {
        //return redirect('/dashboard');
       return redirect()->intended();
   }
   else
   {
    return redirect('login');
   }
});

Route::get('/dashboard', ['middleware' => 'auth', function()
{
    //if(Auth::check())
    //{
        return view('dashboard');
    //}
    //return redirect('/login');
}]);

Route::get('/logout', function()
{
    Auth::logout();
    return redirect('/login');
});

Route::get('password', ['middleware'=> 'auth', function()
{
    dd('edit password');
}]);

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
