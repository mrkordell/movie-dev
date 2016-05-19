<template>
  <h3>Popular</h3>
  <div class="row" v-for="chunk in popular | inChunksOf 6">
    <div class="col-sm-2" style="margin-bottom:20px;" v-for="movie in chunk" v-on:mouseover="remove = movie" v-on:mouseout="remove = {}">
      <a class="hvr-grow" href="/movie/{{movie.tmdb_id}}"><img v-bind:src="poster(movie)" class="pull-left" style="width:100%" /></a><br />
      <div>
        <span class="movie-title">{{movie.title}}</span><br />
        <span class="movie-release-date">{{movie.release_date | date}}</span>
      </div>
      <button class="btn btn-primary" v-if="!hasMovie(movie.id)"  v-on:click="addMovie(movie.id, $event)">Add Movie</button>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      popular: [],
      movies: [],
      img_base: 'http://image.tmdb.org/t/p/w92',
      base: 'http://image.tmdb.org/t/p/w154',
    };
  },
  route: {
    data(transition) {
      $.when($.getJSON('/user/movies'), $.getJSON('/popular'))
        .done(function(movies, popular){
          transition.next({movies: movies[0], popular: popular[0]});
        });
    }
  },
  methods: {
    addMovie (id, event){
      var that = this;
      $.post('user/movie', {id: id, "_token": $('meta[name="csrf_token"]').attr('content')}, function(data){
        console.log(event.target);
        event.target.className = "btn btn-success";
        event.target.innerHTML = 'Added!';
        that.movies = data;
      });
    },
    hasMovie (id){
      return _.find(this.movies, (m) => m.id == id);
    },
    poster(movie) {
      if(movie.poster_path !== null){
        return this.base + movie.poster_path;
      } else {
        return 'http://dummyimage.com/154x231/000/ffffff&text=No+Poster';
      }
    }
  }
};
</script>
