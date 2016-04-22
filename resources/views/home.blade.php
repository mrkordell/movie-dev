@extends('layouts.master')

@section('content')

  <div id="app">
    <div class="row">
      <div class="col-md-12">
        <h3>Tracked Movies</h3>
        <img v-for="movie in movies" v-bind:src="img_base + movie.poster_path" class="pull-left" style="margin-right:25px;" />
      </div>
    </div>

    <div class="form-group" style="margin-top:20px;">
      <div class="input-group">
        <input v-model="search" v-on:keyup.enter="searchMovies" class="form-control" placeholder="Find a Movie" />
        <span class="input-group-btn">
          <button v-on:click="searchMovies" class="btn btn-default" type="button">Search</button>
        </span>
      </div>
    </div>

    <div class="container" v-show="results">
      <div class="media" v-for="result in results">
        <div class="media-left">
          <a href="/movie/@{{result.id}}">
            <img class="media-object" v-bind:src="img_base + result.poster_path" alt="">
          </a>
        </div>
        <div class="media-body">
          <h4 class="media-heading">@{{ result.title }}</h4>
          @{{ result.release_date }} <br />
          <button class="btn btn-primary"  v-on:click="addMovie(result.id)">Add Movie</button>
        </div>
      </div>
    </div>

    <script type="text/javascript">
    new Vue({
      el: '#app',
      data: {
        movies: {!!Auth::user()->movies!!},
        results: [],
        img_base: 'http://image.tmdb.org/t/p/w92'
      },
      methods: {
        searchMovies: function(){
          var that = this;
          $.post('/api/movies', {query: this.search}, function(data){
            that.results = data.results;
          }, 'JSON');
        },
        addMovie: function(id){
          var that = this;
          $.post('user/movie', {id: id, "_token": "{{csrf_token()}}"}, function(data){
            that.movies = data;
          });
        }
      }
    })
    </script>

  @endsection
