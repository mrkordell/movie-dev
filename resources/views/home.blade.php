@extends('layouts.master')

@section('content')

  <div id="app">

    <h1>Movies</h1>
    <ul class="list-group">
      <li class="list-group-item" v-for="movie in movies">
        @{{ movie.title }}
      </li>
    </ul>

    <div class="form-group">
      <label for="title">Search</label>
      <input v-model="search" v-on:keyup.enter="searchMovies" class="form-control" />
    </div>

    <div v-if="results">
      <ul class="list-group">
        <li class="list-group-item" v-for="result in results">
          @{{ result.title }}
        </li>
      </ul>
    </div>

    <div class="form-group">
      <label for="title">Title</label>
      <input v-model="newMovie.title" class="form-control" />
    </div>
    <div class="form-group">
      <label for="studio">Studio</label>
      <select v-model="newMovie.studio" class="form-control">
        <option v-for="studio in studios">@{{studio.name}}</option>
      </select>
    </div>
    <div class="form-group">
      <label for="release_date">Release Date</label>
      <input type="date" v-model="newMovie.release_date" class="form-control" />
    </div>
    <div class="form-group">
      <button class="btn btn-primary" v-on:click="addMovie">Add Movie</button>
    </div>

    <h1>Studios</h1>
    <ul class="list-group">
      <li class="list-group-item" v-for="studio in studios">
        @{{ studio.name }}
      </li>
    </ul>
    <div class="form-group">
      <label for="title">Name</label>
      <input v-model="newStudio.name" class="form-control" />
    </div>
    <div class="form-group">
      <button class="btn btn-primary" v-on:click="addStudio">Add Studio</button>
    </div>
  </div>

  <script type="text/javascript">
  new Vue({
    el: '#app',
    data: {
      newMovie: {},
      movies: [],
      newStudio: {},
      studios: [{name:'Marvel'}],
      search: '',
      results: [],
      csrf: '{{csrf_token()}}'
    },
    methods: {
      searchMovies: function(){
        var that = this;
        $.post('/api/movies', {query: this.search}, function(data){
          that.results = data.results;
        }, 'JSON');
      },
      addMovie: function(){
        this.movies.push(this.newMovie);
        this.newMovie = {};
      },
      addStudio: function(){
        this.studios.push(this.newStudio);
        this.newStudio = {};
      }
    }
  })
  </script>

@endsection
