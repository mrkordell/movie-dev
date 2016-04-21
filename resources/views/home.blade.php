@extends('layouts.master')

@section('content')

  <div id="app">

    <h1>Movies</h1>
    <ul>
      <li v-for="movie in movies">
        @{{ movie.title }}
      </li>
    </ul>

    <input v-model="newMovie.title" />
    <input v-model="newMovie.studio" />
    <input v-model="newMovie.release_date" />
    <button v-on:click="addMovie">Add Movie</button>
  </div>

  <script type="text/javascript">
  new Vue({
    el: '#app',
    data: {
      newMovie: {},
      movies: []
    },
    methods: {
      addMovie: function(){
        this.movies.push(this.newMovie);
        this.newMovie = {};
      }
    }
  })
  </script>

@endsection
