<template>
  <h3>Coming Soon</h3>
  <div class="row" v-for="chunk in upcoming | inChunksOf 6">
    <div class="col-sm-2" style="margin-bottom:20px;" v-for="movie in chunk" v-on:mouseover="remove = movie" v-on:mouseout="remove = {}">
      <a href="/movie/{{movie.tmdb_id}}"><img v-bind:src="base + movie.poster_path" class="pull-left" style="width:100%" /></a><br />
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
      upcoming: [],
      movies: [],
      img_base: 'http://image.tmdb.org/t/p/w92',
      base: 'http://image.tmdb.org/t/p/w154',
    };
  },
  route: {
    data(transition) {
      $.when($.getJSON('/user/movies'), $.getJSON('/upcoming'))
        .done(function(movies, upcoming){
          transition.next({movies: movies[0], upcoming: upcoming[0]});
        });
    }
  },
  methods: {
    hasMovie: function(id){
      return _.find(this.movies, (m) => m.tmdb_id == id);
    }
  }
};
</script>
