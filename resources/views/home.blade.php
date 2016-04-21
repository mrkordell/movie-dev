@extends('layouts.master')

@section('content')

  <div id="app">

    <div class="form-group">
      <div class="input-group">
        <input v-model="search" v-on:keyup.enter="searchMovies" class="form-control" placeholder="Find a Movie" />
        <span class="input-group-btn">
          <button v-on:click="searchMovies" class="btn btn-default" type="button">Search</button>
        </span>
      </div>
    </div>

    <div class="container" v-if="results">
      <div class="media" v-for="result in results">
        <div class="media-left">
          <a href="#">
            <img class="media-object" src="@{{img_base + result.poster_path}}" alt="">
          </a>
        </div>
        <div class="media-body">
          <h4 class="media-heading">@{{ result.title }}</h4>
          @{{ result.release_date }} <br />
          <button class="btn btn-primary" v-on:click="addMovie">Add Movie</button>
        </div>
      </div>
    </div>

    <script type="text/javascript">
    new Vue({
      el: '#app',
      data: {
        results: [],
        img_base: 'http://image.tmdb.org/t/p/w92'
      },
      methods: {
        searchMovies: function(){
          var that = this;
          $.post('/api/movies', {query: this.search}, function(data){
            that.results = data.results;
          }, 'JSON');
        }
      }
    })
    </script>

  @endsection
