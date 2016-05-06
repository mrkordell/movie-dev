<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Tmdb;

class Movie extends Model
{
    public $guarded = ['id'];

    public static function findOrAdd($id)
    {
        if ($movie = self::where('tmdb_id', $id)->first()) {
            return $movie;
        } else {
            $movie = Tmdb::getMoviesApi()->getMovie($id);

            return self::create([
        'tmdb_id'       => $movie['id'],
        'title'         => $movie['title'],
        'poster_path'   => $movie['poster_path'],
        'backdrop_path' => $movie['backdrop_path'],
        'release_date'  => $movie['release_date'],
      ]);
        }
    }
}
