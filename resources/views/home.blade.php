@extends('layouts.master')

@section('content')

  <div id="app">
    <div class="row">
      <div class="col-md-12">
        <input class="form-control" type="text" value="http://www.cinebound.com/{{Auth::user()->id}}.ics?nocache" readonly />
      </div>
      <div class="col-md-12">
        <h3>Tracked Movies</h3>
        <div class="row" v-for="chunk in movies | limit limit | inChunksOf 6">
          <div class="col-sm-2" style="margin-bottom:20px;" v-for="movie in chunk" v-on:mouseover="remove = movie" v-on:mouseout="remove = {}">
            <div v-if="remove == movie" v-on:click="removeMovie(movie.id)">Remove</div>
            <a href="/movie/@{{movie.tmdb_id}}"><img v-bind:src="base + movie.poster_path" class="pull-left" style="width:100%" /></a><br />
            <span class="movie-title">@{{movie.title}}</span><br />
            <span class="movie-release-date">@{{movie.release_date | date}}</span>
          </div>
        </div>
        <div class="row" v-if="movies.length > 12">
          <div class="div-md-12" v-on:click="limit = 9999">
            Show All
          </div>
        </div>
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
          World Premiere: @{{ result.release_date | date }} <br />
          <button class="btn btn-primary"  v-on:click="addMovie(result.id, $event)">Add Movie</button>
        </div>
      </div>
    </div>

    <div class="container">
      <h3>Coming Soon</h3>
      <div class="row" v-for="chunk in upcoming | inChunksOf 6">
        <div class="col-sm-2" style="margin-bottom:20px;" v-for="movie in chunk" v-on:mouseover="remove = movie" v-on:mouseout="remove = {}">
          <a href="/movie/@{{movie.tmdb_id}}"><img v-bind:src="base + movie.poster_path" class="pull-left" style="width:100%" /></a><br />
          <span class="movie-title">@{{movie.title}}</span><br />
          <span class="movie-release-date">@{{movie.release_date | date}}</span>
        </div>
      </div>
    </div>

    <script type="text/javascript">
    Vue.filter('limit', function(data, number = 9999){
      console.log(data);
      return data.slice(0, number);
    });
    var vm = new Vue({
      el: '#app',
      data: {
        movies: {!!Auth::user()->movies->sortBy('release_date')->values()->toJson()!!},
        upcoming: {!! collect(App\Movie::getUpcoming())->toJson() !!},
        results: [],
        search: '',
        img_base: 'http://image.tmdb.org/t/p/w92',
        base: 'http://image.tmdb.org/t/p/w154',
        remove: {},
        limit: 12
      },
      methods: {
        searchMovies: function(){
          var that = this;
          $.post('/api/movies', {query: this.search}, function(data){
            that.results = data.results;
          }, 'JSON');
        },
        addMovie: function(id, event){
          var that = this;
          $.post('user/movie', {id: id, "_token": "{{csrf_token()}}"}, function(data){
            console.log(event.target)
            event.target.className = "btn btn-success";
            event.target.innerHTML = 'Added!';
            that.movies = data;
          });
        },
        removeMovie: function(id){
          $.post('user/remove', {id: id, "_token": "{{csrf_token()}}"}, function(data){

          });
          this.movies = _.filter(this.movies, function(movie){
            if(movie.id != id){
              return movie;
            }
          });
        }
      }


    });

    </script>

    <style>
      span.movie-title{
        font-size:12px;
        color:#333;
        font-weight: bold;
      }
      span.movie-release{
        font-size:12px;
        color:#333;
      }
    </style>

  @endsection
