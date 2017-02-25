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

Route::get('popular', function () {

  return App\Movie::with('users')->where('release_date','>=','NOW()')->get()->sortByDesc(function ($movie) {
    return $movie->users->count();
  })->slice(0, 12)->values()->all();

});

Route::get('/{user_id}.ics', function ($user_id) {
  $body = view('calendar')->with('movies', App\User::find($user_id)->movies->sortBy('release_date')->values()->all());
  $body = str_replace("\r\n", "\n", $body);

  return response($body)->withHeaders([
    'Content-Type' => 'text/calendar',
  ]);
});

Route::get('/{user_id}.txt', function ($user_id) {
  return view('calendar')->with('movies', App\User::find($user_id)->movies->sortBy('release_date')->values()->all());
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

Route::post('user/remove', function (Request $request) {
  Auth::user()->movies()->detach($request->input('id'));

  return Auth::user()->movies;
});

Route::get('/', function () {
  if (Auth::check()) {
      return Redirect::to('dashboard');
  }

  return view('welcome');
});

Route::get('/user/movies', function () {
  $movies = Auth::user()->movies->sortBy('release_date')->filter(function($movie){
    return(strtotime($movie->release_date) >= time());
  });
  return $movies->values()->toJson();
});

Route::get('upcoming', function () {
  return collect(App\Movie::getUpcoming())->toJson();
});

Route::post('api/movies', function (Request $request) {
  return Tmdb::getSearchApi()->searchMovies($request->input('query'));
});
