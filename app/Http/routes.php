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

use Illuminate\Http\Request;

\Log::useFiles('php://stderr');

Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');

Route::get('logout', function () {
  Auth::logout();

  return Redirect::to('/');
});
Route::group(['middleware' => 'auth'], function () {
  Route::get('dashboard', function () {
    return view('home');
  });

  Route::get('movie/{id}', function ($id) {
    $movie = Tmdb::getMoviesApi()->getMovie($id);

    return view('movie')->with(compact('movie'));
  });

  Route::post('user/movie', function (Request $request) {
    $movie = App\Movie::findOrAdd($request->input('id'));
    Auth::user()->movies()->save($movie);

    return Auth::user()->movies;
  });
});

Route::get('/', function () {
  if (Auth::check()) {
      return Redirect::to('dashboard');
  }

  return view('welcome');
});

Route::post('api/movies', function (Request $request) {
  return Tmdb::getSearchApi()->searchMovies($request->input('query'));
});
