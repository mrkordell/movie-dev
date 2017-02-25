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

            $release_date = self::getReleaseDate($id);

            return self::create([
        'tmdb_id'       => $movie['id'],
        'title'         => $movie['title'],
        'poster_path'   => $movie['poster_path'],
        'backdrop_path' => $movie['backdrop_path'],
        'release_date'  => $release_date,
      ]);
        }
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public static function getReleaseDate($id)
    {
        $releases = Tmdb::getMoviesApi()->getReleases($id);
        $releases = $releases['countries'];

        $release = collect($releases)->where('iso_3166_1', 'US')->first();

        return $release['release_date'];
    }

    public static function getUpcoming()
    {
        return \Tmdb::getMoviesApi()->getUpcoming(['page' => 1, 'region' => 'US'])['results'];
    }
}
